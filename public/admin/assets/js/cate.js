//Add New Category
$(document).on('click', '#btn-add-cate', function() {
    $("#frm-add-cate").validate({
        submitHandler: function() {
            let action = $("#frm-add-cate").attr('action');
            let method = $("#frm-add-cate").attr('method');
            let formData = new FormData(document.getElementById("frm-add-cate"));
            $.ajax({
                url: action,
                type: method,
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                },
                success: function(data) {
                    //console.log(data);
                    $("#AddModel").modal('hide');
                    if (data.status == '_success') {
                        Swal({
                            title: data.msg,
                            showCancelButton: false,
                            showConfirmButton: false,
                            confirmButtonText: 'OK',
                            type: 'success'
                        }).then(() => {
                            $("#frm-add-cate")[0].reset();
                            location.reload();
                        });
                    } else {
                        Swal({
                            title: data.msg,
                            showCancelButton: false,
                            showConfirmButton: false,
                            type: 'error',
                            timer: 2000
                        });
                    }
                },
                error: function(err) {
                    //console.log(err);
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
    });
});
//mở popup danh mục
$(document).on("click", ".btn-edit-category", function() {
    let id = $(this).attr('data-id');
    let action = $(this).attr('data-action');
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
            $("#EditModal .modal-body").html(data.body);
            $("#EditModal #parent_id option[value='" + data.parent_id_data + "']").prop('selected', true);
            $("#EditModal").modal('show');
        },
        error: function(err) {
            console.log(err);
            Swal({
                title: "Error " + err.status,
                text: err.responseText,
                showCancelButton: false,
                showConfirmButton: true,
                confirmButtonText: 'OK',
                type: 'error'
            });
        }
    });
    return false;
});
//Sửa danh mục
$(document).on('click', "#btn-edit-save", function() {
    $("#frm-edit-cate").validate({
        submitHandler: function() {
            //let formData = $("#frm-edit-cate").serialize();
            let formData = new FormData(document.getElementById("frm-edit-cate"));
            let action = $("#frm-edit-cate").attr('action');
            let method = $("#frm-edit-cate").attr('method');
            $.ajax({
                url: action,
                type: method,
                data: formData,
                dataType: 'JSON',
                cache: false,
                processData: false,
                contentType: false,
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
                            location.reload();
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
    });
});
$(document).on("click", ".btn-del-cate", function() {
    let id = $(this).attr('data-id');
    let action = $(this).attr('data-action');
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
                data: { id: id, length: 1 },
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
                            location.reload();
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