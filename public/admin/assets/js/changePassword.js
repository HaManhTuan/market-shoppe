$("#btn-save-new-pwd").click(function() {
    let form = $("#change-password-form");
    form.validate({
        submitHandler: function() {
            let action, method, formData;
            action = form.attr('action');
            method = form.attr('method');
            formData = form.serialize();
            $.ajax({
                url: action,
                type: method,
                data: formData,
                success: function(data) {
                    console.log(data);
                    if (data.status == '_error') {
                        Swal({
                            title: data.msg,
                            showCancelButton: false,
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            type: 'error'
                        });
                    } else {
                        Swal({
                            title: data.msg,
                            showCancelButton: false,
                            showConfirmButton: false,
                            type: 'success',
                            timer: 2000
                        }).then(() => {
                            location.reload();
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