$(document).on("submit", "#form-change-password", function(e) {
    e.preventDefault();
    $("input").removeClass("is-invalid");
    $(".alert-success").fadeOut(500);
    AjaxSetup();
    $.ajax({
        url: "/customerChangePassword",
        type: "post",
        data: $(this).serialize(),
        success: function(data) {
            if (data.status == 200) {
                $(".alert-success").fadeIn(500);
                $(".alert-success").html(data.msg);
                $("input").val("");
                setTimeout(() => {
                    window.location.href = '/logout';
                }, 2000);
            } else if (data.status == 202) {
                $.each(data.msg, function(index, value) {
                    $('input[name="' + index + '"]').addClass("is-invalid")
                    $('.' + index).text(value)
                })
            } else if (data.status == 204) {
                $('input[name="old_password"]').addClass("is-invalid")
                $('.old_password').text(data.msg)
            }
        }
    })
})