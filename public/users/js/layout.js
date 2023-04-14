$.ajaxSetup({
    headers: {
        'csrftoken': '{{ csrf_token() }}'
    }
});

function searchToggle(obj, evt) {
    var container = $(obj).closest('.search-wrapper');
    if (!container.hasClass('active')) {
        container.addClass('active');
        evt.preventDefault();
        $('.noneCustom').addClass('d-none')
        $('#liveSearch').focus()
    } else if (container.hasClass('active') && $(obj).closest('.input-holder').length == 0) {
        container.removeClass('active');
        // clear input
        container.find('.search-input').val('');
        $('.noneCustom').removeClass('d-none')
        $('.searchItem').addClass('d-none')

    }
}
$(document).ready(function() {
    $("#liveSearch").on("keyup", function() {
        var keyword = $(this).val().toLowerCase().trim();
        console.log(keyword);
        $('.searchItem').removeClass('d-none');
        $.ajax({
            type: 'POST',
            url: `${HOST}/api/searchProductShop`,
            data: {
                keyword: keyword
            },
            success: function(res) {
                console.log('result search: ', res)
                var searchItem = $('.searchItem');
                if (res.length > 0) {
                    var html = res.map(product => {
                        var discount = '';
                        var priceOld = ''
                        if (product.discount !== 0) {
                            discount = `<div class='label new'>${product.discount}%</div>`
                            priceOld = product.price
                            priceOld = priceOld.toLocaleString('vi', {
                                style: 'currency',
                                currency: 'VND'
                            });
                            priceOld = priceOld.slice(0, -1);
                        }
                        var price = product.price - (product.price * product.discount / 100);
                        price = price.toLocaleString('vi', {
                            style: 'currency',
                            currency: 'VND'
                        });
                        price = price.slice(0, -1);
                        return `
                            <div class="item-ult">
                                <div class="thumbs">
                                    <a href="/detail/${product.slug}"><img class ="img-search" src="${HOST}/images/${product.image}" alt="anh"></a>
                                </div>
                                <div class="title">
                                    <a href="/detail/${product.slug}">${product.name}</a><br>
                                    <p>${price} đ</p>
                                </div>
                            </div>
                        `
                    })
                    searchItem.html(html.join(' '));
                } else {
                    searchItem.html(' <div class="item-ult non-active">Sản phẩm bạn muốn tìm không có...</div>');
                }

            },
            error: function(err) {
                console.log(err);
            }
        });
    });
    let carts = cartSettings.get('cart');
    if(carts){
        $('.countcart').html(carts.length);
        $('.tip').html(carts.length);
    }else{
        $('.countcart').html(0)
    }
   
});