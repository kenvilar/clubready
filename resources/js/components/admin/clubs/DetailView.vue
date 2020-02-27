<template>
    <div>
        <div class="col-12">
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
    </div>
</template>

<script>
    export default {
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
                            console.log('this.club', this.club);
                        }, error => {
                            this.errors = error.response.data.error;
                            console.log('this.errors', this.errors);
                        }).catch(err => {
                            //
                        });
                }
            },
        }
    }
</script>
