loadBlogByTag()

function loadBlogByTag() {
    const urls = new URL(window.location.href);
    if (urls.searchParams.has("m") && urls.searchParams.has("tag")) {
        const min = urls.searchParams.get("m");
        const tagid = urls.searchParams.get("tag");
        AjaxSetup();
        $.ajax({
            url: '/blog/viewMoreBlogByTagNormal/' + tagid + '/' + min,
            type: "get",
            success: function(data) {
                if (data.status = 200) {
                    $(".box-tag-a-view-more-blog-by-tag").remove()
                    $("#row-all-blog-by-tag").html(data.msg);
                    $('.set-bg').each(function() {
                        var bg = $(this).data('setbg');
                        $(this).css('background-image', 'url(' + bg + ')');
                    });
                }
            }
        })
    }
}

$(document).on("click", ".a-btn-view-more-blog-by-tag", function(e) {
    e.preventDefault();
    window.history.pushState({}, "", "?m=" + $(this).data("id") + "&tag=" + $(this).data("tag"));
    const urls = new URL(window.location.href);
    const min = urls.searchParams.get("m");
    const tagid = urls.searchParams.get("tag");
    $(this).text("Đang tải...")
    $(this).css('opacity', '0.5')
    AjaxSetup();
    $.ajax({
        url: "/blog/viewMoreBlogByTag/" + tagid + "/" + min,
        type: "get",
        success: function(data) {
            if (data.status = 200) {
                $(".box-tag-a-view-more-blog-by-tag").remove()
                $("#row-all-blog-by-tag").append(data.msg);
                $('.set-bg').each(function() {
                    var bg = $(this).data('setbg');
                    $(this).css('background-image', 'url(' + bg + ')');
                });
            }
        }
    })
})