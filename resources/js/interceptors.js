/**
 * Interceptor
 */
var howManyInterceptorsEncountered = 0;
var resetDataTableAfterDelete = false;

axios.interceptors.response.use(response => {
    howManyInterceptorsEncountered = howManyInterceptorsEncountered + 1;

    let datatableElement = $("#datatable");
    let iradio = $(".iradio");

    if (iradio) {
        setTimeout(() => {
            // update the iCheck
            $("input").iCheck("update");
        }, 100);
    }

    if (datatableElement.length) {
        if (response.config.method === "delete") {
            // destroy the datatable after deleting an item to enable the re-initialization
            datatableElement.dataTable().fnDestroy();

            // make resetDataTableAfterDelete set to true to reset the datatable
            resetDataTableAfterDelete = true;
        }

        if (response.config.method === "get" && (howManyInterceptorsEncountered === 1 || resetDataTableAfterDelete)) {
            setTimeout(() => {
                // initialize the datatable
                $('#datatable').DataTable({
                    "responsive": true,
                    "columnDefs": [
                        {
                            orderable: false,
                            targets: [-1, -2],
                        },
                    ],
                    "pageLength": 500,
                    "lengthMenu": [[10, 25, 50, 500, -1], [10, 25, 50, 500, "All"]],
                });
            }, 300);

            // back to resetDataTableAfterDelete as default
            resetDataTableAfterDelete = false;
        }
    }

    return response;
}, error => {
    if (error.response.status === 401 && error.response.statusText === "Unauthorized") {
        axios.post(`/logout`);
        window.location = "/login";
    }

    if (error.response.data.code === 403 && error.response.data.error.includes("This action is unauthorized.")) {
        swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: error.response.data.error,
        });
    }

    return Promise.reject(error);
});
