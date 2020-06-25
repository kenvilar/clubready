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
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Admin</th>
                                    <th>Created Date</th>
                                    <th v-if="isActiveUsersPage">Edit</th>
                                    <th>
                                        <span v-if="isActiveUsersPage">Deactivate</span>
                                        <span v-else>Activate</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="item in list" :key="item.id">
                                    <td>{{item.id}}</td>
                                    <td>
                                        <span role="link" @click="clickShow(item.uuid)"
                                              style="text-decoration: underline !important;">
                                            {{item.user['first_name']}} {{item.user['last_name']}}
                                        </span>
                                    </td>
                                    <td>{{item.admin == '1' ? 'True' : 'False'}}</td>
                                    <td>{{formatDate(item.created_at)}}</td>
                                    <td v-if="isActiveUsersPage">
                                        <button class="btn btn-primary btn-xs" data-toggle="modal"
                                                @click="clickEdit(item.uuid)"
                                                data-target="#edit" data-placement="top"><span
                                            class="fa fa-fw ti-pencil"></span></button>
                                    </td>
                                    <td>
                                        <button v-if="isActiveUsersPage" class="btn btn-danger btn-xs"
                                                data-toggle="modal"
                                                @click="clickDelete(item.uuid, item.admin)"
                                                data-target="#delete" data-placement="top"><span
                                            class="fa fa-fw ti-trash"></span></button>
                                        <button v-else class="btn btn-info btn-xs" data-toggle="modal"
                                                @click="clickActivate(item.uuid, item.admin)"
                                                data-target="#delete" data-placement="top"><span
                                            class="fa fa-fw ti-check"></span>
                                        </button>
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
</template>

<script>
    export default {
        name: 'club-members--members-list-view-vue',
        props: {},
        mounted() {
            this.read();
        },
        created() {
        },
        components: {},
        data() {
            return {
                database_model: 'club-members/' + MEMBER.UUID + '/members',
                database_model_for_delete: 'club-members/' + MEMBER.UUID + '/unverified-user',
                list: [],
                item: {},
                errors: {},
                isActiveUsersPage: true,
            }
        },
        methods: {
            async read() {
                axios.get(`/api/${this.database_model}`)
                    .then(response => {
                        this.list = _.filter(response.data, ['verified', "1"]);

                        let userUrlParams = new URLSearchParams(window.location.search);
                        if (userUrlParams.has('users')) {
                            if (userUrlParams.get('users') === 'deleted') {
                                this.isActiveUsersPage = false;
                                this.list = _.filter(response.data, ['verified', "0"]);
                            }
                        }
                    }, error => {
                        this.errors = error.response.data.error;
                    })
                    .catch(err => {
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
            async clickDelete(uuid, admin) {
                swal.fire({
                    title: 'Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, deactivate it!'
                }).then(result => {
                    if (result.value) {
                        let options = {
                            verified: "0",
                            admin: admin,
                        };
                        axios.put(`/api/${this.database_model}/${uuid}`, options)
                            .then(response => {
                                this.item = response.data;

                                swal.fire({
                                    icon: 'success',
                                    title: "Success",
                                    text: "Item has been deactivated.",
                                    type: "success",
                                }).then(result => {
                                    if (result.value) {
                                        this.read();
                                    }
                                });
                            }, error => {
                                this.errors = error.response.data.error;
                                console.log('this.errors', this.errors);
                            })
                            .catch(err => {
                                //
                            });
                    }
                })
            },
            async clickActivate(uuid, admin) {
                swal.fire({
                    title: 'Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, activate it!'
                }).then(result => {
                    if (result.value) {
                        let options = {
                            verified: "1",
                            admin: admin,
                        };
                        axios.put(`/api/${this.database_model}/${uuid}`, options)
                            .then(response => {
                                this.item = response.data;

                                swal.fire({
                                    icon: 'success',
                                    title: "Success",
                                    text: "Club member has been activated successfully.",
                                    type: "success",
                                }).then(result => {
                                    if (result.value) {
                                        this.read();
                                    }
                                });
                            }, error => {
                                this.errors = error.response.data.error;
                                console.log('this.errors', this.errors);
                            }).catch(err => {
                            //
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
