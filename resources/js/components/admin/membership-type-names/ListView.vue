<template>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <button class="btn btn-success btn-lg btn-block btn-responsive" role="button" @click="clickCreate()">
                    Create New
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ti-align-justify"></i> List
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="datatable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="item in list">
                                    <td>
                                        <span role="link" @click="clickShow(item.id)"
                                              style="text-decoration: underline !important;">
                                            {{item.name}}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-xs" data-toggle="modal"
                                                @click="clickEdit(item.id)"
                                                data-target="#edit" data-placement="top"><span
                                            class="fa fa-fw ti-pencil"></span></button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-xs" data-toggle="modal"
                                                @click="clickDelete(item.id)"
                                                data-target="#delete" data-placement="top"><span
                                            class="fa fa-fw ti-trash"></span></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--<div>
        <div class="col-12">
            <div>This is index page</div>
            <a class="btn btn-primary" @click="clickCreate()">Create</a>
            <ul v-if="list.length">
                <li v-for="item in list">
                    {{item.name}}
                    <a class="btn btn-success" @click="clickShow(item.id)">Show</a>
                    <a class="btn btn-danger" @click="clickDelete(item.id)">Delete</a>
                </li>
            </ul>
        </div>
    </div>-->
</template>

<script>
    export default {
        name: 'membership-type-names-list-view-vue',
        props: {
            //
        },
        mounted() {
            this.read();
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
                list: [],
                item: {},
                errors: {},
            }
        },
        methods: {
            async read() {
                let read = axios.get(`/api/${this.database_model}`)
                    .then(response => {
                        this.list = response.data;
                    }, error => {
                        this.errors = error.response.data.error;
                    }).catch(err => {
                        //
                    });
            },
            async clickShow(id) {
                window.location.href = `/admin/${this.database_model}/${id}`;
            },
            async clickCreate() {
                window.location.href = `/admin/${this.database_model}/create`;
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
                                console.log('response.data', response.data);

                                swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                ).then(response => {
                                    if (response.value) {
                                        this.read();
                                    }
                                });
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
                            }).catch(err => {
                            console.log('err', err.response);
                        });
                    }
                })
            },
            formatDate(date) {
                return date ? moment(date).format('MMMM D, YYYY') : '';
            },
        }
    }
</script>
