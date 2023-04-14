$(document).ready(function() {
    $(".title-blog-related > h6").each(function(index, value) {
        var textCurrent = $(value).text();
        if (textCurrent.length >= 30) {
            var textNew = textCurrent.slice(0, 30);
            $(value).text(textNew + "...");
        }
    })
})
$(document).on("submit", "#form-comment-blog", function(e) {
    e.preventDefault();

})
$(document).on("click", ".tags-of-detail > a", function(e) {
    e.preventDefault();
    window.location.href = '/blog/tag/' + $(this).attr("href") + '_' + $(this).data("id") + '.html';
    // AjaxSetup();
    // $.ajax({
    //     url: "/blog/set-tag",
    //     type: "post",
    //     data: {
    //         tag: $(this).data("tag"),
    //         slug: $(this).attr("href")
    //     },
    //     success: function(data) {
    //         alert(data)
    //     }
    // })
})

// =============================
$('.slick-slider-prod-related-blog-1').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow: $(".btn-prev-slider-prod-in-blog-1"),
    nextArrow: $(".btn-next-slider-prod-in-blog-1"),
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});
// =============================
$('.slick-slider-prod-related-blog-2').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow: $(".btn-prev-slider-prod-in-blog-2"),
    nextArrow: $(".btn-next-slider-prod-in-blog-2"),
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});
// =============================

$(document).on("click", ".ele-slider-prod-related-in-detail-posts", function(e) {
    e.preventDefault();
    window.location.href = '/detail/' + $(this).data("slug")
})