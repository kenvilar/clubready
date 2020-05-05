<template>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card striped_full">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ti-align-justify"></i> {{isEditView(item.uuid) ? 'Edit' : 'Create'}} Item
                        </h3>
                    </div>
                    <div class="card-body border">
                        <form @submit.prevent="storeOrUpdate" enctype="multipart/form-data" class="form-bordered-row"
                              novalidate>
                            <div class="form-group row striped-col required">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="user_id">User</label>
                                </div>
                                <div class="col-sm-6">
                                    <select name="user_id" id="user_id" class="form-control"
                                            v-model="item.user_id"
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
                            <div class="form-group row required">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="club_id">Club</label>
                                </div>
                                <div class="col-sm-6">
                                    <select name="club_id" id="club_id" class="form-control"
                                            v-model="item.club_id"
                                            :class="{'is-invalid': hasError(errors, 'club_id')}"
                                            style="width:100%">
                                        <option disabled value="0">Select value...</option>
                                        <option v-for="club in all_clubs"
                                                :key="club.id"
                                                :value="club.id"
                                                :selected="club.id === item.club_id">
                                            {{club.name}}
                                        </option>
                                    </select>
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'club_id', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row striped-col required">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="admin">Admin</label>
                                </div>
                                <div class="col-sm-6">
                                    <span class="radio-inline iradio"
                                          :class="{'is-invalid': hasError(errors, 'admin')}">
                                        <input type="radio" name="admin" class="form-control" id="admin" value="1"
                                               v-model="item.admin"> Yes
                                    </span>
                                    <span class="radio-inline iradio">
                                        <input type="radio" name="admin" class="form-control" id="admin2" value="0"
                                               v-model="item.admin"> No
                                    </span>
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'admin', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3 ml-auto">
                                    <button type="submit"
                                            class="btn btn-effect-ripple btn-primary">
                                        {{ isEditView(item.uuid) ? 'Edit' : 'Create'}}</button>
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
        name: 'club-members-create-and-edit-view-vue',
        props: {
            model_id: {
                type: String,
                default: '',
                required: false
            }
        },
        mounted() {
            this.edit();
            this.getAllUsers();
            this.getAllClubs();
        },
        created() {
            //
        },
        components: {
            //
        },
        data() {
            return {
                database_model: 'club-members',
                item: {},
                errors: {},
                all_users: {},
                all_clubs: {},
            }
        },
        methods: {
            async storeOrUpdate() {
                this.item.admin = $("input[name='admin']:checked").val();

                if (this.model_id) {
                    let update = axios.put(`/api/${this.database_model}/${this.model_id}`, this.item)
                        .then(response => {
                            this.item = response.data;

                            swal.fire({
                                icon: 'success',
                                title: "Success",
                                text: "Club member has been updated successfully.",
                                type: "success",
                            }).then(result => {
                                if (result.value) {
                                    this.automaticFocusTheFirstInput();
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
                    .then(() => {
                        swal.fire({
                            icon: 'success',
                            title: "Success",
                            text: "New club member has been created successfully.",
                            type: "success",
                        }).then(result => {
                            if (result.value) {
                                this.clearFields(this.item);
                                this.automaticFocusTheFirstInput();
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
            async getAllClubs() {
                axios.get(`/api/clubs/?select=true&id=true&name=true`)
                    .then(response => {
                        this.all_clubs = response.data;
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
