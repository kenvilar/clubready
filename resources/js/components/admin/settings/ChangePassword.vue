<template>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card set_media">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-fw ti-key"></i> Change Password
                        </h3>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="storeOrUpdate" id="passwordForm" novalidate>
                            <div class="form-group">
                                <input type="password" class="input-md form-control" name="password1" id="password1"
                                       placeholder="New Password" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="password" class="input-md form-control" name="password2" id="password2"
                                       placeholder="Repeat Password" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <span style="color:#2ECC71;"><i class="fa fa-check" id="pwmatch"></i></span>
                                Passwords Match
                            </div>
                            <div class="form-group">
                                <a href="#" class="col-12 btn btn-primary btn-load btn-md"
                                   data-loading-text="Changing Password...">Change Password</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: 'settings-change-password-view-vue',
        props: {
            model_id: {
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
                database_model: 'membership-type-names',
                item: {},
                errors: {},
            }
        },
        methods: {
            async storeOrUpdate() {
                if (this.model_id) {
                    let update = axios.put(`/api/${this.database_model}/${this.model_id}`, this.item)
                        .then(response => {
                            this.item = response.data;

                            swal.fire({
                                icon: 'success',
                                title: "Success",
                                text: "Membership type name has been updated successfully.",
                                type: "success",
                            }).then(result => {
                                if (result.value) {
                                    this.automaticFocusTheFirstInput();
                                    this.errors = {};
                                }
                            });
                        }, error => {
                            this.errors = error.response.data.error;
                            console.log('this.errors', this.errors);
                        }).catch(err => {
                            //
                        });

                    return;
                }

                let store = axios.post(`/api/${this.database_model}`, this.item)
                    .then(() => {
                        swal.fire({
                            icon: 'success',
                            title: "Success",
                            text: "New membership type name has been created successfully.",
                            type: "success",
                        }).then(result => {
                            if (result.value) {
                                this.clearFields(this.item);
                                this.automaticFocusTheFirstInput();
                                this.errors = {};
                            }
                        });
                    }, error => {
                        this.errors = error.response.data.error;
                        console.log('this.errors', this.errors);
                    }).catch(err => {
                        //
                    });
            },
            async edit() {
                if (this.model_id) {
                    let edit = axios.get(`/api/${this.database_model}/${this.model_id}`, this.item)
                        .then(response => {
                            this.item = response.data;
                        }, error => {
                            this.errors = error.response.data.error;
                        }).catch(err => {
                            //
                        });
                }
            },
            async clearFields(param) {
                if (param) {
                    this.item = {};
                    this.errors = {};
                }
                return this.item;
            },
            isEditView(param) {
                return typeof param !== "undefined" || param !== undefined;
            },
            hasError(errors, name, showResult = false) {
                if (showResult === true) {
                    return typeof errors[name] == 'undefined' ? (typeof errors === 'string' ? errors : '') : errors[name][0];
                }

                return typeof errors[name] == 'undefined' ? (typeof errors === 'string' ? errors : '') : errors[name];
            },
            automaticFocusTheFirstInput() {
                setTimeout(() => {
                    $('input:visible:enabled').toggleClass('focus-visible');
                    $('form:first *:input[type!=hidden]:first').focus();
                }, 300);
            },
        }
    }
</script>
