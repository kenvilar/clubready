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
                <div class="form-group">
                    <button @click="storeOrUpdate">{{ isEditView(item.id) ? 'Update' : 'Create'}}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'membership-type-names-create-and-edit-view-vue',
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
                database_model: 'membership-type-names',
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
