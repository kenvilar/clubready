<template>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card striped_full">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ti-align-justify"></i> {{isEditView(item.id) ? 'Edit' : 'Create'}} Item
                        </h3>
                    </div>
                    <div class="card-body border">
                        <form @submit.prevent="storeOrUpdate" enctype="multipart/form-data" class="form-bordered-row"
                              novalidate>
                            <div class="form-group row striped-col required">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="user_id">User ID:</label>
                                </div>
                                <div class="col-sm-6">
                                    <select name="user_id" id="user_id" class="form-control select2"
                                            v-model.lazy="item.user_id"
                                            :class="{'is-invalid': hasError(errors, 'user_id')}"
                                            style="width:100%">
                                        <option disabled value="0">Select value...</option>
                                        <option v-for="user in all_users"
                                                :key="user.id"
                                                :value="user.id"
                                                :selected="user.id === item.user_id">
                                            {{user.first_name}} {{user.last_name}}
                                        </option>
                                    </select>
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'user_id', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3 ml-auto">
                                    <button type="submit"
                                            class="btn btn-effect-ripple btn-primary">
                                        {{ isEditView(item.id) ? 'Edit' : 'Create'}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import 'select2';

    export default {
        name: 'super-admins-create-and-edit-view-vue',
        props: {
            model_id: {
                type: Number,
                default: 0,
                required: false
            }
        },
        mounted() {
            let user_id = $("#user_id");

            this.getAllUsers();
            this.edit();

            setTimeout(() => this.userIdSelect2(), 500);
        },
        created() {
            //
        },
        components: {
            //
        },
        data() {
            return {
                database_model: 'super-admins',
                item: {},
                errors: {},
                all_users: {},
            }
        },
        methods: {
            async storeOrUpdate() {
                this.item.user_id = $("#user_id").val();

                if (this.model_id) {
                    let update = axios.put(`/api/${this.database_model}/${this.model_id}`, this.item)
                        .then(response => {
                            this.item = response.data;
                            window.location.href = `/admin/${this.database_model}/${this.model_id}`;
                        }, error => {
                            this.errors = error.response.data.error;
                            console.log('this.errors', this.errors);

                            setTimeout(() => this.userIdSelect2(), 3);
                        }).catch(err => {
                            //
                        });

                    return;
                }

                let store = axios.post(`/api/${this.database_model}`, this.item)
                    .then(() => {
                        //clear all the fields after successful create
                        this.clearFields(this.item);

                        //clear the select2 field
                        setTimeout(() => this.userIdSelect2(), 3);
                    }, error => {
                        this.errors = error.response.data.error;
                        console.log('this.errors', this.errors);

                        setTimeout(() => this.userIdSelect2(), 3);
                    }).catch(err => {
                        //
                    });
            },
            async edit() {
                if (this.model_id) {
                    let edit = axios.get(`/api/${this.database_model}/${this.model_id}`, this.item)
                        .then(response => {
                            this.item = response.data;
                        }, error => {
                            this.errors = error.response.data.error;
                        }).catch(err => {
                            //
                        });
                }
            },
            async clearFields(param) {
                if (param) {
                    this.item = {};
                    this.errors = {};
                }
                return this.item;
            },
            async getAllUsers() {
                let all_users = axios.get(`/api/users/?select=true&id=true&first_name=true&last_name=true`)
                    .then(response => {
                        this.all_users = response.data;
                    }, error => {
                        this.errors = error.response.data.error;
                    }).catch(err => {
                        //
                    });
            },
            isEditView(param) {
                return typeof param !== "undefined" || param !== undefined;
            },
            hasError(errors, name, showResult = false) {
                if (showResult === true) {
                    return typeof errors[name] == 'undefined' ? (typeof errors === 'string' ? errors : '') : errors[name][0];
                }

                return typeof errors[name] == 'undefined' ? (typeof errors === 'string' ? errors : '') : errors[name];
            },
            userIdSelect2() {
                let user_id = $("#user_id");
                user_id.select2({
                    theme: "bootstrap",
                    placeholder: "Select value...",
                    allowClear: true,
                });
            },
        }
    }
</script>
