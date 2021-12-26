document.addEventListener('DOMContentLoaded', function () {
    $("[data-method]").on('click', function (e) {
        e.preventDefault();
        const elem = $(this);
        const data = elem.data('data');

        bootbox.confirm({
            message: elem.attr('data-confirm'),
            buttons: {
                confirm: {
                    label: 'Да',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'Нет',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {

                if (true === result) {
                    $.ajax({
                        url: elem.attr('href'),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: data,
                        method: elem.attr('data-method'),
                        success: function () {
                            location.href = elem.attr('data-redirect') || "/";
                        },
                        error: function () {
                            location.href = elem.attr('data-redirect') || "/";
                        }
                    })
                }
            }
        });


    });

})
