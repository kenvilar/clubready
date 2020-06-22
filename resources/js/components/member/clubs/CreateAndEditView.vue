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
                                    <label class="form-control-label" for="name">Name</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="name" id="name"
                                           v-model="item.name"
                                           :class="{'is-invalid': hasError(errors, 'name')}">
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'name', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row required">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="address">Address</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="address" id="address"
                                           v-model="item.address"
                                           :class="{'is-invalid': hasError(errors, 'address')}">
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'address', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row striped-col required">
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
                            <div class="form-group row required">
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
                            <div class="form-group row striped-col required">
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
                            <div class="form-group row required">
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
                                    <label class="form-control-label" for="phone">Phone</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="phone" id="phone"
                                           v-model="item.phone"
                                           :class="{'is-invalid': hasError(errors, 'phone')}">
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'phone', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row">
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
                            <div class="form-group row striped-col">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="website">Website</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="website" id="website"
                                           v-model="item.website"
                                           :class="{'is-invalid': hasError(errors, 'website')}">
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'website', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3 ml-auto">
                                    <button type="submit"
                                            class="btn btn-effect-ripple btn-primary">
                                        {{ isEditView(item.id) ? 'Edit' : 'Create'}}
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
        name: 'club-members--clubs-create-and-edit-view-vue',
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
                database_model: 'club-members/' + MEMBER.UUID + '/clubs',
                database_model_id: this.getDatabaseModelIdFromUrl(URLPATHNAME),
                item: {},
                errors: {},
            }
        },
        methods: {
            async storeOrUpdate() {
                axios.put(`/api/${this.database_model}/${this.database_model_id}`, this.item)
                    .then(response => {
                        this.item = response.data;

                        swal.fire({
                            icon: 'success',
                            title: "Success",
                            text: "Club has been updated successfully.",
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
            },
            async edit() {
                if (this.database_model_id) {
                    let edit = axios.get(`/api/${this.database_model}/${this.database_model_id}`, this.item)
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
            automaticFocusTheFirstInput() {
                setTimeout(() => {
                    $('input:visible:enabled').toggleClass('focus-visible');
                    $('form:first *:input[type!=hidden]:first').focus();
                }, 300);
            },
            getDatabaseModelIdFromUrl(url) {
                let index;
                url = url.split('/');
                index = _.findIndex(url, item => item === 'clubs');

                return url[index + 1];
            },
        }
    }
</script>
