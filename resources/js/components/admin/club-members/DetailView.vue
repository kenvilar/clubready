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
                                <td v-if="item.user">{{item.user['first_name']}} {{item.user['last_name']}}</td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td v-if="item.user">{{item.user['email']}}</td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td v-if="item.user">{{item.user['address']}}</td>
                            </tr>
                            <tr>
                                <td>Suburb:</td>
                                <td v-if="item.user">{{item.user['suburb']}}</td>
                            </tr>
                            <tr>
                                <td>State:</td>
                                <td v-if="item.user">{{item.user['state']}}</td>
                            </tr>
                            <tr>
                                <td>Postcode:</td>
                                <td v-if="item.user">{{item.user['postcode']}}</td>
                            </tr>
                            <tr>
                                <td>Country:</td>
                                <td v-if="item.user">{{item.user['country']}}</td>
                            </tr>
                            <tr>
                                <td>Phone Home:</td>
                                <td v-if="item.user">{{item.user['phone_home']}}</td>
                            </tr>
                            <tr>
                                <td>Phone Mobile:</td>
                                <td v-if="item.user">{{item.user['phone_mobile']}}</td>
                            </tr>
                            <tr>
                                <td>Alternative Email:</td>
                                <td v-if="item.user">{{item.user['alternative_email']}}</td>
                            </tr>
                            <tr>
                                <td>Date of Birth:</td>
                                <td v-if="item.user">{{formatDate(item.user['date_of_birth'])}}</td>
                            </tr>
                            <tr>
                                <td>Club Racenumber:</td>
                                <td v-if="item.user">{{item.user['club_racenumber']}}</td>
                            </tr>
                            <tr>
                                <td>Member Number:</td>
                                <td v-if="item.user">{{item.user['member_number']}}</td>
                            </tr>
                            <tr>
                                <td>Club:</td>
                                <td v-if="item.club">{{item.club['name']}}</td>
                            </tr>
                            <tr>
                                <td>Admin:</td>
                                <td>{{item.admin == '1' ? 'True' : 'False'}}</td>
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
        name: 'club-members-detail-view-vue',
        props: {
            model_id: {
                type: String,
                default: '',
                required: false
            }
        },
        mounted() {
            this.show();
            this.getCurrentUser();
        },
        created() {
            //
        },
        components: {
            //
        },
        data() {
            return {
                database_model: 'club-members',
                item: {},
                errors: {},
                current_user: {},
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
            async getCurrentUser() {
                axios.get(`/api/user`)
                    .then(response => {
                        this.current_user = response.data;
                    });
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
            formatDate(date) {
                return date ? moment(date).format('MMMM D, YYYY') : '';
            },
        }
    }
</script>
