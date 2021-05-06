//Add New Category
$(document).on('click', '#btn-add-exam', function() {
    $("#frm-add-exam").validate({
        submitHandler: function() {
            let action = $("#frm-add-exam").attr('action');
            let method = $("#frm-add-exam").attr('method');
            let formData = $("#frm-add-exam").serialize();
            $.ajax({
                url: action,
                type: method,
                data: formData,
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
                            $("#frm-add-exam")[0].reset();
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
//mở popup danh mục
$(document).on("click", ".btn-edit-exam", function() {
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
            $("#EditModal #category_id option[value='" + data.category_id + "']").prop('selected', true);
            $("#EditModal #duration option[value='" + data.duration + "']").prop('selected', true);
            $("#EditModal #mark_right option[value='" + data.marks_right_answer + "']").prop('selected', true);
            $("#EditModal #mark_wrong option[value='" + data.marks_wrong_answer + "']").prop('selected', true);
            $("#EditModal #total_question option[value='" + data.total_question + "']").prop('selected', true);
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
$(document).on('click', "#btn-edit-exam", function() {
    $("#frm-edit-exam").validate({
        submitHandler: function() {
            let formData = $("#frm-edit-exam").serialize();
            let action = $("#frm-edit-exam").attr('action');
            let method = $("#frm-edit-exam").attr('method');
            $.ajax({
                url: action,
                type: method,
                data: formData,
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
    });
});
$(document).on("click", ".btn-del-exam", function() {
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