<template>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card striped_full">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ti-align-justify"></i> Edit Settings
                        </h3>
                    </div>
                    <div class="card-body border">
                        <form @submit.prevent="update" enctype="multipart/form-data" class="form-bordered-row"
                              novalidate>
                            <div class="form-group row striped-col">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="site_name">Site Name</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="site_name" id="site_name"
                                           v-model="item.site_name"
                                           :class="{'is-invalid': hasError(errors, 'site_name')}">
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'site_name', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="row" v-if="item.logo && !this.errors.logo">
                                <div class="col-md-4 offset-md-3 text-right txt_media">
                                    <img :src="'../storage/' + item.logo" class="img-responsive" alt="logo"
                                         height="auto" width="70%">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label" for="logo">Logo</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="file" class="" name="logo" id="logo"
                                           v-on:change="onImageChange"
                                           :class="{'is-invalid': hasError(errors, 'logo')}">
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'logo', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3 ml-auto">
                                    <button type="submit"
                                            class="btn btn-effect-ripple btn-primary">Edit
                                    </button>
                                </div>
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
        name: 'settings-edit-view-vue',
        props: {},
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
                database_model: 'settings',
                item: {},
                errors: {},
                image: "",
            }
        },
        methods: {
            async update() {
                if (this.image) {
                    this.item.logo = this.image;
                }

                axios.put(`/api/${this.database_model}/1`, this.item)
                    .then(response => {
                        this.item = response.data;

                        swal.fire({
                            icon: 'success',
                            title: "Success",
                            text: "Setting has been updated successfully.",
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
            },
            async edit() {
                axios.get(`/api/${this.database_model}/1`, this.item)
                    .then(response => {
                        this.item = response.data;
                    }, error => {
                        this.errors = error.response.data.error;
                    })
                    .catch(err => {
                        //
                    });
            },
            async clearFields(param) {
                if (param) {
                    this.item = {};
                    this.errors = {};
                }
                return this.item;
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
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = e => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
        }
    }
</script>
