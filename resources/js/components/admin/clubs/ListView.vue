<template>
    <div>
        <div class="col-12">
            This is clubs index page
            <ul>
                <li v-for="club in clubs">{{club.name}}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
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
                clubs: [],
                club: {},
                errors: {},
            }
        },
        methods: {
            async read() {
                let index = axios.get('/api/clubs')
                    .then(response => {
                        this.clubs = response.data;
                    }, error => {
                        this.errors = error.response.data.error;
                    }).catch(err => {
                        //
                    });
            },
        }
    }
</script>
