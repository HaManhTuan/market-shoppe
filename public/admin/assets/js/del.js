$(document).on("click", ".btn-del", function() {
    let id = $(this).attr('data-id');
    let action = $(this).attr('action');
    Swal({
        title: 'Are you sure?',
        type: 'error',
        html: '<p>Once deleted !</p><p>You will not be able to recover this imaginary file!?</p>',
        showConfirmButton: true,
        confirmButtonText: '<i class="ti-check" style="margin-right:5px"></i>OK',
        confirmButtonColor: '#ef5350',
        cancelButtonText: '<i class="ti-close" style="margin-right:5px"></i> Cancell',
        showCancelButton: true,
        focusConfirm: false,
        reverseButtons: true
    }).then((result) => {
        if (result.value == true) {
            $.ajax({
                url: action,
                type: 'POST',
                data: { id: id },
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == '_success') {
                        Swal({
                            title: data.msg,
                            showCancelButton: false,
                            showConfirmButton: false,
                            type: 'success',
                            timer: 2000
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal({
                            title: data.msg,
                            showCancelButton: false,
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            type: 'error'
                        });
                    }
                },
                error: function(err) {
                    console.log(err);
                    Swal({
                        title: 'Error ' + err.status,
                        text: err.responseText,
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        type: 'error'
                    });
                }
            });
        }
        return false;
    });
    return false;
});