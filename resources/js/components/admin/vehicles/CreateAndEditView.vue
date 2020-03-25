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
                                    <label class="form-control-label" for="user_id">User ID</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="user_id" id="user_id"
                                           v-model="item.user_id"
                                           :class="{'is-invalid': hasError(errors, 'user_id')}">
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'user_id', true)}}</strong></span>
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
    <!--<div>
        <div class="row">
            <div class="col-md-12">
                This is {{database_model}} {{isEditView(item.id) ? 'edit' : 'create'}} page
            </div>
            <div class="col-5">
                <a class="btn btn-info" onclick="window.history.go(-1)">Back</a>
            </div>
            <div class="col-5">
                <div class="form-group required">
                    <label for="user_id">User ID</label>
                    <input type="number" class="form-control" name="user_id" id="user_id" v-model="item.user_id"
                           :class="{'is-invalid': hasError(errors, 'user_id')}">
                    <span role="alert" class="invalid-feedback">
                        <strong>{{hasError(errors, 'user_id', true)}}</strong></span>
                </div>
                <div class="form-group required">
                    <label for="make">Make</label>
                    <input type="text" class="form-control" name="make" id="make" v-model="item.make"
                           :class="{'is-invalid': hasError(errors, 'make')}">
                    <span role="alert" class="invalid-feedback">
                        <strong>{{hasError(errors, 'make', true)}}</strong></span>
                </div>
                <div class="form-group required">
                    <label for="model">Model</label>
                    <input type="text" class="form-control" name="model" id="model" v-model="item.model"
                           :class="{'is-invalid': hasError(errors, 'model')}">
                    <span role="alert" class="invalid-feedback">
                        <strong>{{hasError(errors, 'model', true)}}</strong></span>
                </div>
                <div class="form-group required">
                    <label for="year">Year</label>
                    <input type="text" class="form-control" name="year" id="year" v-model="item.year"
                           :class="{'is-invalid': hasError(errors, 'year')}">
                    <span role="alert" class="invalid-feedback">
                        <strong>{{hasError(errors, 'year', true)}}</strong></span>
                </div>
                <div class="form-group required">
                    <label for="capacity">Capacity</label>
                    <input type="text" class="form-control" name="capacity" id="capacity" v-model="item.capacity"
                           :class="{'is-invalid': hasError(errors, 'capacity')}">
                    <span role="alert" class="invalid-feedback">
                        <strong>{{hasError(errors, 'capacity', true)}}</strong></span>
                </div>
                <div class="form-group required">
                    <label for="induction">Induction</label>
                    <input type="text" class="form-control" name="induction" id="induction" v-model="item.induction"
                           :class="{'is-invalid': hasError(errors, 'induction')}">
                    <span role="alert" class="invalid-feedback">
                        <strong>{{hasError(errors, 'induction', true)}}</strong></span>
                </div>
                <div class="form-group">
                    <button @click="storeOrUpdate">{{ isEditView(item.id) ? 'Update' : 'Create'}}</button>
                </div>
            </div>
        </div>
    </div>-->
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
                    .then(response => {
                        console.log('response', response);
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
