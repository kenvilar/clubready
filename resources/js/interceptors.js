/**
 * Interceptor
 */
axios.interceptors.response.use(response => {
    let datatableElement = $("#datatable");
    console.log('response', response);

    if (datatableElement.length && response.config.method === "delete") {
        // destroy the datatable after deleting an item to enable the re-initialization
        datatableElement.dataTable().fnDestroy();
    }

    if (datatableElement.length && response.config.method === "get") {
        // initialize the datatable
        setTimeout(() => {
            $('#datatable').DataTable({
                "responsive": true,
                "columnDefs": [
                    {orderable: false, targets: [-1, -2],},
                ],
                "pageLength": 500,
                "lengthMenu": [[10, 25, 50, 500, -1], [10, 25, 50, 500, "All"]],
            });
        }, 100);
    }

    return response;
}, error => {
    if (error.response.status === 401 && error.response.statusText === "Unauthorized") {
        axios.post(`/logout`,);
        window.location = "/login";
    }

    return Promise.reject(error);
});
