$(document).on("submit", ".form-register-customer", function(e) {
    e.preventDefault();
    $(".btn-submit-register").prop("disabled", true);
    $(".btn-submit-register").html("Đang xử lý...");
    $('input').removeClass("is-invalid");
    AjaxSetup();
    $.ajax({
        url: "/register",
        type: "post",
        data: $(this).serialize(),
        success: function(data) {
            if (data.status == 200) {
                $('input').val("")
                $(".alert-success").fadeIn(500);
                $(".alert-success").html(data.msg);
                $(".btn-submit-register").prop("disabled", false);
                $(".btn-submit-register").html("Đăng ký");
            } else if (data.status == 202) {
                $.each(data.msg, function(index, value) {
                    $('input[name="' + index + '"]').addClass("is-invalid");
                    $("." + index).html(value);
                })
                $(".btn-submit-register").prop("disabled", false);
                $(".btn-submit-register").html("Đăng ký");
            } else if (data.status == 204) {
                $('input[name="email"]').addClass("is-invalid");
                $(".email").html(data.msg);
                $(".btn-submit-register").prop("disabled", false);
                $(".btn-submit-register").html("Đăng ký");
            }
        }
    })
})