loadMoreBlog()

function loadMoreBlog() {
    const urls = new URL(window.location.href);
    if (urls.searchParams.has("m")) {
        const min = urls.searchParams.get("m");
        AjaxSetup();
        $.ajax({
            url: '/blog/viewmoreBlogsNormal/' + min,
            type: "get",
            success: function(data) {
                if (data.status = 200) {
                    $(".box-tag-a-view-more-blog").remove()
                    $("#row-all-blog").html(data.msg);
                    $('.set-bg').each(function() {
                        var bg = $(this).data('setbg');
                        $(this).css('background-image', 'url(' + bg + ')');
                    });
                }
            }
        })
    }
}

$(document).on("click", ".a-btn-view-more-blog", function(e) {
    e.preventDefault();
    var idMin = $(this).data("id");

    window.history.pushState({}, "", "?m=" + idMin);
    const urls = new URL(window.location.href);
    const min = urls.searchParams.get("m");
    $(this).text("Đang tải...")
    $(this).css('opacity', '0.5')
    AjaxSetup();
    $.ajax({
        url: '/blog/viewmoreBlogs/' + min,
        type: "get",
        success: function(data) {
            if (data.status = 200) {
                $(".box-tag-a-view-more-blog").remove()
                $("#row-all-blog").append(data.msg);
                $('.set-bg').each(function() {
                    var bg = $(this).data('setbg');
                    $(this).css('background-image', 'url(' + bg + ')');
                });
            }
        }
    })
})