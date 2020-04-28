/**
 * Interceptor
 */
var howManyInterceptorsEncountered = 0;
axios.interceptors.response.use(response => {
    howManyInterceptorsEncountered = howManyInterceptorsEncountered + 1;

    let datatableElement = $("#datatable");

    if (datatableElement.length) {
        if (response.config.method === "delete") {
            // destroy the datatable after deleting an item to enable the re-initialization
            datatableElement.dataTable().fnDestroy();
        }

        if (response.config.method === "get" && howManyInterceptorsEncountered === 1) {
            // initialize the datatable
            setTimeout(() => {
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
            }, 100);
        }
    }

    return response;
}, error => {
    if (error.response.status === 401 && error.response.statusText === "Unauthorized") {
        axios.post(`/logout`,);
        window.location = "/login";
    }

    return Promise.reject(error);
});
