var host = 'http://127.0.0.1:3000/';

function AjaxSetup() {
    return $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

function loadCount_2() {
    AjaxSetup();
    $.ajax({
        url: host + "api/loadNotificationUserOnline/" + $("#idCustomer").val(),
        type: "get",
        success: function(data) {
            if (data.count > 0) {
                $(".span-count-not-not-seen").show();
                if (data.count > 5) {
                    data.count = '5+';
                }
                $(".span-count-not-not-seen").text(data.count)
            } else {
                $(".span-count-not-not-seen").hide();
            }
        }
    })
}

function loadNotification() {
    AjaxSetup();
    $.ajax({
        url: host + "api/loadNotificationUserOnline/" + $("#idCustomer").val(),
        type: "get",
        success: function(data) {
            if (data.count > 0) {
                $(".span-count-not-not-seen").show();
                if (data.count > 5) {
                    data.count = '5+';
                }
                $(".span-count-not-not-seen").text(data.count);
                $(".btn-view-notification-client").addClass("pulse")
                $(".btn-view-notification-client > i").addClass("bell")
            } else {
                $(".span-count-not-not-seen").hide();
                $(".btn-view-notification-client").removeClass("pulse")
                $(".btn-view-notification-client > i").removeClass("bell")
            }

            $(".modal-show-main-notification").html(data.not_seen);

            $(".modal-show-main-notification-seen").html(data.seen);

        }
    })
}
loadNotification()
$('#modalshowNotifications').on('show.bs.modal', function(e) {
    AjaxSetup();
    $.ajax({
        url: host + "api/seenNotication",
        type: "post",
        data: {
            id: $("#idCustomer").val()
        },
        success: function(data) {
            console.log(data);
            loadCount_2()
        }
    })
})
$('#modalshowNotifications').on('hide.bs.modal', function(e) {
    loadNotification()
    console.log("Đang đóng");
});