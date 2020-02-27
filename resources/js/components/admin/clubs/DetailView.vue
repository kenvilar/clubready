<template>
    <div>
        <div class="col-md-12">
            <a class="btn btn-info" :href="'/clubs/'">Back</a>
        </div>
        <div class="col-md-12">
            This is clubs show page
            <div>Name: {{club.name}}</div>
            <div>Address: {{club.address}}</div>
            <div>Suburb: {{club.suburb}}</div>
            <div>State: {{club.state}}</div>
            <div>Post Code: {{club.postcode}}</div>
            <div>Country: {{club.country}}</div>
            <div>Phone: {{club.phone}}</div>
            <div>Email: {{club.email}}</div>
            <div>Website: {{club.website}}</div>
        </div>
        <div class="col-md-12">
            <a class="btn btn-success" @click="clickEditClub(club.id)">Edit</a>
            <a class="btn btn-danger" @click="clickDeleteClub(club.id)">Delete</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'clubs-detail-view-vue',
        props: {
            club_id: {
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
                club: {},
                errors: {},
            }
        },
        methods: {
            async show() {
                if (this.club_id) {
                    let club_edit = axios.get(`/api/clubs/${this.club_id}`)
                        .then(response => {
                            this.club = response.data;
                        }, error => {
                            this.errors = error.response.data.error;
                            console.log('this.errors', this.errors);
                        }).catch(err => {
                            //
                        });
                }
            },
            async clickEditClub(id) {
                window.location.href = `/clubs/${id}/edit`;
            },
            async clickDeleteClub(id) {
                let remote = axios.delete(`/api/clubs/${id}`)
                    .then(response => {
                        console.log('response.data', response.data);
                        if (response.data) {
                            window.location.href = '/clubs';
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
                    this.club = {};
                }
                return this.club;
            },
        }
    }
</script>
