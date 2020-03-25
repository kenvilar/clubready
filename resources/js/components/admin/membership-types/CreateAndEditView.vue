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
                                    <input type="date" class="form-control" name="start_date" id="start_date"
                                           v-model="item.start_date"
                                           pattern="\d{4}-\d{2}-\d{2}"
                                           :class="{'is-invalid': hasError(errors, 'start_date')}">
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'start_date', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row required">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="expiry_date">Expiry Date</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" name="expiry_date" id="expiry_date"
                                           v-model="item.expiry_date"
                                           :class="{'is-invalid': hasError(errors, 'expiry_date')}">
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'expiry_date', true)}}</strong></span>
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
        name: 'membership-types-create-and-edit-view-vue',
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
                database_model: 'membership-types',
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
