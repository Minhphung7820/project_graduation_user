loadBlogByCate()

function loadBlogByCate() {
    const urls = new URL(window.location.href);
    if (urls.searchParams.has("m") && urls.searchParams.has("cate")) {
        const min = urls.searchParams.get("m");
        const c = urls.searchParams.get("cate");
        AjaxSetup();
        $.ajax({
            url: '/blog/viewmoreBlogByCateNormal/' + c + '/' + min,
            type: "get",
            success: function(data) {
                if (data.status = 200) {
                    $(".box-tag-a-view-more-blog-by-cate").remove()
                    $("#row-all-blog-by-cate").html(data.msg);
                    $('.set-bg').each(function() {
                        var bg = $(this).data('setbg');
                        $(this).css('background-image', 'url(' + bg + ')');
                    });
                }
            }
        })
    }
}

$(document).on("click", ".a-btn-view-more-blog-by-cate", function(e) {
    e.preventDefault();
    var idmin = $(this).data("id")
    var cateS = $(this).data("cate")
    window.history.pushState({}, "", "?m=" + idmin + "&cate=" + cateS);
    const urls = new URL(window.location.href);
    const min = urls.searchParams.get("m");
    const c = urls.searchParams.get("cate");
    $(this).text("Đang tải...")
    $(this).css('opacity', '0.5')
    AjaxSetup();
    $.ajax({
        url: "/blog/viewmoreBlogByCate/" + c + "/" + min,
        type: "get",
        success: function(data) {
            if (data.status = 200) {
                $(".box-tag-a-view-more-blog-by-cate").remove()
                $("#row-all-blog-by-cate").append(data.msg);
                $('.set-bg').each(function() {
                    var bg = $(this).data('setbg');
                    $(this).css('background-image', 'url(' + bg + ')');
                });
            }
        }
    })

})