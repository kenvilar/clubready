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
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" v-model="item.name">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" v-model="item.address">
                </div>
                <div class="form-group">
                    <label for="suburb">Suburb</label>
                    <input type="text" class="form-control" name="suburb" id="suburb" v-model="item.suburb">
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" class="form-control" name="state" id="state" v-model="item.state">
                </div>
                <div class="form-group">
                    <label for="postcode">Postcode</label>
                    <input type="text" class="form-control" name="postcode" id="postcode" v-model="item.postcode">
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" name="country" id="country" v-model="item.country">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" v-model="item.phone">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" v-model="item.email">
                </div>
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" name="website" id="website" v-model="item.website">
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
                }
                return this.item;
            },
            isEditView(param) {
                return typeof param !== "undefined" || param !== undefined;
            }
        }
    }
</script>
