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
                            <div class="form-group row">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label">Logo <br> Recommended
                                        resolution: <br>(width: 254px, height: 153px)</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="file" class="" name="logo" id="logo"
                                           v-on:change="onImageChange"
                                           :class="{'is-invalid': hasError(errors, 'logo')}">
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'logo', true)}}</strong></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 text-right txt_media">
                                    <label class="form-control-label">Favicon <br> Recommended
                                        resolution: <br>32x32</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="file" class="" name="favicon" id="favicon"
                                           v-on:change="onFaviconImageChange"
                                           :class="{'is-invalid': hasError(errors, 'favicon')}">
                                    <span role="alert" class="invalid-feedback">
                                        <strong>{{hasError(errors, 'favicon', true)}}</strong></span>
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
                faviconImage: "",
                bigImage: false,
                bigFaviconImage: false,
            }
        },
        methods: {
            async update() {
                if (this.image) {
                    this.item.logo = this.image;
                }

                if (this.faviconImage) {
                    this.item.favicon = this.faviconImage;
                }

                if (this.bigImage) {
                    this.errors.logo = [];
                    this.errors.logo.push("The logo may not be greater than 5 MB.");

                    return false;
                }

                if (this.bigFaviconImage) {
                    this.errors.favicon = [];
                    this.errors.favicon.push("The favicon may not be greater than 2 MB.");

                    return false;
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
                                window.location.reload();
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

                setTimeout(() => {
                    let logoImage = this.item.logo ? '../storage/' + this.item.logo : null;
                    let faviconImage = this.item.favicon ? '../storage/' + this.item.favicon : null;

                    $("#logo").fileinput({
                        theme: "fa",
                        browseClass: "btn btn-info",
                        initialPreview: [logoImage],
                        initialPreviewAsData: true,
                        showCaption: false,
                        showRemove: true,
                        showUpload: false,
                        maxFileSize: 5120,
                        allowedFileExtensions: ["jpeg", "jpg", "png", "gif",],
                        initialPreviewShowDelete: false,
                        showClose: false,
                        removeClass: 'btn btn-danger',
                    });

                    $("#favicon").fileinput({
                        theme: "fa",
                        browseClass: "btn btn-info",
                        initialPreview: [faviconImage],
                        initialPreviewAsData: true,
                        showCaption: false,
                        showRemove: true,
                        showUpload: false,
                        maxFileSize: 5120,
                        allowedFileExtensions: ["ico",],
                        initialPreviewShowDelete: false,
                        showClose: false,
                        removeClass: 'btn btn-danger',
                    });

                    this.logoFileClear();
                    this.faviconFileClear();
                }, 500);
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
                this.bigImage = files[0].size > 5242880;
                this.createImage(files[0]);
            },
            onFaviconImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.bigFaviconImage = files[0].size > 2097152;
                this.createFaviconImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = e => {
                    vm.image = e.target.result;
                    console.log('ken vm.image', vm.image);
                };
                reader.readAsDataURL(file);
            },
            createFaviconImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = e => {
                    vm.faviconImage = e.target.result;
                    console.log('ken vm.faviconImage', vm.faviconImage);
                };
                reader.readAsDataURL(file);
            },
            logoFileClear() {
                var self = this;

                $('#logo').on('fileclear', function () {
                    if (self.item.logo) {
                        swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, remove it!',
                        }).then(result => {
                            if (result.value) {
                                axios.delete(`/api/settings/1`)
                                    .then(response => {
                                        console.log('response.data', response.data);

                                        swal.fire(
                                            'Deleted!',
                                            'Item has been deleted.',
                                            'success'
                                        ).then(response => {
                                            if (response.value) {
                                                window.location.reload();
                                            }
                                        });
                                    }, error => {
                                        this.errors = error.response.data;
                                        console.log('this.errors', this.errors);
                                    })
                                    .catch(err => {
                                        console.log('err', err.response);
                                    });
                            } else {
                                window.location.reload();
                            }
                        });
                    } else {
                        self.image = "";
                    }
                });
            },
            faviconFileClear() {
                var self = this;

                $('#favicon').on('fileclear', function () {
                    if (self.item.favicon) {
                        swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, remove it!',
                        }).then(result => {
                            if (result.value) {
                                axios.delete(`/api/settings/1`)
                                    .then(response => {
                                        console.log('response.data', response.data);

                                        swal.fire(
                                            'Deleted!',
                                            'Item has been deleted.',
                                            'success'
                                        ).then(response => {
                                            if (response.value) {
                                                window.location.reload();
                                            }
                                        });
                                    }, error => {
                                        this.errors = error.response.data;
                                        console.log('this.errors', this.errors);
                                    })
                                    .catch(err => {
                                        console.log('err', err.response);
                                    });
                            } else {
                                window.location.reload();
                            }
                        });
                    } else {
                        self.faviconImage = "";
                    }
                });
            },
        }
    }
</script>
