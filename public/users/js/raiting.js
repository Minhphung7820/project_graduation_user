$(document).ready(function() {

    var rating_data = 0;

    $('#add_review').click(function() {


        if ($(this).data("login") == 1) {
            $('#review_modal').modal('show');
        } else if ($(this).data("login") == 0) {
            $('#modal-login-review').modal('show');
            return false;
        }

    });

    $(document).on('mouseenter', '.submit_star', function() {

        var rating = $(this).data('rating');

        reset_background();

        for (var count = 1; count <= rating; count++) {

            $('#submit_star_' + count).addClass('text-warning');

        }

    });

    function reset_background() {
        for (var count = 1; count <= 5; count++) {

            $('#submit_star_' + count).addClass('star-light');

            $('#submit_star_' + count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function() {

        reset_background();

        for (var count = 1; count <= rating_data; count++) {

            $('#submit_star_' + count).removeClass('star-light');

            $('#submit_star_' + count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function() {

        rating_data = $(this).data('rating');

    });

    $('#save_review').click(function() {

        var customer = $('#idCustomer').val();
        var prod = $('#idProd').val();

        var user_review = $('#user_review').val();

        if (user_review == '') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 800,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: 'Vui lòng nhập nội dung !'
            })
            return false;
        } else if (rating_data == 0) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 800,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: 'Vui lòng chọn xếp loại !'
            })
            return false;
        } else {
            AjaxSetup()
            $.ajax({
                url: "/addRating",
                type: "post",
                data: {
                    rating_data: rating_data,
                    customer: customer,
                    prod: prod,
                    user_review: user_review
                },
                success: function(data) {
                    $('#review_modal').modal('hide');
                    load_rating_data();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1800,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: data
                    });
                }
            })
        }

    });

    load_rating_data();

    function load_rating_data() {
        var prod = $('#idProd').val();
        AjaxSetup();
        $.ajax({
            url: "/addRating",
            type: "POST",
            data: {
                action: 'load_data',
                prod: prod,
            },
            success: function(data) {
                $('#average_rating').text(data.average_rating);
                $('#total_review').text(data.total_review);
                $("#total-review-star").text(count = (data.total_review > 0) ? data.total_review : 'Chưa có');
                // $('input[id="rating-average-prod"]').val(data.average_rating);
                $("#box-avg-rating-2").text(data.average_rating);
                var count_star = 0;
                var count_star_2 = 0;
                $('.main_star').each(function() {
                    count_star++;
                    if (Math.ceil(data.average_rating) >= count_star) {
                        if (data.average_rating % 1 != 0) {
                            if (Math.ceil(data.average_rating) - 1 >= count_star) {
                                $(this).addClass('text-warning');
                            } else if (Math.ceil(data.average_rating) - 1 < count_star) {
                                $(this).removeClass('fas fa-star');
                                $(this).addClass('fas fa-star-half-alt text-warning');
                            }
                        } else {
                            $(this).removeClass('fas fa-star');
                            $(this).addClass('far fa-star text-warning');
                        }
                    } else {
                        $(this).removeClass('fas fa-star');
                        $(this).addClass('far fa-star text-warning');
                    }
                });
                $('.main_star_2').each(function() {
                    count_star_2++;
                    if (Math.ceil(data.average_rating) >= count_star_2) {
                        if (data.average_rating % 1 != 0) {
                            if (Math.ceil(data.average_rating) - 1 >= count_star_2) {
                                $(this).addClass('text-warning');
                            } else if (Math.ceil(data.average_rating) - 1 < count_star_2) {
                                $(this).removeClass('fas fa-star');
                                $(this).addClass('fas fa-star-half-alt text-warning');
                            }
                        } else {
                            $(this).removeClass('fas fa-star');
                            $(this).addClass('far fa-star text-warning');
                        }
                    } else {
                        $(this).removeClass('fas fa-star');
                        $(this).addClass('far fa-star text-warning');
                    }
                });
                $('#total_five_star_review').text(data.five_star_review);

                $('#total_four_star_review').text(data.four_star_review);

                $('#total_three_star_review').text(data.three_star_review);

                $('#total_two_star_review').text(data.two_star_review);

                $('#total_one_star_review').text(data.one_star_review);

                $('#five_star_progress').css('width', (data.five_star_review / data.total_review) * 100 + '%');

                $('#four_star_progress').css('width', (data.four_star_review / data.total_review) * 100 + '%');

                $('#three_star_progress').css('width', (data.three_star_review / data.total_review) * 100 + '%');

                $('#two_star_progress').css('width', (data.two_star_review / data.total_review) * 100 + '%');

                $('#one_star_progress').css('width', (data.one_star_review / data.total_review) * 100 + '%');

                if (data.review_data.length > 0) {
                    var html = '';

                    for (var count = 0; count < data.review_data.length; count++) {
                        html += '<div class="row-each-rating-of-customer row mb-3">';

                        html += '<div class="box-image-custom-rating col-lg-1 col-sm-2 col-xs-6"><div style="padding-top:13px;padding-bottom:13px;" class="rounded-circle bg-danger text-white"><h3 class="text-center">' + data.review_data[count].customer.name.charAt(0) + '</h3></div></div>';

                        html += '<div class="box-content-custom-rating col-lg-11 col-sm-10 col-xs-6">';

                        html += '<div  style="border-left:none;border-right:none;border-top:none;" class="card">';



                        html += '<div class="card-body">';

                        html += '<b>' + data.review_data[count].customer.name + '</b><br>';

                        for (var star = 1; star <= 5; star++) {
                            var class_name = '';

                            if (data.review_data[count].star_rating >= star) {
                                class_name = 'text-warning';
                            } else {
                                class_name = 'star-light';
                            }

                            html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
                        }

                        html += '<br />';

                        html += '<div class="mt-2 mb-2">' + data.review_data[count].content_review + '</div>';

                        html += '<div>Đã viết ' + data.review_data[count].datetime + '</div>';

                        html += '</div>';

                        html += '</div>';

                        html += '</div>';

                        html += '</div>';
                    }
                    // console.log(data.count);
                    if (data.count > 6) {
                        html += `<div class="row box-btn-view-more-rating-custom">
                        <div class="col-lg-12 text-center">
                        <button type="button" class="btn btn-success btn-viewmore-rating-custom">Xem thêm ` + parseInt(data.count - 6) + ` đánh giá</button>
                        </div>
                      </div>`;
                    }
                    $('#review_content').html(html);


                }




                let countDis = data.count;
                let boxes = [];
                let arr = [];
                $(".row-each-rating-of-customer").each(function(index, value) {
                    boxes.push($(value));
                    if (index + 1 <= 6) {
                        $(value).show();
                    } else {
                        $(value).hide();
                    }
                })
                let currentItem = 6;
                let countPage = Math.ceil(countDis / 6);
                let pageEnd = countDis - ((countPage - 1) * 6);
                let countAvg = ((countDis - pageEnd) / (countPage - 1))
                    // console.log(countAvg);
                for (let a = 1; a < (countPage - 1); a++) {
                    arr.push(countAvg);
                }
                arr.push(pageEnd)
                    // console.log(arr);
                let fl = 0;
                // #################
                const uri = new URL(window.location.href);
                if (uri.searchParams.has("ratings-page") && uri.searchParams.has("m")) {
                    let mCurrent = uri.searchParams.get("m");
                    let PageCurrent = uri.searchParams.get("ratings-page");
                    $(".nav-link-rating").addClass("active");
                    $(".tab-pane-rating").addClass("active");
                    $(".nav-link-der").removeClass("active");
                    $(".tab-pane-der").removeClass("active");
                    for (let index = 0; index < mCurrent; index++) {
                        boxes[index].show();
                    }
                    // #################
                    if (uri.searchParams.get("m") == countDis) {
                        $(".btn-viewmore-rating-custom").hide()
                    } else {
                        $(".btn-viewmore-rating-custom").show();
                        $(".btn-viewmore-rating-custom").html("Xem thêm " + parseInt(countDis - uri.searchParams.get("m")) + " đánh giá");
                    }
                    let pl = parseInt(PageCurrent) - parseInt(1);
                    // ##################
                    $(".btn-viewmore-rating-custom").click(function(e) {
                            for (let index = mCurrent; index < parseInt(mCurrent) + arr[pl]; index++) {
                                boxes[index].show();
                            }
                            mCurrent = parseInt(mCurrent) + arr[pl];
                            if (arr[pl] < 6 || mCurrent == countDis) {
                                $(".btn-viewmore-rating-custom").remove()
                            }
                            pl += 1;
                            window.history.pushState({}, "", "?ratings-page=" + Math.ceil(mCurrent / 6) + "&m=" + mCurrent);
                            $(".btn-viewmore-rating-custom").html("Xem thêm " + parseInt(countDis - mCurrent) + " đánh giá")

                        })
                        // #####################
                } else {
                    $(".btn-viewmore-rating-custom").click(function(e) {
                        for (let index = currentItem; index < currentItem + arr[fl]; index++) {
                            boxes[index].show();
                        }
                        currentItem += arr[fl]
                        if (arr[fl] < 6 || currentItem == countDis) {
                            $(".btn-viewmore-rating-custom").remove()
                        }
                        // console.log(arr[fl]);
                        fl += 1;
                        window.history.pushState({}, "", "?ratings-page=" + Math.ceil(currentItem / 6) + "&m=" + currentItem);
                        $(".btn-viewmore-rating-custom").html("Xem thêm " + parseInt(countDis - currentItem) + " đánh giá")

                    })
                }
                // #################

            }
        })
    }

});