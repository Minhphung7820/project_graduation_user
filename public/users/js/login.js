$(document).on("submit", ".form-login-customer", function(e) {
    e.preventDefault();
    $("input").removeClass("is-invalid");
    AjaxSetup();
    $.ajax({
        url: "/login",
        type: "post",
        data: $(this).serialize(),
        success: function(data) {
            if (data.status == 200) {
                window.location.href = "/my-account";
            } else if (data.status == 202) {
                $.each(data.msg, function(index, value) {
                    $('input[name="' + index + '"]').addClass('is-invalid');
                    $("." + index).html(value);
                })
            } else if (data.status == 204) {
                $('input[name="email"]').addClass('is-invalid');
                $('input[name="password"]').addClass('is-invalid');
                $(".email").html(data.msg);
                $(".password").html(data.msg);
            }
        }
    })
})
$(document).on("submit", ".form-login-customer-in-detail-product", function(e) {
    e.preventDefault();
    $("input").removeClass("is-invalid");
    AjaxSetup();
    $.ajax({
        url: "/login",
        type: "post",
        data: $(this).serialize(),
        success: function(data) {
            if (data.status == 200) {
                window.location.reload();
            } else if (data.status == 202) {
                $.each(data.msg, function(index, value) {
                    $('input[name="' + index + '"]').addClass('is-invalid');
                    $("." + index).html(value);
                })
            } else if (data.status == 204) {
                $('input[name="email"]').addClass('is-invalid');
                $('input[name="password"]').addClass('is-invalid');
                $(".email").html(data.msg);
                $(".password").html(data.msg);
            }
        }
    })
})

$(document).on("click", ".a-btn-forgot-password", function(e) {
    e.preventDefault()
})
$(document).on("submit", "#form-forgot-password-send-mail", function(e) {
    e.preventDefault();
    $(".btn-send-reset-password").prop("disabled", true);
    $(".btn-send-reset-password").html("Hệ thống đang xử lý vui lòng chờ...");
    $(".btn-cancel-resetpass").hide();
    $('input').removeClass("is-invalid");
    $('input').removeClass("is-valid");
    AjaxSetup();
    $.ajax({
        url: "/forgotPassword",
        type: "post",
        data: $(this).serialize(),
        success: function(data) {
            if (data.status == 200) {
                console.log(data);
                $(".btn-cancel-resetpass").show();
                $(".btn-send-reset-password").prop("disabled", false);
                $(".btn-send-reset-password").html('<i class="fab fa-telegram-plane"></i> Gửi xác thực');
                $('input[name="email_forgot"]').addClass("is-valid");
                $('.email_forgot').text(data.msg);
            } else if (data.status == 202) {
                console.log(data);
                $(".btn-cancel-resetpass").show();
                $(".btn-send-reset-password").prop("disabled", false);
                $(".btn-send-reset-password").html('<i class="fab fa-telegram-plane"></i> Gửi xác thực');
                $.each(data.msg, function(index, value) {
                    $('input[name="' + index + '"]').addClass("is-invalid");
                    $("." + index).text(value);
                })
            } else if (data.status == 204) {
                console.log(data);
                $(".btn-cancel-resetpass").show();
                $(".btn-send-reset-password").prop("disabled", false);
                $(".btn-send-reset-password").html('<i class="fab fa-telegram-plane"></i> Gửi xác thực');
                $('input[name="email_forgot"]').addClass("is-invalid");
                $('.email_forgot').text(data.msg);
            }
        }
    })
})