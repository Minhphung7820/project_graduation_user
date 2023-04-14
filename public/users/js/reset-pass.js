$(document).on("submit", "#form-reset-password-customer", function(e) {
    e.preventDefault();
    $(".btn-submit-reset-password").prop("disabled", true);
    $(".btn-submit-reset-password").html('Đang xử lý...');
    $('input').removeClass("is-invalid")
    $(".alert-success").hide();
    $(".alert-danger").hide();
    AjaxSetup();
    $.ajax({
        url: "/resetNewPassword",
        type: "post",
        data: $(this).serialize(),
        success: function(data) {
            if (data.status == 200) {
                $(".alert-success").show();
                $(".alert-success").text(data.msg)
                $(".btn-submit-reset-password").prop("disabled", false);
                $(".btn-submit-reset-password").html('Tạo mật khẩu');
                setTimeout(() => {
                    window.location.href = '/login';
                }, 2000);
            } else if (data.status == 202) {
                $.each(data.msg, function(index, value) {
                    $('input[name="' + index + '"]').addClass('is-invalid');
                    $('.' + index).text(value)
                })
                $(".btn-submit-reset-password").prop("disabled", false);
                $(".btn-submit-reset-password").html('Tạo mật khẩu');
            } else if (data.status == 404) {
                $(".alert-danger").show();
                $(".alert-danger").text(data.msg)
                $(".btn-submit-reset-password").prop("disabled", false);
                $(".btn-submit-reset-password").html('Tạo mật khẩu');
            }
        }
    })
})