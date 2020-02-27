<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                This is inductions {{isEditView(induction.id) ? 'edit' : 'create'}} page
            </div>
            <div class="col-5">
                <a class="btn btn-info" onclick="window.history.go(-1)">Back</a>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" v-model="induction.name">
                </div>
                <div class="form-group">
                    <button @click="storeOrUpdate">{{ isEditView(induction.id) ? 'Update' : 'Create'}}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'inductions-create-and-edit-view-vue',
        props: {
            induction_id: {
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
                induction: {},
                errors: {},
            }
        },
        methods: {
            async storeOrUpdate() {
                if (this.induction_id) {
                    let induction_update = axios.put(`/api/inductions/${this.induction_id}`, this.induction)
                        .then(response => {
                            this.induction = response.data;
                            window.location.href = `/admin/inductions/${this.induction_id}`;
                        }, error => {
                            this.errors = error.response.data.error;
                        }).catch(err => {
                            //
                        });

                    return;
                }

                let induction_store = axios.post('/api/inductions', this.induction)
                    .then(response => {
                        //clear all the fields after successful create
                        this.clearFields(this.induction);
                    }, error => {
                        this.errors = error.response.data.error;
                    }).catch(err => {
                        //
                    });
            },
            async edit() {
                if (this.induction_id) {
                    let induction_edit = axios.get(`/api/inductions/${this.induction_id}`, this.induction)
                        .then(response => {
                            this.induction = response.data;
                        }, error => {
                            this.errors = error.response.data.error;
                        }).catch(err => {
                            //
                        });
                }
            },
            async clearFields(param) {
                if (param) {
                    this.induction = {};
                }
                return this.induction;
            },
            isEditView(param) {
                return typeof param !== "undefined" || param !== undefined;
            }
        }
    }
</script>
