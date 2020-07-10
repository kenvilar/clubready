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
                                    <label class="form-control-label" for="club_member_id">User</label>
                                </div>
                                <div class="col-sm-6">
                                    <select name="club_member_id" id="club_member_id" class="form-control select2"
                                            :class="{'is-invalid': hasError(errors, 'club_member_id')}"
                                            style="width:100%">
                                        <option disabled value="0">Select value...</option>
                                        <option v-for="user in all_users"
                                                :key="user.id"
                                                :value="user.id"
                                                :selected="user.id === item.club_member.user_id">
                                            {{user.first_name}} {{user.last_name}}
                                        </option>
                                    </select>
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'club_member_id', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row required">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="make">Make</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="make" id="make"
                                           v-model="item.make"
                                           :class="{'is-invalid': hasError(errors, 'make')}">
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'make', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row striped-col required">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="model">Model</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="model" id="model"
                                           v-model="item.model"
                                           :class="{'is-invalid': hasError(errors, 'model')}">
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'model', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row required">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="year">Year</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="year" id="year"
                                           v-model="item.year"
                                           :class="{'is-invalid': hasError(errors, 'year')}">
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'year', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row striped-col required">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="capacity">Capacity</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="capacity" id="capacity"
                                           v-model="item.capacity"
                                           :class="{'is-invalid': hasError(errors, 'capacity')}">
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'capacity', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row required">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="induction">Induction</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="induction" id="induction"
                                           v-model="item.induction"
                                           :class="{'is-invalid': hasError(errors, 'induction')}">
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'induction', true)}}</strong></span>
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
    export default {
        name: 'vehicles-create-and-edit-view-vue',
        props: {
            model_id: {
                type: Number,
                default: 0,
                required: false
            }
        },
        mounted() {
            this.edit();
            this.getAllUsers();
        },
        created() {
            //
        },
        components: {
            //
        },
        data() {
            return {
                database_model: 'vehicles',
                item: {},
                errors: {},
                all_users: {},
            }
        },
        methods: {
            async storeOrUpdate() {
                if (this.model_id) {
                    let update = axios.put(`/api/${this.database_model}/${this.model_id}`, this.item)
                        .then(response => {
                            this.item = response.data;

                            swal.fire({
                                icon: 'success',
                                title: "Success",
                                text: "Vehicle has been updated successfully.",
                                type: "success",
                            }).then(result => {
                                if (result.value) {
                                    this.automaticFocusTheFirstInput();
                                    this.errors = {};
                                }
                            });
                        }, error => {
                            this.errors = error.response.data.error;
                            console.log('this.errors', this.errors);
                        }).catch(err => {
                            //
                        });

                    return;
                }

                let store = axios.post(`/api/${this.database_model}`, this.item)
                    .then(response => {
                        swal.fire({
                            icon: 'success',
                            title: "Success",
                            text: "New vehicle has been created successfully.",
                            type: "success",
                        }).then(result => {
                            if (result.value) {
                                this.clearFields(this.item);
                                this.automaticFocusTheFirstInput();
                                this.errors = {};
                            }
                        });
                    }, error => {
                        this.errors = error.response.data.error;
                        console.log('this.errors', this.errors);
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
                axios.get(`/api/users/?select=true&id=true&first_name=true&last_name=true`)
                    .then(response => {
                        this.all_users = response.data;
                    }, error => {
                        this.errors = error.response.data.error;
                    })
                    .catch(err => {
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
            automaticFocusTheFirstInput() {
                setTimeout(() => {
                    $('input:visible:enabled').toggleClass('focus-visible');
                    $('form:first *:input[type!=hidden]:first').focus();
                }, 300);
            },
        }
    }
</script>
