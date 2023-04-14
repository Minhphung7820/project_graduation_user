    const HOST = 'http://localhost:3000';
    const input_left = document.getElementById("input_left");
    const input_right = document.getElementById("input_right");
    const thumb_left = document.querySelector(".slider > .thumb.left");
    const thumb_right = document.querySelector(".slider > .thumb.right");
    const range = document.querySelector(".slider > .range");
    const set_left_value = () => {
        const _this = input_left;
        const [min, max] = [parseInt(_this.min), parseInt(_this.max)];

        _this.value = Math.min(parseInt(_this.value), parseInt(input_right.value) - 1);

        const percent = ((_this.value - min) / (max - min)) * 100 + 5;
        thumb_left.style.left = percent + "%";
        range.style.left = percent + "%";
    };
    const set_right_value = () => {
        const _this = input_right;
        const [min, max] = [parseInt(_this.min), parseInt(_this.max)];

        _this.value = Math.max(parseInt(_this.value), parseInt(input_left.value) + 1);

        const percent = ((_this.value - min) / (max - min)) * 100;
        thumb_right.style.right = 100 - percent + "%";
        range.style.right = 100 - percent + "%";
    };
    input_left.addEventListener("input", set_left_value);
    input_right.addEventListener("input", set_right_value);

    function left_slider(value) {
        let money = (value * 100000).toLocaleString('it-IT', { style: 'currency', currency: 'VND' })
        document.getElementById('left_value').innerHTML = money;
    }

    function right_slider(value) {
        let money = (value * 100000).toLocaleString('it-IT', { style: 'currency', currency: 'VND' })
        document.getElementById('right_value').innerHTML = money;
    }
    /// filter rangePrice
    var arrIdBrand = [];
    var arrIdCate = [];
    var min = '';
    var max = '';
    var sortBy = '';
    var paginate = $('#paginate');
    const pageSize = 9;
    $('.range_slider').on('change', function() {
        min = $('#input_left').val() * 100000;
        max = $('#input_right').val() * 100000;
        $.ajax({
            url: `${HOST}/api/allProductMen`,
            method: "GET",
            data: {
                arrIdBrand: arrIdBrand,
                arrIdCate: arrIdCate,
                min: min,
                max: max,
                sortBy: sortBy,
            },
            success: function(res) {
                var arrBtnPage = [];
                if (res.total > pageSize) {
                    for (let i = 0; i < res.total; i++) {
                        arrBtnPage.push(i);
                    }
                }
                paginate.pagination({
                    dataSource: arrBtnPage,
                    pageSize: pageSize,
                    afterPageOnClick: (event, pageNumber) => {
                        loadPage(pageNumber);
                    },
                    afterPreviousOnClick: (event, pageNumber) => {
                        loadPage(pageNumber);
                    },
                    afterNextOnClick: (event, pageNumber) => {
                        loadPage(pageNumber);
                    },
                })
                var result = document.querySelector('.search-result');
                $("#totalProduct").html("Có " + res.total + " sản phẩm với kết quả tìm kiếm");
                const html = res.products.map((product) => {
                    var discount = '';
                    var priceOld = ''
                    if (product.discount !== 0) {
                        discount = `<div class='label new'>${product.discount}%</div>`
                        priceOld = product.price
                        priceOld = priceOld.toLocaleString('vi', { style: 'currency', currency: 'VND' });
                        priceOld = priceOld.slice(0, -1) + 'đ';;
                    }
                    var price = product.price - (product.price * product.discount / 100);
                    price = price.toLocaleString('vi', { style: 'currency', currency: 'VND' });
                    price = price.slice(0, -1);
                    // ========================== Show Đánh giá ==================
                    var rating = '';
                    var user_rating = 0;
                    var totalR = 0;

                    $.each(product.reviews, function(index, value) {
                        if (value.status == 2) {
                            totalR++;
                            user_rating += value.num_star
                        }
                    })

                    var avgRatingHome = user_rating / totalR;
                    avgRatingHome = (isNaN(avgRatingHome)) ? 0 : avgRatingHome.toFixed(1);

                    // =============
                    // console.log("ID sản phẩm : " + product.id);
                    // console.log("Số sao trung bình : " + avgRatingHome);
                    for (let star = 1; star <= 5; star++) {
                        if (Math.ceil(avgRatingHome) >= star) {
                            if (avgRatingHome % 1 != 0) {
                                if (Math.ceil(avgRatingHome) - 1 >= star) {
                                    rating += ' <i class="fa fa-star text-warning"></i>';
                                } else if (Math.ceil(avgRatingHome) - 1 < star) {
                                    rating += ' <i class="fas fa-star-half-alt text-warning"></i>';
                                }
                            } else {
                                rating += ' <i class="fa fa-star text-warning"></i>';
                            }
                        } else {
                            rating += ' <i class="far fa-star text-warning"></i>';
                        }
                    }
                    rating += ' (<span>' + avgRatingHome + '</span>)'
                        //============================= End Show Rating =======================
                    return `
                   <div class="col-lg-4 col-md-6">
                   <div class="product__item" data-id="${product.slug}">
                   <div class="product__item__pic set-bg" data-setbg="${HOST}/images/${product.image}">
                   ${discount}
                   <img src="${HOST}/images/${product.image}" alt="anh">
                   <ul class="product__hover">
                           <li><a href="${HOST}/images/${product.image}" class="image-popup"><span class="arrow_expand"></span></a></li>
                       </ul>
                   </div>
                   <div class="product__item__text">
                       <h6>
                           <a href="/detail/${product.slug}">${product.name}</a>
                       </h6>
                       <div class="rating-every-prod">
                       ${rating}
                    </div>
                       <div class="product__price">${price}đ<span>${priceOld}</span></div>
                   </div>
               </div>
               </div>
               `
                })
                result.innerHTML = html.join(' ');
            }
        });
    });
    //filter by brand
    var checkboxesBrand = document.querySelectorAll(".idBrand");
    for (let checkboxBrand of checkboxesBrand) {
        checkboxBrand.addEventListener('click', function() {
            if (this.checked == true) {
                arrIdBrand.push(this.value);
            } else {
                arrIdBrand = arrIdBrand.filter(e => e !== this.value)
            }
            $.ajax({
                url: `${HOST}/api/allProductMen`,
                method: "GET",
                data: {
                    arrIdBrand: arrIdBrand,
                    arrIdCate: arrIdCate,
                    min: min,
                    max: max,
                    sortBy: sortBy,
                },
                success: function(res) {
                    var arrBtnPage = [];
                    if (res.total > pageSize) {
                        for (let i = 0; i < res.total; i++) {
                            arrBtnPage.push(i);
                        }
                    }
                    paginate.pagination({
                        dataSource: arrBtnPage,
                        pageSize: pageSize,
                        afterPageOnClick: (event, pageNumber) => {
                            loadPage(pageNumber);
                        },
                        afterPreviousOnClick: (event, pageNumber) => {
                            loadPage(pageNumber);
                        },
                        afterNextOnClick: (event, pageNumber) => {
                            loadPage(pageNumber);
                        },
                    })
                    var result = document.querySelector('.search-result');
                    $("#totalProduct").html("Có " + res.total + " sản phẩm với kết quả tìm kiếm");
                    const html = res.products.map((product) => {
                        var discount = '';
                        var priceOld = ''
                        if (product.discount !== 0) {
                            discount = `<div class='label new'>${product.discount}%</div>`
                            priceOld = product.price
                            priceOld = priceOld.toLocaleString('vi', { style: 'currency', currency: 'VND' });
                            priceOld = priceOld.slice(0, -1) + 'đ';;
                        }
                        var price = product.price - (product.price * product.discount / 100);
                        price = price.toLocaleString('vi', { style: 'currency', currency: 'VND' });
                        price = price.slice(0, -1);
                        // ========================== Show Đánh giá ==================
                        var rating = '';
                        var user_rating = 0;
                        var totalR = 0;

                        $.each(product.reviews, function(index, value) {
                            if (value.status == 2) {
                                totalR++;
                                user_rating += value.num_star
                            }
                        })

                        var avgRatingHome = user_rating / totalR;
                        avgRatingHome = (isNaN(avgRatingHome)) ? 0 : avgRatingHome.toFixed(1);

                        // =============
                        // console.log("ID sản phẩm : " + product.id);
                        // console.log("Số sao trung bình : " + avgRatingHome);
                        for (let star = 1; star <= 5; star++) {
                            if (Math.ceil(avgRatingHome) >= star) {
                                if (avgRatingHome % 1 != 0) {
                                    if (Math.ceil(avgRatingHome) - 1 >= star) {
                                        rating += ' <i class="fa fa-star text-warning"></i>';
                                    } else if (Math.ceil(avgRatingHome) - 1 < star) {
                                        rating += ' <i class="fas fa-star-half-alt text-warning"></i>';
                                    }
                                } else {
                                    rating += ' <i class="fa fa-star text-warning"></i>';
                                }
                            } else {
                                rating += ' <i class="far fa-star text-warning"></i>';
                            }
                        }
                        rating += ' (<span>' + avgRatingHome + '</span>)'
                            //============================= End Show Rating =======================
                        return `
                           <div class="col-lg-4 col-md-6">
                           <div class="product__item" data-id="${product.slug}">
                           <div class="product__item__pic set-bg" data-setbg="${HOST}/images/${product.image}">
                           ${discount}
                           <img src="${HOST}/images/${product.image}" alt="anh">
                           <ul class="product__hover">
                                   <li><a href="${HOST}/images/${product.image}" class="image-popup"><span class="arrow_expand"></span></a></li>
                               </ul>
                           </div>
                           <div class="product__item__text">
                               <h6>
                                   <a href="/detail/${product.slug}">${product.name}</a>
                               </h6>
                               <div class="rating-every-prod">
                               ${rating}
                            </div>
                               <div class="product__price">${price}đ<span>${priceOld}</span></div>
                           </div>
                       </div>
                       </div>
                       `
                    })
                    result.innerHTML = html.join(' ');
                }
            });
        })
    }
    ///filter by cate 
    var checkboxes = document.querySelectorAll(".idCate");
    for (let checkbox of checkboxes) {
        checkbox.addEventListener('click', function() {
            if (this.checked == true) {
                arrIdCate.push(this.value);
            } else {
                arrIdCate = arrIdCate.filter(e => e !== this.value)
            }
            $.ajax({
                url: `${HOST}/api/allProductMen`,
                method: "GET",
                data: {
                    arrIdBrand: arrIdBrand,
                    arrIdCate: arrIdCate,
                    min: min,
                    max: max,
                    sortBy: sortBy,
                },
                success: (res) => {
                    var arrBtnPage = [];
                    if (res.total > pageSize) {
                        for (let i = 0; i < res.total; i++) {
                            arrBtnPage.push(i);
                        }
                    }
                    paginate.pagination({
                        dataSource: arrBtnPage,
                        pageSize: pageSize,
                        afterPageOnClick: (event, pageNumber) => {
                            loadPage(pageNumber);
                        },
                        afterPreviousOnClick: (event, pageNumber) => {
                            loadPage(pageNumber);
                        },
                        afterNextOnClick: (event, pageNumber) => {
                            loadPage(pageNumber);
                        },
                    })
                    var result = document.querySelector('.search-result');
                    $("#totalProduct").html("Có " + res.total + " sản phẩm với kết quả tìm kiếm");
                    const html = res.products.map((product) => {
                        var discount = '';
                        var priceOld = ''
                        if (product.discount !== 0) {
                            discount = `<div class='label new'>${product.discount}%</div>`
                            priceOld = product.price
                            priceOld = priceOld.toLocaleString('vi', { style: 'currency', currency: 'VND' });
                            priceOld = priceOld.slice(0, -1) + 'đ';;
                        }
                        var price = product.price - (product.price * product.discount / 100);
                        price = price.toLocaleString('vi', { style: 'currency', currency: 'VND' });
                        price = price.slice(0, -1);
                        // ========================== Show Đánh giá ==================
                        var rating = '';
                        var user_rating = 0;
                        var totalR = 0;

                        $.each(product.reviews, function(index, value) {
                            if (value.status == 2) {
                                totalR++;
                                user_rating += value.num_star
                            }
                        })

                        var avgRatingHome = user_rating / totalR;
                        avgRatingHome = (isNaN(avgRatingHome)) ? 0 : avgRatingHome.toFixed(1);

                        // =============
                        // console.log("ID sản phẩm : " + product.id);
                        // console.log("Số sao trung bình : " + avgRatingHome);
                        for (let star = 1; star <= 5; star++) {
                            if (Math.ceil(avgRatingHome) >= star) {
                                if (avgRatingHome % 1 != 0) {
                                    if (Math.ceil(avgRatingHome) - 1 >= star) {
                                        rating += ' <i class="fa fa-star text-warning"></i>';
                                    } else if (Math.ceil(avgRatingHome) - 1 < star) {
                                        rating += ' <i class="fas fa-star-half-alt text-warning"></i>';
                                    }
                                } else {
                                    rating += ' <i class="fa fa-star text-warning"></i>';
                                }
                            } else {
                                rating += ' <i class="far fa-star text-warning"></i>';
                            }
                        }
                        rating += ' (<span>' + avgRatingHome + '</span>)'
                            //============================= End Show Rating =======================
                        return `
                            <div class="col-lg-4 col-md-6">
                            <div class="product__item" data-id="${product.slug}">
                            <div class="product__item__pic set-bg" data-setbg="${HOST}/images/${product.image}">
                            ${discount}
                            <img src="${HOST}/images/${product.image}" alt="anh">
                            <ul class="product__hover">
                                    <li><a href="${HOST}/images/${product.image}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>
                                    <a href="/detail/${product.slug}">${product.name}</a>
                                </h6>
                                <div class="rating-every-prod">
                                ${rating}
                             </div>
                                <div class="product__price">${price}đ<span>${priceOld}</span></div>
                            </div>
                        </div>
                        </div>
                        `
                    })
                    result.innerHTML = html.join(' ');
                }
            })
        })

    }
    ////sort right

    $('.filter-right').change(function() {
            sortBy = $(this).val();
            $.ajax({
                url: `${HOST}/api/allProductMen`,
                method: "GET",
                data: {
                    arrIdBrand: arrIdBrand,
                    arrIdCate: arrIdCate,
                    min: min,
                    max: max,
                    sortBy: sortBy,
                },
                success: function(res) {
                    var arrBtnPage = [];
                    if (res.total > pageSize) {
                        for (let i = 0; i < res.total; i++) {
                            arrBtnPage.push(i);
                        }
                    }
                    paginate.pagination({
                        dataSource: arrBtnPage,
                        pageSize: pageSize,
                        afterPageOnClick: (event, pageNumber) => {
                            loadPage(pageNumber);
                        },
                        afterPreviousOnClick: (event, pageNumber) => {
                            loadPage(pageNumber);
                        },
                        afterNextOnClick: (event, pageNumber) => {
                            loadPage(pageNumber);
                        },
                    })
                    var result = document.querySelector('.search-result');
                    $("#totalProduct").html("Có " + res.total + " sản phẩm với kết quả tìm kiếm");
                    const html = res.products.map((product) => {
                        var discount = '';
                        var priceOld = ''
                        if (product.discount !== 0) {
                            discount = `<div class='label new'>${product.discount}%</div>`
                            priceOld = product.price
                            priceOld = priceOld.toLocaleString('vi', { style: 'currency', currency: 'VND' });
                            priceOld = priceOld.slice(0, -1) + 'đ';;
                        }
                        var price = product.price - (product.price * product.discount / 100);
                        price = price.toLocaleString('vi', { style: 'currency', currency: 'VND' });
                        price = price.slice(0, -1);
                        // ========================== Show Đánh giá ==================
                        var rating = '';
                        var user_rating = 0;
                        var totalR = 0;

                        $.each(product.reviews, function(index, value) {
                            if (value.status == 2) {
                                totalR++;
                                user_rating += value.num_star
                            }
                        })

                        var avgRatingHome = user_rating / totalR;
                        avgRatingHome = (isNaN(avgRatingHome)) ? 0 : avgRatingHome.toFixed(1);

                        // =============
                        // console.log("ID sản phẩm : " + product.id);
                        // console.log("Số sao trung bình : " + avgRatingHome);
                        for (let star = 1; star <= 5; star++) {
                            if (Math.ceil(avgRatingHome) >= star) {
                                if (avgRatingHome % 1 != 0) {
                                    if (Math.ceil(avgRatingHome) - 1 >= star) {
                                        rating += ' <i class="fa fa-star text-warning"></i>';
                                    } else if (Math.ceil(avgRatingHome) - 1 < star) {
                                        rating += ' <i class="fas fa-star-half-alt text-warning"></i>';
                                    }
                                } else {
                                    rating += ' <i class="fa fa-star text-warning"></i>';
                                }
                            } else {
                                rating += ' <i class="far fa-star text-warning"></i>';
                            }
                        }
                        rating += ' (<span>' + avgRatingHome + '</span>)'
                            //============================= End Show Rating =======================
                        return `
                       <div class="col-lg-4 col-md-6">
                       <div class="product__item" data-id="${product.slug}">
                       <div class="product__item__pic set-bg" data-setbg="${HOST}/images/${product.image}">
                       ${discount}
                       <img src="${HOST}/images/${product.image}" alt="anh">
                       <ul class="product__hover">
                               <li><a href="${HOST}/images/${product.image}" class="image-popup"><span class="arrow_expand"></span></a></li>
                           </ul>
                       </div>
                       <div class="product__item__text">
                           <h6>
                               <a href="/detail/${product.slug}">${product.name}</a>
                           </h6>
                           <div class="rating-every-prod">
                           ${rating}
                        </div>
                           <div class="product__price">${price}đ<span>${priceOld}</span></div>
                       </div>
                   </div>
                   </div>
                   `
                    })
                    result.innerHTML = html.join(' ');
                }
            });
        })
        //custom paginate
    $('#paginate').pagination({
            dataSource: `${HOST}/api/allProductMen`,
            locator: 'products',
            pageSize: pageSize,
            totalNumberLocator: function(response) {
                if (response.total > pageSize) {
                    return response.total;
                }
                return 0;
            },
            afterPageOnClick: (event, pageNumber) => {
                loadPage(pageNumber);
            },
            afterPreviousOnClick: (event, pageNumber) => {
                loadPage(pageNumber);
            },
            afterNextOnClick: (event, pageNumber) => {
                loadPage(pageNumber);
            },
        })
        //loadpage
    function loadPage(page) {
        currentPage = page;
        $.ajax({
            type: 'GET',
            url: `${HOST}/api/allProductMen`,
            data: {
                arrIdBrand: arrIdBrand,
                arrIdCate: arrIdCate,
                min: min,
                max: max,
                sortBy: sortBy,
                page: currentPage
            },
            success: function(res) {
                var result = document.querySelector('.search-result');
                const html = res.products.map((product) => {
                    var discount = '';
                    var priceOld = ''
                    if (product.discount !== 0) {
                        discount = `<div class='label new'>${product.discount}%</div>`
                        priceOld = product.price
                        priceOld = priceOld.toLocaleString('vi', { style: 'currency', currency: 'VND' });
                        priceOld = priceOld.slice(0, -1) + 'đ';;
                    }
                    var price = product.price - (product.price * product.discount / 100);
                    price = price.toLocaleString('vi', { style: 'currency', currency: 'VND' });
                    price = price.slice(0, -1);
                    // ========================== Show Đánh giá ==================
                    var rating = '';
                    var user_rating = 0;
                    var totalR = 0;

                    $.each(product.reviews, function(index, value) {
                        if (value.status == 2) {
                            totalR++;
                            user_rating += value.num_star
                        }
                    })

                    var avgRatingHome = user_rating / totalR;
                    avgRatingHome = (isNaN(avgRatingHome)) ? 0 : avgRatingHome.toFixed(1);

                    // =============
                    // console.log("ID sản phẩm : " + product.id);
                    // console.log("Số sao trung bình : " + avgRatingHome);
                    for (let star = 1; star <= 5; star++) {
                        if (Math.ceil(avgRatingHome) >= star) {
                            if (avgRatingHome % 1 != 0) {
                                if (Math.ceil(avgRatingHome) - 1 >= star) {
                                    rating += ' <i class="fa fa-star text-warning"></i>';
                                } else if (Math.ceil(avgRatingHome) - 1 < star) {
                                    rating += ' <i class="fas fa-star-half-alt text-warning"></i>';
                                }
                            } else {
                                rating += ' <i class="fa fa-star text-warning"></i>';
                            }
                        } else {
                            rating += ' <i class="far fa-star text-warning"></i>';
                        }
                    }
                    rating += ' (<span>' + avgRatingHome + '</span>)'
                        //============================= End Show Rating =======================
                    return `
                        <div class="col-lg-4 col-md-6">
                        <div class="product__item" data-id="${product.slug}">
                        <div class="product__item__pic set-bg" data-setbg="${HOST}/images/${product.image}">
                        ${discount}
                        <img src="${HOST}/images/${product.image}" alt="anh">
                        <ul class="product__hover">
                                <li><a href="${HOST}/images/${product.image}" class="image-popup"><span class="arrow_expand"></span></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>
                                <a href="/detail/${product.slug}">${product.name}</a>
                            </h6>
                            <div class="rating-every-prod">
                            ${rating}
                         </div>
                            <div class="product__price">${price}đ<span>${priceOld}</span></div>
                        </div>
                    </div>
                    </div>
                    `
                })
                result.innerHTML = html.join(' ');
            },
            error: function(err) {
                console.log(err);
            }
        })
    }
    loadPage(1)
        /// load page