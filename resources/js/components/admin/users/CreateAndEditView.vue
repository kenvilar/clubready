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
                            <div class="form-group row">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="address">Address</label>
                                </div>
                                <div class="col-sm-6">
                                <textarea class="form-control" name="address" id="address" cols="30" rows="10"
                                          v-model="item.address"
                                          :class="{'is-invalid': hasError(errors, 'address')}"></textarea>
                                    <span role="alert" class="invalid-feedback">
                                    <strong>{{hasError(errors, 'address', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row striped-col">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="suburb">Suburb</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="suburb" id="suburb"
                                           v-model="item.suburb"
                                           :class="{'is-invalid': hasError(errors, 'suburb')}">
                                    <span role="alert" class="invalid-feedback">
                                    <strong>{{hasError(errors, 'suburb', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="state">State</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="state" id="state"
                                           v-model="item.state"
                                           :class="{'is-invalid': hasError(errors, 'state')}">
                                    <span role="alert" class="invalid-feedback">
                                    <strong>{{hasError(errors, 'state', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row striped-col">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="postcode">Postcode</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="postcode" id="postcode"
                                           v-model="item.postcode"
                                           :class="{'is-invalid': hasError(errors, 'postcode')}">
                                    <span role="alert" class="invalid-feedback">
                                    <strong>{{hasError(errors, 'postcode', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="country">Country</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="country" id="country"
                                           v-model="item.country"
                                           :class="{'is-invalid': hasError(errors, 'country')}">
                                    <span role="alert" class="invalid-feedback">
                                    <strong>{{hasError(errors, 'country', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row striped-col">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="phone_home">Phone Home</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="phone_home" id="phone_home"
                                           v-model="item.phone_home"
                                           :class="{'is-invalid': hasError(errors, 'phone_home')}">
                                    <span role="alert" class="invalid-feedback">
                                    <strong>{{hasError(errors, 'phone_home', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="phone_mobile">Phone Mobile</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="phone_mobile" id="phone_mobile"
                                           v-model="item.phone_mobile"
                                           :class="{'is-invalid': hasError(errors, 'phone_mobile')}">
                                    <span role="alert" class="invalid-feedback">
                                    <strong>{{hasError(errors, 'phone_mobile', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row striped-col">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="alternative_email">
                                        Alternative Email</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" name="alternative_email"
                                           id="alternative_email"
                                           v-model="item.alternative_email"
                                           :class="{'is-invalid': hasError(errors, 'alternative_email')}">
                                    <span role="alert" class="invalid-feedback">
                                    <strong>{{hasError(errors, 'alternative_email', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="date_of_birth">Date of Birth</label>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-fw ti-calendar"></i></div>
                                        <input class="form-control" name="date_of_birth"
                                               id="date_of_birth"
                                               v-model="item.date_of_birth"
                                               :class="{'is-invalid': hasError(errors, 'date_of_birth')}"
                                               placeholder="Select Date (d/m/Y)">
                                    </div>
                                    <span role="alert" class="invalid-feedback">
                                    <strong>{{hasError(errors, 'date_of_birth', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row striped-col">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="club_racenumber">Club Racenumber</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="club_racenumber"
                                           id="club_racenumber"
                                           v-model="item.club_racenumber"
                                           :class="{'is-invalid': hasError(errors, 'club_racenumber')}">
                                    <span role="alert" class="invalid-feedback">
                                    <strong>{{hasError(errors, 'club_racenumber', true)}}</strong></span>
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
        name: 'users-create-and-edit-view-vue',
        props: {
            model_id: {
                type: String,
                default: '',
                required: false
            }
        },
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
                database_model: 'users',
                item: {},
                errors: {},
            }
        },
        methods: {
            async storeOrUpdate() {
                if (this.model_id) {
                    let update = axios.put(`/api/${this.database_model}/${this.model_id}`, this.item)
                        .then(response => {
                            this.item = response.data;
                            window.location.href = `/admin/${this.database_model}/${this.model_id}`;
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
                        //clear all the fields after successful create
                        this.clearFields(this.item);
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
            isEditView(param) {
                return typeof param !== "undefined" || param !== undefined;
            },
            hasError(errors, name, showResult = false) {
                if (showResult === true) {
                    return typeof errors[name] == 'undefined' ? (typeof errors === 'string' ? errors : '') : errors[name][0];
                }

                return typeof errors[name] == 'undefined' ? (typeof errors === 'string' ? errors : '') : errors[name];
            },
        }
    }
</script>
