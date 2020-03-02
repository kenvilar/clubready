<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                This is {{database_model}} {{isEditView(item.id) ? 'edit' : 'create'}} page
            </div>
            <div class="col-5">
                <a class="btn btn-info" onclick="window.history.go(-1)">Back</a>
            </div>
            <div class="col-5">
                <div class="form-group required">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" v-model="item.name"
                           :class="{'is-invalid': hasError(errors, 'name')}">
                    <span role="alert" class="invalid-feedback">
                        <strong>{{hasError(errors, 'name', true)}}</strong></span>
                </div>
                <div class="form-group required">
                    <label for="value">Value</label>
                    <input type="number" step="0.01" class="form-control" name="value" id="value" v-model="item.value"
                           :class="{'is-invalid': hasError(errors, 'value')}">
                    <span role="alert" class="invalid-feedback">
                        <strong>{{hasError(errors, 'value', true)}}</strong></span>
                </div>
                <div class="form-group required">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" name="start_date" id="start_date" v-model="item.start_date"
                           pattern="\d{4}-\d{2}-\d{2}"
                           :class="{'is-invalid': hasError(errors, 'start_date')}">
                    <span role="alert" class="invalid-feedback">
                        <strong>{{hasError(errors, 'start_date', true)}}</strong></span>
                </div>
                <div class="form-group required">
                    <label for="expiry_date">Expiry Date</label>
                    <input type="date" class="form-control" name="expiry_date" id="expiry_date" v-model="item.expiry_date"
                           :class="{'is-invalid': hasError(errors, 'expiry_date')}">
                    <span role="alert" class="invalid-feedback">
                        <strong>{{hasError(errors, 'expiry_date', true)}}</strong></span>
                </div>
                <div class="form-group">
                    <button @click="storeOrUpdate">{{ isEditView(item.id) ? 'Update' : 'Create'}}</button>
                </div>
            </div>
        </div>
    </div>
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
