const HOST = 'http://localhost:3000';
const pageSize = 8;
$(document).ready(function() {

});
function changeColor(){
    let color = document.getElementById("color").value;
   console.log(color)
}
function chonSize(){
    
}
function tangSoLuong(){
var SoLuong = parseInt($('#qtyIpt').val());
if(SoLuong >=5){
    SoLuong =5;
    $('p[id="SoLuongToiDa"]').html('Tối đa ' + SoLuong + ' sản phẩm');
}
else{
    SoLuong ++;
    $('p[id="SoLuongToiDa"]').html('');
}
    $('input[id="qtyIpt"]').val(SoLuong);
}
function giamSoLuong(){
    var SoLuong = parseInt($('#qtyIpt').val());
    if(SoLuong <=1){
        SoLuong = 1;
        $('p[id="SoLuongToiDa"]').html('Tối thiểu ' + SoLuong + ' sản phẩm');
    }
    else{
        SoLuong --;
        $('p[id="SoLuongToiDa"]').html('');
    }
    console.log(SoLuong);
    $('input[id="qtyIpt"]').val(SoLuong);
}
var paginate = $('#paginateHome');
var filterBy = 'all';

function filter(key) {
    filterBy = key;
    $.ajax({
        type: "GET",
        url: `${HOST}/api/productsHomeFilter`,
        data: { filterBy: filterBy },
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
            function getColor(id){
                let prod = res.datatest.find(item => item.id==id);
                let arrStorage = prod.storage;
                let arrColor = arrStorage.reduce((cur,acc)=>{
                        return [...cur,acc.color] 
                },[]);
                arrColor=[...new Set(arrColor)];
                let html=arrColor.map(item=>{
                   return `<option class="chosseColor" value="${item}" >${item}</option>`
                })
                return html.join(' ');
            }
            function getSize(id){
                let arrSize = []; 
                res.output.map(item=>{
                    if(item.idProd==id){
                        arrSize.push(item.size)
                    }
                })
                function onlyUnique(value, index, self) {
                    return self.indexOf(value) === index;
                  }
                  let size= arrSize.filter(onlyUnique);
                  let html=size.map(item=>{
                    return `<input type="radio" class="sizes" id="xs-btn-${item}" name="sizes" value="${item}"><label>${item}</label>`
                 })
                 return html.join(' ');
            }
            var result = document.querySelector('.filter-result');
            const html = res.products.map((product) => {
                var discount = '';
                var priceOld = ''
                if (product.discount !== 0) {
                    discount = `<div style="background-color:red;" class='label new'>${product.discount}%</div>`
                    priceOld = product.price
                    priceOld = priceOld.toLocaleString('vi', { style: 'currency', currency: 'VND' });
                    priceOld = priceOld.slice(0, -1) + 'đ';
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
                <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item" data-id="${product.slug}">
                    <div class="product__item__pic set-bg" data-setbg="${HOST}/images/${product.image}">
                    ${discount}
                    <a href="/detail/${product.slug}"> <img src="${HOST}/images/${product.image}" alt="anh"></a>
                    <ul class="product__hover">
                    <li><a href="${HOST}/images/${product.image}" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li><a ><span class="icon_bag_alt" data-toggle="modal" data-target="#Modal_BuyNow${product.id}"></span> </a></li>
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
            <div class="modal fade themvaogio" id="Modal_BuyNow${product.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="wrapper-themvaogio">
                                <div class="box-themvaogio fadeIn" class="">
                                    <div class="tieude">
                                        <h1>THÔNG TIN SẢN PHẨM</h1>
                                    </div>
                                    <div class="content">
                                        <div class="left">
                                            <div class="box-img">
                                                    <img src="${HOST}/images/${product.image}" alt="">
                                            </div>
                                        </div>
                                        <div class="right">
                                            <div class="mausac">
                                                    <h1>Màu sắc có sẵn <span style="color: #e96b6d;">*</span></h1>
                                                    <div class="size-action">
                                                        <select name="" id="color" >
                                                            ${getColor(product.id)}
                                                        </select>
                                                        <p id="SoLuongSize"></p>
                                                    </div>
                                                
                                            </div>
                                            <div class="size">
                                                <h1>Size có sẵn <span style="color: #e96b6d;">*</span></h1>
                                                <div class="box-color">
                                                ${getSize(product.id)}
                                                </div>
                                                <p class="text-danger" id="ChonSize"></p>
                                                <div class="ChonSoLuongSize">
                                                    <h1>Chọn số lượng</h1>
                                                    <div class="ChonSoLuongSize-action">
                                                        <button id="GiamSoLuong" onclick = "giamSoLuong()">-</button>
                                                        <input id="qtyIpt" type="number" min = "1" max = "2" value="1">
                                                        <button id="TangSoLuong" onclick = "tangSoLuong()">+</button>
                                                    </div>
                                                </div>
                                                <p id="SoLuongToiDa"></p>
                                            </div>
                                        </div>
                                        <input type="hidden" name="" id="image" value='${HOST}/images/${product.image}'>
                                    </div>
                                    <div class="action">
                                        <button id="submit-muahang" onclick = "addToCartNhanh(${product.id},'${product.name}',${product.price})">Mua ngay</button>
                                        <button id="close-themvaogio" data-dismiss="modal">Hủy</button>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
            <div class="modal fade" id="Modal_AddtoCart${product.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="wrapper-themvaogio">
                                <div class="box-themvaogio fadeIn" class="">
                                    <div class="tieude">
                                        <h1>THÔNG TIN SẢN PHẨM</h1>
                                    </div>
                                    <div class="content">
                                        <div class="left">
                                            <div class="box-img">
                                                    <img src="${HOST}/images/${product.image}" alt="">
                                            </div>
                                        </div>
                                        <div class="right">
                                            <div class="mausac">
                                                    <h1>Size có sẵn <span style="color: #e96b6d;">*</span></h1>
                                                    <div class="size-action">
                                                        <select name="" id="color" >
                                                            ${getColor(product.id)}
                                                        </select>
                                                        <p id="SoLuongSize"></p>
                                                    </div>
                                                   
                                            </div>
                                            <div class="size">
                                                <h1>Màu có sẵn <span style="color: #e96b6d;">*</span></h1>
                                                <div class="box-color">
                                                ${getSize(product.id)}
                                                </div>
                                                <p class="text-danger" id="ChonSize"></p>
                                                <div class="ChonSoLuongSize">
                                                    <h1>Chọn số lượng</h1>
                                                    <div class="ChonSoLuongSize-action">
                                                        <button id="GiamSoLuong" onclick = "giamSoLuong()">-</button>
                                                        <input id="qtyIpt" type="number" min = "1" max = "2" value="1">
                                                        <button id="TangSoLuong" onclick = "tangSoLuong()">+</button>
                                                    </div>
                                                </div>
                                                <p id="SoLuongToiDa"></p>
                                            </div>
                                        </div>
                                        <input type="hidden" name="" id="image" value='${HOST}/images/${product.image}'>
                                    </div>
                                    <div class="action">
                                        <button id="submit-muahang" onclick = "addToCartNhanh${product.id},'${product.name}',${product.price})">Thêm vào giỏ</button>
                                        <button id="close-themvaogio" data-dismiss="modal">Hủy</button>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
                `
            })
            result.innerHTML = html.join(' ');
        },
        error: (err) => {
            console.log('err', err)
        }
    })

}
//custom paginate
$('#paginateHome').pagination({
        dataSource: `${HOST}/api/productsHomeFilter`,
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
        url: `${HOST}/api/productsHomeFilter`,
        data: {
            filterBy: filterBy,
            page: currentPage
        },
        success: function(res) {
            function getColor(id){
                let prod = res.datatest.find(item => item.id==id);
                let arrStorage = prod.storage;
                let arrColor = arrStorage.reduce((cur,acc)=>{
                        return [...cur,acc.color] 
                },[]);
                arrColor=[...new Set(arrColor)];
                let html=arrColor.map(item=>{
                   return `<option class="chosseColor" value="${item}">${item}</option>`
                })

                return html.join(' ');
            }
            function getSize(id){
                let arrSize = []; 
                res.output.map(item=>{
                    if(item.idProd==id){
                        arrSize.push(item.size)
                    }
                })
                function onlyUnique(value, index, self) {
                    return self.indexOf(value) === index;
                    }
                    let size= arrSize.filter(onlyUnique);
                    let html=size.map(item=>{
                    return `<input type="radio" class="sizes" id="xs-btn-${item}" name="sizes" value="${item}"><label>${item}</label>`
                    })
                    return html.join(' ');
            }
            var result = document.querySelector('.filter-result');
            const html = res.products.map((product) => {
                var discount = '';
                var priceOld = ''
                if (product.discount !== 0) {
                    discount = `<div style="background-color:red;" class='label new'>${product.discount}%</div>`
                    priceOld = product.price
                    priceOld = priceOld.toLocaleString('vi', { style: 'currency', currency: 'VND' });
                    priceOld = priceOld.slice(0, -1) + 'đ';
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
                    <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item" data-id="${product.slug}">
                        <div class="product__item__pic set-bg" data-setbg="${HOST}/images/${product.image}">
                        ${discount}
                        <a href="/detail/${product.slug}"> <img src="${HOST}/images/${product.image}" alt="anh"></a>
                        <ul class="product__hover">
                        <li><a href="${HOST}/images/${product.image}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                <li><a ><span class="icon_bag_alt" data-toggle="modal" data-target="#Modal_AddtoCart${product.id}"></span></a></li>
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
                <div class="modal fade" id="Modal_BuyNow${product.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="wrapper-themvaogio">
                                    <div class="box-themvaogio fadeIn" class="">
                                        <div class="tieude">
                                            <h1>THÔNG TIN SẢN PHẨM</h1>
                                        </div>
                                        <div class="content">
                                            <div class="left">
                                                <div class="box-img">
                                                        <img src="${HOST}/images/${product.image}" alt="">
                                                </div>
                                            </div>
                                            <div class="right">
                                                <div class="mausac">
                                                        <h1>Size có sẵn <span style="color: #e96b6d;">*</span></h1>
                                                        <div class="size-action">
                                                            <select name="" id="color" >
                                                                ${getColor(product.id)}
                                                            </select>
                                                            <p id="SoLuongSize"></p>
                                                        </div>
                                                    
                                                </div>
                                                <div class="size">
                                                    <h1>Màu có sẵn <span style="color: #e96b6d;">*</span></h1>
                                                    <div class="box-color">
                                                    ${getSize(product.id)}
                                                    </div>
                                                    <p class="text-danger" id="ChonSize"></p>
                                                    <div class="ChonSoLuongSize">
                                                        <h1>Chọn số lượng</h1>
                                                        <div class="ChonSoLuongSize-action">
                                                            <button id="GiamSoLuong" onclick = "giamSoLuong()">-</button>
                                                            <input id="qtyIpt" type="number" min = "1" max = "2" value="1">
                                                            <button id="TangSoLuong" onclick = "tangSoLuong()">+</button>
                                                        </div>
                                                    </div>
                                                    <p id="SoLuongToiDa"></p>
                                                </div>
                                            </div>
                                            <input type="hidden" name="" id="image" value='${HOST}/images/${product.image}'>
                                        </div>
                                        <div class="action">
                                            <button id="submit-muahang" onclick = "addToCartNhanh(${product.id},'${product.name}',${product.price})">Mua ngay</button>
                                            <button id="close-themvaogio" data-dismiss="modal">Hủy</button>
                                        </div>
                                    </div>
                                </div>
                            </div>                    
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="Modal_AddtoCart${product.id}" tabindex="-1"  aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="wrapper-themvaogio">
                                    <div class="box-themvaogio fadeIn" class="">
                                        <div class="tieude">
                                            <h1>THÔNG TIN SẢN PHẨM</h1>
                                        </div>
                                        <div class="content">
                                            <div class="left">
                                                <div class="box-img">
                                                        <img src="${HOST}/images/${product.image}" alt="">
                                                </div>
                                            </div>
                                            <div class="right">
                                                <div class="mausac">
                                                        <h1>Màu sắc có sẵn: <span style="color: #e96b6d;">*</span></h1>
                                                        <div class="size-action">
                                                            <select id="color">
                                                                ${getColor(product.id)}
                                                            </select>
                                                            <p id="SoLuongSize"></p>
                                                        </div>
                                                       
                                                </div>
                                                <div class="size">
                                                    <h1>Size có sẵn <span style="color: #e96b6d;">*</span></h1>
                                                    <div class="box-color">
                                                    ${getSize(product.id)}
                                                    </div>
                                                    <p class="text-danger" id="ChonSize"></p>
                                                    <div class="ChonSoLuongSize">
                                                        <h1>Chọn số lượng</h1>
                                                        <div class="ChonSoLuongSize-action">
                                                            <button id="GiamSoLuong" onclick = "giamSoLuong()">-</button>
                                                            <input id="qtyIpt" type="number" min = "1" max = "2" value="1">
                                                            <button id="TangSoLuong" onclick = "tangSoLuong()">+</button>
                                                        </div>
                                                    </div>
                                                    <p id="SoLuongToiDa"></p>
                                                </div>
                                            </div>
                                            <input type="hidden" name="" id="image" value='${HOST}/images/${product.image}'>
                                        </div>
                                        <div class="action">
                                            <button id="submit-muahang" onclick = "addToCartNhanh(${product.id},'${product.name}',${product.price})">Thêm vào giỏ</button>
                                            <button id="close-themvaogio" data-dismiss="modal">Hủy</button>
                                        </div>
                                    </div>
                                </div>
                            </div>                    
                        </div>
                    </div>
                </div>
                `
            })
            result.innerHTML = html.join(' ');
        },
        error: function(err) {
            console.log('err', err);
        }
        
    })
}
loadPage(1)


