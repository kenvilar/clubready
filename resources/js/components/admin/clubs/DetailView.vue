<template>
    <section class="content p-l-r-15" id="invoice-stmt">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ti-align-justify"></i> Details
                </h3>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <p>
                        <a class="btn btn-success" @click="clickEdit(item.uuid)">Edit</a>
                        <a class="btn btn-danger" @click="clickDelete(item.uuid)">Delete</a>
                    </p>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-condensed" id="customtable">
                            <tbody>
                            <tr>
                                <td>Name:</td>
                                <td>{{item.name}}</td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td>{{item.address}}</td>
                            </tr>
                            <tr>
                                <td>Suburb:</td>
                                <td>{{item.suburb}}</td>
                            </tr>
                            <tr>
                                <td>State:</td>
                                <td>{{item.state}}</td>
                            </tr>
                            <tr>
                                <td>Postcode:</td>
                                <td>{{item.postcode}}</td>
                            </tr>
                            <tr>
                                <td>Country:</td>
                                <td>{{item.country}}</td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td>{{item.phone}}</td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>{{item.email}}</td>
                            </tr>
                            <tr>
                                <td>Website:</td>
                                <td>{{item.website}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <p>
                        <a class="btn btn-success" @click="clickEdit(item.uuid)">Edit</a>
                        <a class="btn btn-danger" @click="clickDelete(item.uuid)">Delete</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: 'clubs-detail-view-vue',
        props: {
            model_id: {
                type: String,
                default: '',
                required: false
            }
        },
        mounted() {
            this.show();
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
            async show() {
                if (this.model_id) {
                    let show = axios.get(`/api/${this.database_model}/${this.model_id}`)
                        .then(response => {
                            this.item = response.data;
                        }, error => {
                            this.errors = error.response.data.error;
                            console.log('this.errors', this.errors);
                        }).catch(err => {
                            //
                        });
                }
            },
            async clickEdit(id) {
                window.location.href = `/admin/${this.database_model}/${id}/edit`;
            },
            async clickDelete(id) {
                let remove = axios.delete(`/api/${this.database_model}/${id}`)
                    .then(response => {
                        if (response.data) {
                            window.location.href = `/admin/${this.database_model}`;
                        }
                    }, error => {
                        this.errors = error.response.data;
                        console.log('this.errors', this.errors);
                    }).catch(err => {
                        console.log('err', err.response);
                    });
            },
        }
    }
</script>
