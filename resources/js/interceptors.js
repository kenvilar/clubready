/**
 * Interceptor
 */
var howManyInterceptorsEncountered = 0;
var resetDataTableAfterDelete = false;

axios.interceptors.response.use(response => {
    howManyInterceptorsEncountered = howManyInterceptorsEncountered + 1;

    let datatableElement = $("#datatable");
    let iradio = $(".iradio");

    if (iradio.length) {
        setTimeout(() => {
            // update the iCheck
            $("input").iCheck("update");
        }, 100);
    }

    if (datatableElement.length) {
        let firstIndexOfTable = $("#datatable").find('th:first').index();

        if (response.config.method === "delete") {
            // destroy the datatable after deleting an item to enable the re-initialization
            datatableElement.dataTable().fnDestroy();

            // make resetDataTableAfterDelete set to true to reset the datatable
            resetDataTableAfterDelete = true;
        }

        if (response.config.method === "get" && (howManyInterceptorsEncountered === 1 || resetDataTableAfterDelete)) {
            setTimeout(() => {
                let options = {
                    "responsive": true,
                    "columnDefs": [
                        {
                            orderable: false,
                            targets: [-1, -2],
                        },
                    ],
                    "pageLength": 500,
                    "lengthMenu": [[10, 25, 50, 500, -1], [10, 25, 50, 500, "All"]],
                };

                if (MEMBER.UUID === 'admin') {
                    options["order"] = [[firstIndexOfTable, 'desc']];
                }

                // initialize the datatable
                $('#datatable').DataTable(options);
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
    } else if (error.response.data.code === 403 && error.response.data.error.includes("This action is unauthorized.")) {
        setTimeout(() => {
            swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error.response.data.error,
            });
        }, 200);
    } else if (error.response.status === 404 && error.response.statusText.toLowerCase() === "not found") {
        window.location = "/admin/not-found";
    }

    return Promise.reject(error);
});
