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
                                    <label class="form-control-label" for="value">Value</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="number" step="0.01" class="form-control" name="value" id="value"
                                           v-model="item.value"
                                           :class="{'is-invalid': hasError(errors, 'value')}">
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'value', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row striped-col required">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="start_date">Start Date</label>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-fw ti-calendar"></i></div>
                                        <input type="text" class="form-control" name="start_date"
                                               id="start_date"
                                               v-model="item.start_date"
                                               :class="{'is-invalid': hasError(errors, 'start_date')}"
                                               placeholder="Select Date (MM/DD/YYYY)">
                                        <span role="alert" class="invalid-feedback">
                                            <strong>{{hasError(errors, 'start_date', true)}}</strong></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row required">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="expiry_date">Expiry Date</label>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-fw ti-calendar"></i></div>
                                        <input type="text" class="form-control" name="expiry_date"
                                               id="expiry_date"
                                               v-model="item.expiry_date"
                                               :class="{'is-invalid': hasError(errors, 'expiry_date')}"
                                               placeholder="Select Date (MM/DD/YYYY)">
                                        <span role="alert" class="invalid-feedback">
                                            <strong>{{hasError(errors, 'expiry_date', true)}}</strong></span>
                                    </div>
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
        name: 'club-members--membership-types-create-and-edit-view-vue',
        props: {},
        mounted() {
            this.edit();

            $("#start_date").dateDropper({
                format: "m/d/Y",
                dropPrimaryColor: "#6699cc",
                fx: false,
                fxMobile: false,
                animate: false,
            });

            $("#expiry_date").dateDropper({
                format: "m/d/Y",
                dropPrimaryColor: "#6699cc",
                fx: false,
                fxMobile: false,
                animate: false,
            });
        },
        created() {
            //
        },
        components: {
            //
        },
        data() {
            return {
                database_model: 'club-members/' + MEMBER.UUID + '/membership-types',
                database_model_id: this.getDatabaseModelIdFromUrl(URLPATHNAME),
                item: {},
                errors: {},
            }
        },
        methods: {
            async storeOrUpdate() {
                this.item.start_date = moment($('#start_date').val()).format("MM/DD/YYYY");
                this.item.expiry_date = moment($('#expiry_date').val()).format("MM/DD/YYYY");

                if (this.database_model_id) {
                    let update = axios.put(`/api/${this.database_model}/${this.database_model_id}`, this.item)
                        .then(response => {
                            this.item = response.data;

                            swal.fire({
                                icon: 'success',
                                title: "Success",
                                text: "Membership type has been updated successfully.",
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
                            text: "New membership type has been created successfully.",
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
                index = _.findIndex(url, item => item === 'membership-types');

                return Number(url[index + 1]);
            },
        }
    }
</script>
