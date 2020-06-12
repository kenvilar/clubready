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
                    <div class="table-responsive">
                        <table class="table table-striped table-condensed" id="customtable">
                            <tbody>
                            <tr>
                                <td>User:</td>
                                <td>{{item.club_member.user.first_name + ' ' + item.club_member.user.last_name}}</td>
                            </tr>
                            <tr>
                                <td>Make:</td>
                                <td>{{item.make}}</td>
                            </tr>
                            <tr>
                                <td>Model:</td>
                                <td>{{item.model}}</td>
                            </tr>
                            <tr>
                                <td>Year:</td>
                                <td>{{item.year}}</td>
                            </tr>
                            <tr>
                                <td>Capacity:</td>
                                <td>{{item.capacity}}</td>
                            </tr>
                            <tr>
                                <td>Induction:</td>
                                <td>{{item.induction}}</td>
                            </tr>
                            <tr>
                                <td>Created Date:</td>
                                <td>{{formatDate(item.created_at)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: 'vehicles-detail-view-vue',
        props: {
            model_id: {
                type: Number,
                default: 0,
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
                database_model: 'vehicles',
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
            formatDate(date) {
                return date ? moment(date).format('MMMM D, YYYY') : '';
            },
        }
    }
</script>
