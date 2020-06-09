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
        name: 'club-members--vehicles-create-and-edit-view-vue',
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
                database_model: 'club-members/' + MEMBER.UUID + '/vehicles',
                database_model_id: this.getDatabaseModelIdFromUrl(URLPATHNAME),
                item: {},
                errors: {},
            }
        },
        methods: {
            async storeOrUpdate() {
                if (this.database_model_id) {
                    let update = axios.put(`/api/${this.database_model}/${this.database_model_id}`, this.item)
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
                index = _.findIndex(url, item => item === 'vehicles');

                return Number(url[index + 1]);
            },
        }
    }
</script>
