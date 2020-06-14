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
                                    <label class="form-control-label" for="first_name">First Name</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="first_name" id="first_name"
                                           v-model="item.first_name"
                                           :class="{'is-invalid': hasError(errors, 'first_name')}">
                                    <span role="alert" class="invalid-feedback">
                                    <strong>{{hasError(errors, 'first_name', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row required">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="last_name">Last Name</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                           v-model="item.last_name"
                                           :class="{'is-invalid': hasError(errors, 'last_name')}">
                                    <span role="alert" class="invalid-feedback">
                                    <strong>{{hasError(errors, 'last_name', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row striped-col required">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="email">Email</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" name="email" id="email"
                                           v-model="item.email"
                                           :class="{'is-invalid': hasError(errors, 'email')}">
                                    <span role="alert" class="invalid-feedback">
                                    <strong>{{hasError(errors, 'email', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row required" v-if="!isEditView(item.id)">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="password">Password</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name="password" id="password"
                                           v-model="item.password"
                                           :class="{'is-invalid': hasError(errors, 'password')}">
                                    <span role="alert" class="invalid-feedback">
                                    <strong>{{hasError(errors, 'password', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row striped-col required" v-if="!isEditView(item.id)">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="password_confirmation">
                                        Confirm Password</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name="password_confirmation"
                                           id="password_confirmation"
                                           v-model="item.password_confirmation"
                                           :class="{'is-invalid': hasError(errors, 'password_confirmation')}">
                                    <span role="alert" class="invalid-feedback">
                                    <strong>{{hasError(errors, 'password_confirmation', true)}}</strong></span>
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
                                        {{ isEditView(item.uuid) ? 'Edit' : 'Create'}}
                                    </button>
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
        name: 'club-members--members-create-and-edit-view-vue',
        props: {},
        mounted() {
            this.edit();
        },
        created() {
            //
        },
        components: {
            //
        },
        data() {
            return {
                database_model: 'club-members/' + MEMBER.UUID + '/members',
                database_model_id: this.getDatabaseModelIdFromUrl(URLPATHNAME),
                item: {},
                errors: {},
            }
        },
        methods: {
            async storeOrUpdate() {
                this.item.admin = $("input[name='admin']:checked").val();

                if (this.database_model_id) {
                    axios.put(`/api/${this.database_model}/${this.database_model_id}`, this.item)
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
                        })
                        .catch(err => {
                            //
                        });

                    return;
                }

                axios.post(`/api/${this.database_model}`, this.item)
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
                    })
                    .catch(err => {
                        //
                    });
            },
            async edit() {
                if (this.database_model_id) {
                    axios.get(`/api/${this.database_model}/${this.database_model_id}`, this.item)
                        .then(response => {
                            this.item = response.data;
                        }, error => {
                            this.errors = error.response.data.error;
                        })
                        .catch(err => {
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
            getDatabaseModelIdFromUrl(url) {
                let index;
                url = url.split('/');
                index = _.findIndex(url, item => item === 'membership-type-names');

                return Number(url[index + 1]);
            },
        }
    }
</script>
