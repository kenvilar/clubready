<template>
    <!--<div>
        <div class="col-12">
            <div>This is index page</div>
            <a class="btn btn-primary" @click="clickCreate()">Create</a>
            <ul v-if="list.length">
                <li v-for="item in list">
                    {{item.first_name}} {{item.last_name}}
                    <a class="btn btn-success" @click="clickShow(item.member_number)">Show</a>
                    <a class="btn btn-danger" @click="clickDelete(item.member_number)">Delete</a>
                </li>
            </ul>
        </div>
    </div>-->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ti-align-justify"></i> Users List
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="datatable">
                                <thead>
                                <tr>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Email</th>
                                    <th>Created Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="item in list">
                                    <td>
                                        <span role="link" @click="clickShow(item.member_number)"
                                           style="text-decoration: underline !important;">
                                            {{item.first_name}}
                                        </span>
                                    </td>
                                    <td>{{item.last_name}}</td>
                                    <td>{{item.email}}</td>
                                    <td>{{formatDate(item.created_at)}}</td>
                                    <td>
                                        <button class="btn btn-primary btn-xs" data-toggle="modal"
                                                @click="clickShow(item.member_number)"
                                                data-target="#edit" data-placement="top"><span
                                            class="fa fa-fw ti-pencil"></span></button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-xs" data-toggle="modal"
                                                @click="clickDelete(item.member_number)"
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
</template>

<script>
    const moment = require('moment');

    export default {
        name: 'users-list-view-vue',
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
                database_model: 'users',
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
            async clickDelete(id) {
                let remove = axios.delete(`/api/${this.database_model}/${id}`)
                    .then(response => {
                        console.log('response.data', response.data);
                    }, error => {
                        this.errors = error.response.data;
                        console.log('this.errors', this.errors);
                    }).catch(err => {
                        console.log('err', err.response);
                    });
                this.read();
            },
            formatDate(date) {
                return moment(date).format('MMMM D, YYYY');
            },
        }
    }
</script>
