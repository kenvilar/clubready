<template>
    <div>
        <div class="col-md-12">
            <a class="btn btn-info" :href="`/admin/${database_model}`">Back</a>
        </div>
        <div class="col-md-12">
            This is {{database_model}} show page
            <div>First Name: {{item.first_name}}</div>
            <div>Last Name: {{item.last_name}}</div>
            <div>Email: {{item.email}}</div>
            <div>Address: {{item.address}}</div>
            <div>Suburb: {{item.suburb}}</div>
            <div>State: {{item.state}}</div>
            <div>Postcode: {{item.postcode}}</div>
            <div>Country: {{item.country}}</div>
            <div>Phone Home: {{item.phone_home}}</div>
            <div>Phone Mobile: {{item.phone_mobile}}</div>
            <div>Alternative Email: {{item.alternative_email}}</div>
            <div>Date of Birth: {{item.date_of_birth}}</div>
            <div>Club Racenumber: {{item.club_racenumber}}</div>
        </div>
        <div class="col-md-12">
            <a class="btn btn-success" @click="clickEdit(item.id)">Edit</a>
            <a class="btn btn-danger" @click="clickDelete(item.id)">Delete</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'users-detail-view-vue',
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
                database_model: 'users',
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
            async clearFields(param) {
                if (param) {
                    this.item = {};
                    this.errors = {};
                }
                return this.item;
            },
        }
    }
</script>
