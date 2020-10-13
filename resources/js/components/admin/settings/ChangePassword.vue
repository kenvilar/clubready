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
                                <input type="password" class="input-md form-control" name="current_password"
                                       id="current_password" v-model="item.current_password"
                                       placeholder="Current Password" autocomplete="off">
                                <span role="alert" class="invalid-feedback invalid-feedback-current-password"></span>
                            </div>
                            <div class="form-group">
                                <input type="password" class="input-md form-control" name="password1" id="password1"
                                       v-model="item.password1"
                                       placeholder="New Password" autocomplete="off">
                                <span role="alert" class="invalid-feedback invalid-feedback-password1"></span>
                            </div>
                            <div class="form-group">
                                <input type="password" class="input-md form-control" name="password2" id="password2"
                                       v-model="item.password2"
                                       placeholder="Confirm New Password" autocomplete="off">
                                <span role="alert" class="invalid-feedback invalid-feedback-password2"></span>
                            </div>
                            <div class="form-group">
                                <span style="color:#2ECC71;"><i class="fa fa-check" id="pwmatch"></i></span>
                                Passwords Match?
                            </div>
                            <div class="form-group">
                                <button class="col-12 btn btn-primary btn-load btn-md" type="submit"
                                        data-loading-text="Changing Password..." disabled>Change Password
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
                let current_password = $("#current_password").val();
                let password1Val = $("#password1").val();
                let class_current_password = $(".invalid-feedback-current-password");
                let class_password1 = $(".invalid-feedback-password1");
                let class_password2 = $(".invalid-feedback-password2");

                if (current_password === password1Val) {
                    class_password1.css("display", "block");
                    class_password1.text("New password cannot be the same as your existing password.");
                    $("#password1").addClass("is-invalid");
                    return;
                }

                if (password1Val.length < 5) {
                    class_password1.css("display", "block");
                    class_password1.text("YOur password needs to be at least 5 characters. Please enter a longer one.");
                    $("#password1").addClass("is-invalid");
                    return;
                }

                if (!this.validatePasswords()) {
                    $("#password1").addClass("is-invalid");
                    $("#password2").addClass("is-invalid");
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

                        if (this.errors === 'Passwords do not match') {
                            setTimeout(() => {
                                class_current_password.css("display", "block");
                                class_current_password.text("The password you entered was incorrect.");
                                $("#current_password").addClass("is-invalid");
                            }, 100);
                        }
                    })
                    .catch(err => {
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
            async getCurrentUserInfo() {
                axios.get(`/api/user`)
                    .then(response => {
                        this.current_user_info = response.data;
                    });
            },
            validatePasswords() {
                let password1Val = $("#password1").val();
                let password2Val = $("#password2").val();

                return !(password1Val !== password2Val);
            },
            removeDisabled() {
                if (this.item.current_password && this.item.password1 && this.item.password2) {
                    $("button[type='submit']").removeAttr('disabled');
                } else {
                    $("button[type='submit']").attr('disabled', 'disabled');
                }
            },
            resetInputFields() {
                let invalid_feedback = $(".invalid-feedback");

                this.removeDisabled();
                $("input[type='password']").removeClass("is-invalid");
                invalid_feedback.css("display", "none");
                invalid_feedback.text("");
            },
        },
        watch: {
            'item.current_password': function (val) {
                this.resetInputFields();
            },
            'item.password1': function (val) {
                this.resetInputFields();
            },
            'item.password2': function (val) {
                this.resetInputFields();
            },
        }
    }
</script>
