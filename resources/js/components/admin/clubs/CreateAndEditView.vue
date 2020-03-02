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
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" v-model="item.address"
                           :class="{'is-invalid': hasError(errors, 'address')}">
                    <span role="alert" class="invalid-feedback">
                        <strong>{{hasError(errors, 'address', true)}}</strong></span>
                </div>
                <div class="form-group required">
                    <label for="suburb">Suburb</label>
                    <input type="text" class="form-control" name="suburb" id="suburb" v-model="item.suburb"
                           :class="{'is-invalid': hasError(errors, 'suburb')}">
                    <span role="alert" class="invalid-feedback">
                        <strong>{{hasError(errors, 'suburb', true)}}</strong></span>
                </div>
                <div class="form-group required">
                    <label for="state">State</label>
                    <input type="text" class="form-control" name="state" id="state" v-model="item.state"
                           :class="{'is-invalid': hasError(errors, 'state')}">
                    <span role="alert" class="invalid-feedback">
                        <strong>{{hasError(errors, 'state', true)}}</strong></span>
                </div>
                <div class="form-group required">
                    <label for="postcode">Postcode</label>
                    <input type="text" class="form-control" name="postcode" id="postcode" v-model="item.postcode"
                           :class="{'is-invalid': hasError(errors, 'postcode')}">
                    <span role="alert" class="invalid-feedback">
                        <strong>{{hasError(errors, 'postcode', true)}}</strong></span>
                </div>
                <div class="form-group required">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" name="country" id="country" v-model="item.country"
                           :class="{'is-invalid': hasError(errors, 'country')}">
                    <span role="alert" class="invalid-feedback">
                        <strong>{{hasError(errors, 'country', true)}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" v-model="item.phone"
                           :class="{'is-invalid': hasError(errors, 'phone')}">
                    <span role="alert" class="invalid-feedback">
                        <strong>{{hasError(errors, 'phone', true)}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" v-model="item.email"
                           :class="{'is-invalid': hasError(errors, 'email')}">
                    <span role="alert" class="invalid-feedback">
                        <strong>{{hasError(errors, 'email', true)}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" name="website" id="website" v-model="item.website"
                           :class="{'is-invalid': hasError(errors, 'website')}">
                    <span role="alert" class="invalid-feedback">
                        <strong>{{hasError(errors, 'website', true)}}</strong></span>
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
        name: 'clubs-create-and-edit-view-vue',
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
                database_model: 'clubs',
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
