<template>
    <div>
        <div class="col-md-12">
            My profile page
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
    </div>
</template>

<script>
    export default {
        name: 'users-current-user-info-vue',
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
                database_model: 'users',
                item: {},
                errors: {},
            }
        },
        methods: {
            async show() {
                let show = axios.get(`/api/${this.database_model}/my-info`)
                    .then(response => {
                        this.item = response.data;
                    }, error => {
                        this.errors = error.response.data.error;
                        console.log('this.errors', this.errors);
                    }).catch(err => {
                        //
                    });
            },
        }
    }
</script>
