<template>
    <div>
        <div class="row">
            <div class="col-5">
                <a class="btn btn-info" onclick="window.history.go(-1)">Back</a>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" v-model="club.name">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" v-model="club.address">
                </div>
                <div class="form-group">
                    <label for="suburb">Suburb</label>
                    <input type="text" class="form-control" name="suburb" id="suburb" v-model="club.suburb">
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" class="form-control" name="state" id="state" v-model="club.state">
                </div>
                <div class="form-group">
                    <label for="postcode">Postcode</label>
                    <input type="text" class="form-control" name="postcode" id="postcode" v-model="club.postcode">
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" name="country" id="country" v-model="club.country">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" v-model="club.phone">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" v-model="club.email">
                </div>
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" name="website" id="website" v-model="club.website">
                </div>
                <div class="form-group">
                    <button @click="storeOrUpdate">Create</button>
                </div>
            </div>
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
            this.edit();
        },
        created() {
            //
        },
        components: {
            //
        },
        data() {
            return {
                club: {
                    name: '',
                    address: '',
                    suburb: '',
                    state: '',
                    postcode: '',
                    country: '',
                    phone: '',
                    email: '',
                    website: '',
                },
                errors: {},
            }
        },
        methods: {
            async storeOrUpdate() {
                if (this.club_id) {
                    let club_update = axios.put(`/api/clubs/${this.club_id}`, this.club)
                        .then(response => {
                            this.club = response.data;
                            window.location.href = `/clubs/${this.club_id}`;
                        }, error => {
                            this.errors = error.response.data.error;
                        }).catch(err => {
                            //
                        });

                    return;
                }

                let club_store = axios.post('/api/clubs', this.club)
                    .then(response => {
                        //clear all the fields after successful create
                        this.clearFields(this.club);
                    }, error => {
                        this.errors = error.response.data.error;
                    }).catch(err => {
                        //
                    });
            },
            async edit() {
                if (this.club_id) {
                    let club_edit = axios.get(`/api/clubs/${this.club_id}`, this.club)
                        .then(response => {
                            this.club = response.data;
                        }, error => {
                            this.errors = error.response.data.error;
                        }).catch(err => {
                            //
                        });
                }
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
