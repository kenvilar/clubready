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
                                       v-model="item.password1"
                                       placeholder="New Password" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="password" class="input-md form-control" name="password2" id="password2"
                                       v-model="item.password2"
                                       placeholder="Repeat Password" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <span style="color:#2ECC71;"><i class="fa fa-check" id="pwmatch"></i></span>
                                Passwords Match
                            </div>
                            <div class="form-group">
                                <button class="col-12 btn btn-primary btn-load btn-md" type="submit"
                                        data-loading-text="Changing Password...">Change Password
                                </button>
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
            this.getCurrentUserInfo();
        },
        created() {
            //
        },
        components: {
            //
        },
        data() {
            return {
                database_model: 'settings',
                item: {},
                errors: {},
                current_user_info: {},
            }
        },
        methods: {
            async storeOrUpdate() {
                if (!this.validatePasswords()) {
                    return;
                }
                axios.put(`/api/${this.database_model}/${this.current_user_info.member_number}/changePassword`, this.item)
                    .then(response => {
                        this.item = response.data;

                        swal.fire({
                            icon: 'success',
                            title: "Success",
                            text: "Your password has been updated successfully.",
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
                    })
                    .catch(err => {
                        //
                    });

                return;
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
            async getCurrentUserInfo() {
                axios.get(`/api/user`)
                    .then(response => {
                        this.current_user_info = response.data;
                    });
            },
            validatePasswords() {
                let password1Val = $("#password1").val();
                let password2Val = $("#password2").val();

                return !(password1Val.length < 5 || password1Val != password2Val);


            },
        }
    }
</script>
