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
                        <a class="btn btn-success" @click="clickEdit(item.id)">Edit</a>
                        <a class="btn btn-danger" @click="clickDelete(item.id)">Delete</a>
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
                                <td>Year:</td>
                                <td>{{item.year}}</td>
                            </tr>
                            <tr>
                                <td>Amount:</td>
                                <td>{{item.amount}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <p>
                        <a class="btn btn-success" @click="clickEdit(item.id)">Edit</a>
                        <a class="btn btn-danger" @click="clickDelete(item.id)">Delete</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: 'club-members--memberships-detail-view-vue',
        props: {},
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
                database_model: 'club-members/' + MEMBER.UUID + '/memberships',
                database_model_id: this.getDatabaseModelIdFromUrl(URLPATHNAME),
                item: {},
                errors: {},
            }
        },
        methods: {
            async show() {
                if (this.database_model_id) {
                    let show = axios.get(`/api/${this.database_model}/${this.database_model_id}`)
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
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(result => {
                    if (result.value) {
                        axios.delete(`/api/${this.database_model}/${id}`)
                            .then(response => {
                                if (response.data) {
                                    window.location.href = `/admin/${this.database_model}`;
                                }
                            }, error => {
                                this.errors = error.response.data;
                                if (this.errors.error === "Cannot remove this resource permanently. It is related with any other resource") {
                                    swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Cannot remove this item. It is related with any other resource!',
                                    });
                                }
                                console.log('this.errors', this.errors);
                            })
                            .catch(err => {
                                console.log('err', err.response);
                            });
                    }
                });
            },
            getDatabaseModelIdFromUrl(url) {
                let index;
                url = url.split('/');
                index = _.findIndex(url, item => item === 'memberships');

                return Number(url[index + 1]);
            },
        }
    }
</script>
