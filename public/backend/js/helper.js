function confirmDelete() {
    $(document).on('click', 'table.table-index .delete-item-datatable', (event) => {
        let route = $(event.target).data('route');
        $('#link_delete').attr('href', route)
    });

    $(document).on('click', 'table.table-index .is_show', (event) => {
        let route = $(event.target).data('route');
        $.ajax({
            url: route,
            type: 'GET',
        }).done(function (response) {
            if (response.response_code == 1) {
                $.each(response.message, function (index, value) {
                    toastr.error(value)
                })
            }else {
                $.each(response.message, function (index, value) {
                    toastr.success(value)
                })
            }

        });
    })
}

let HelperAdmin = (function () {
    return {
        confirmDelete: confirmDelete,
    }
})();