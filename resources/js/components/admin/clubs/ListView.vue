<template>
    <div>
        <div class="col-12">
            <div>This is clubs index page</div>
            <a class="btn btn-primary" @click="clickCreateClub()">Create Club</a>
            <ul>
                <li v-for="club in clubs">
                    {{club.name}}
                    <a class="btn btn-success" @click="clickEditClub(club.id)">Edit</a>
                    <a class="btn btn-danger" @click="clickDeleteClub(club.id)">Delete</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'clubs-list-view-vue',
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
            async clickEditClub(id) {
                window.location.href = `/admin/clubs/${id}`;
            },
            async clickCreateClub() {
                window.location.href = `/admin/clubs/create`;
            },
            async clickDeleteClub(id) {
                let remove = axios.delete(`/api/clubs/${id}`)
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
        }
    }
</script>
