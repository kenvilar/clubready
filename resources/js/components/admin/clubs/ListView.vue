<template>
    <div>
        <div class="col-12">
            <div>This is index page</div>
            <a class="btn btn-primary" @click="clickCreate()">Create</a>
            <ul v-if="list.length">
                <li v-for="item in list">
                    {{item.name}}
                    <a class="btn btn-success" @click="clickShow(item.id)">Show</a>
                    <a class="btn btn-danger" @click="clickDelete(item.id)">Delete</a>
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
                database_model: 'clubs',
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
            async clickEdit() {
                window.location.href = `/admin/${this.database_model}/edit`;
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
        }
    }
</script>
