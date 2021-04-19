$(document).ready(function() {
    $(".rd-add").click(function() {
        $(".custom-load").show();
        $(".rd-add").html("Loading ...");
        setTimeout(function() { window.location.href = 'add'; }, 1100);
    })
    $(".rd-add-per").click(function() {
        $(".custom-load").show();
        $(".rd-add-per").html("Loading ...");
        setTimeout(function() { window.location.href = 'add-permissions'; }, 1100);
    });
    $(".rd-add-role").click(function() {
        $(".custom-load").show();
        $(".rd-add-role").html("Loading ...");
        setTimeout(function() { window.location.href = 'add-roles'; }, 1100);
    });
    $(".rd-add-ques").click(function() {
        $(".custom-load").show();
        $(".rd-add-ques").html("Loading ...");
        let action = $(this).data('action');
        setTimeout(function() { window.location.href = action; }, 1100);
    });
});
