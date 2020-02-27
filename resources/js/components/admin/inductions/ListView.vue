<template>
    <div>
        <div class="col-12">
            <div>This is inductions index page</div>
            <a class="btn btn-primary" @click="clickCreateInduction()">Create</a>
            <ul>
                <li v-for="induction in inductions">
                    {{induction.name}}
                    <a class="btn btn-success" @click="clickShowInduction(induction.id)">Show</a>
                    <a class="btn btn-danger" @click="clickDeleteInduction(induction.id)">Delete</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'inductions-list-view-vue',
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
                inductions: [],
                induction: {},
                errors: {},
            }
        },
        methods: {
            async read() {
                let index = axios.get('/api/inductions')
                    .then(response => {
                        this.inductions = response.data;
                    }, error => {
                        this.errors = error.response.data.error;
                    }).catch(err => {
                        //
                    });
            },
            async clickShowInduction(id) {
                window.location.href = `/admin/inductions/${id}`;
            },
            async clickCreateInduction() {
                window.location.href = `/admin/inductions/create`;
            },
            async clickDeleteInduction(id) {
                let remove = axios.delete(`/api/inductions/${id}`)
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
