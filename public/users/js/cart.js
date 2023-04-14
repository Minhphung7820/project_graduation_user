$(document).ready(function() {
    showCart()
});
     Toast = Swal.mixin({
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
function createStorage(key){
    const store =JSON.parse(localStorage.getItem(key))??{};
    const save=function(){
        localStorage.setItem(key, JSON.stringify(store))
    }
    const storage = {
        get(key){
            return store[key];
        },
        set(key, value){
            store[key]=value;
            save()
        },
        remove(key){
            delete store[key];
            save()
        },
    }
    return storage;
}
function currency(number){
    number = number.toLocaleString('vi', {style : 'currency', currency : 'VND'});
    return number
}
var cartSettings = createStorage('cart');
function showCart(carts=cartSettings.get('cart')){
    let result = document.querySelector('#cartresult');
    if(result){
        if(!carts){
            carts=[];
        }
        let countcart = document.querySelector('.countcart');
        countcart.innerHTML=carts.length;
        const html = carts.map(product=>{
            const {idCart,id,name,price,image,qty,size,color}=product;
            return`
                    <tr>
                    <td><img class="cart__image" src="${image}"></td>
                    <td class="cart__product__item">
                        <img src="img/shop-cart/cp-1.jpg" alt="">
                        <div class="cart__product__item__title">
                            <h6>${name}</h6>
                        </div>
                    </td>
                    <td class="cart__size">${size}</td>
                    <td class="cart__color">${color}</td>
                    <td class="cart__price">${currency(Number(price))}</td>
                    <td class="cart__quantity">
                    <div class="pro-qty">
                        <span class="dec qtybtn desc" onclick="decreaseQty(${idCart})">-</span>
                        <input type="text" value="${qty}" onkeydown="return false">
                        <span class="inc qtybtn" onclick="increaseQty(${idCart})">+</span>
                    </div>
                </td>
                    <td class="cart__total">${currency(Number(price*qty))}</td>
                    <td class="cart__close"><span class="icon_close" onclick="delCart(${idCart})"></span></td>
                </tr>
            `
        })
        if(html.length==0){
            result.innerHTML='<tr><td class="text-center" colspan="7"><h2>Giỏ hàng đang trống</h2></td></tr>';
            return 
        }
        result.innerHTML = html.join(' ')
    };
}
function showCheckOut(){
    let checkOut = document.querySelector('#checkout');
    let carts = cartSettings.get('cart');
    if(checkOut){
        if(!carts){
            carts=[];
        }
        const html = carts.map(product=>{
            const {name,price,qty,size,color}=product;
            return`
                <li class="item__checkout pb-2">
                    <div class="checkout-name">	
                            ${name}
                        </div>
                        <div  class="checkout-price">
                        ${currency(Number(price*qty))}
                    </div>
                </li>
            `
        })
        let total = carts.reduce((cur,acc)=>{
            return Number(cur)+ (Number(acc.price)*acc.qty);
        },0)
        if(html.length==0){
            checkOut.innerHTML='<tr><td colspan="7"><h5  class="text-center" >Giỏ hàng đang trống</h5></td></tr>';
            $('#checkOutBtn').addClass('d-none');
            return 
        }
        checkOut.innerHTML = html.join(' ')+`<li class="total__price">Tổng tiền: <span>${currency(total)}</span></li>`;
    }
}
    showCheckOut()
function addToCart(...value){
    const [id,name,price] = value;
    const image = $("#image").val();
    let qty = $("#qtyIpt").val();
    qty =Number(qty);
    let color = $("#color option:selected").val();
    let sizeInfo = document.querySelector('input[name="sizes"]:checked');
    let carts =[]
    if(cartSettings.get('cart')){
        carts=cartSettings.get('cart');
    }
    let item = carts.find(function(cart){
        return cart.id === id && cart.size===size && cart.color===color
    });
    let toast = '';
    //Random id cart
    const idCart = Math.floor(Math.random() * (90000 - 10000)) + 10000;
    if(item){
        item.qty ++;
        toast='Đã cập nhật số lượng'
    }else{
        if(!sizeInfo||sizeInfo=='null'){
            Toast.fire({
                icon: 'error',
                width: 300,
                title: 'Chọn Size sản phẩm!'
            })
            return
        }else{
            let arrSize=sizeInfo.value.split('-');
            var size = arrSize[0];
            if(arrSize[1]){
                idStorage = arrSize[1];
            }else{
                idStorage=null;
            }
            
        }
        carts.push({idCart,id, name, price, qty, image, color, size,idStorage})
        toast='Đã thêm vào giỏ'
    }
    $('.countcart2').html(carts.length);
    $('.countcart').html(carts.length)
    cartSettings.set('cart', carts);
    Toast.fire({
        icon: 'success',
        width: 300,
        title: toast       
    })
}
function addToCartNhanh(...value){
    const [id,name,price] = value;
    const image = $("#image").val();
    let qty = $("#qtyIpt").val();
    qty =Number(qty);
    let colorS = $("#color option:selected").val();
    let idStorage=colorS.split('-')[1];
    let color = colorS.split('-')[0];
    let sizeInfo = document.querySelector('input[name="sizes"]:checked');
    let carts =[]
    if(cartSettings.get('cart')){
        carts=cartSettings.get('cart');
    }
    let item = carts.find(function(cart){
        return cart.id === id && cart.size===size && cart.color===color
    });
    let toast = '';
    //Random id cart
    const idCart = Math.floor(Math.random() * (90000 - 10000)) + 10000;
    if(item){
        item.qty ++;
        toast='Đã cập nhật số lượng'
    }else{
        if(!sizeInfo||sizeInfo=='null'){
            $('p[id="ChonSize"]').html('Bạn chưa chọn size');
            return
        }else{
            $('p[id="ChonSize"]').html('');
            let arrSize=sizeInfo.value.split('-');
            var size = arrSize[0]; 
        }
        carts.push({idCart,id, name, price, qty, image, color, size,idStorage})
        toast='Đã thêm vào giỏ'

    }
    $('.modal').modal('hide')
    $('.countcart2').html(carts.length);
    $('.countcart').html(carts.length)
    cartSettings.set('cart', carts);
    Toast.fire({
        icon: 'success',
        width: 300,
        title: toast       

    })
}
function delCart(idCart){
    if(cartSettings.get('cart')){
        carts = cartSettings.get('cart');
        carts = carts.filter(item=>item.idCart!=idCart);
        cartSettings.set('cart',carts);
        showCart();
        showCheckOut();
    }
}
function increaseQty(idCart){
    if(cartSettings.get('cart')){
        carts=cartSettings.get('cart');
    }
    let item = carts.find(function(cart){
        return cart.idCart === idCart;
    });
    if(item){
        if(item.qty>=5){
            Toast.fire({
                icon: 'error',
                width: 350,
                title: 'Tối đa 5 sản phẩm'
            })
            return
        }else{
            item.qty ++;
        }
        
    }
    cartSettings.set('cart',carts);
    showCart();
    showCheckOut();
}
function decreaseQty(idCart){
    if(cartSettings.get('cart')){
        carts=cartSettings.get('cart');
    }
    let item = carts.find(function(cart){
        return cart.idCart === idCart
    });
    if(item.qty>1){
        item.qty --;
    }
    cartSettings.set('cart',carts);
    showCart();
    showCheckOut();
}
    function checkOutBtn(){
        if (sessionStorage.getItem('login') && sessionStorage.getItem('login') != '') {
            customername = $("#usernamelogin").val().trim();
            customeremail = $("#useremaillogin").val().trim();
        }
        $("#recievername").val(customername);
        $("#checkoutModal").modal('show');
        $("#submitCounterBtn").click(function(e) {
            e.preventDefault();
            address = $("#recieveraddress").val().trim();
            note = $("#note").val().trim();
            phone = $("#recieverphone").val().trim();
            recievername = $("#recievername").val().trim();
            if (customername == '' || recievername == '') {
                Toast.fire({
                    icon: 'error',
                    title: 'Bạn chưa đăng nhập'
                })
            } else if (customeremail == '') {
                Toast.fire({
                    icon: 'error',
                    title: 'Bạn chưa đăng nhập'
                })
            } else if (address == '') {
                Toast.fire({
                    icon: 'error',
                    title: 'Thiếu địa chỉ giao hàng'
                })
            } else if (phone == '') {
                Toast.fire({
                    icon: 'error',
                    title: 'Thiếu số điện thoại nhận hàng'
                })
            } else if (!phone.match(/(0[3|5|7|8|9])+([0-9]{8})\b/g)) {
                Toast.fire({
                    icon: 'error',
                    title: 'Số điện thoại nhận hàng không hợp lệ'
                })
            } else {
                if (customername == '') {
                    Toast.fire({
                        icon: 'error',
                        title: 'Vui lòng đăng nhập bằng gmail'
                    })
                } else {
                    let carts =cartSettings.get('cart');
                    
                    let total = carts.reduce((cur,acc)=>{
                        return Number(cur)+ (Number(acc.price)*acc.qty);
                    },0)
                    let cart = carts.filter(item=>item.idStorage!=null);
                    $.ajax({
                        type: "post",
                        url: "http://127.0.0.1:3000/api/submitBill",
                        data: {
                            name: customername,
                            phone: phone,
                            email: customeremail,
                            address: address,
                            note: note,
                            reciver: recievername,
                            cart: cart,
                            total: total,
                            provider: $("#userPIlogin").val(),
                        },
                        success: function(response) {
                            if (response.check == true) {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Đặt hàng thành công'
                                });
                                total = 0;
                                $("#checkoutModal").modal('hide');
                                cartSettings.remove('cart');
                                showCart();
                                showCheckOut();
                                $('#checkOutBtn').addClass('d-none');
                            } else if (response.check == false) {
                                if (response.message.name) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: response.message.name
                                    })
                                } else if (response.message.phone) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: response.message.phone
                                    })
                                } else if (response.message.address) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: response.message.address
                                    })
                                } else if (response.message.reciver) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: response.message.reciver
                                    })
                                } else if (response.message.cart) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: response.message.cart
                                    })
                                }
                            }
                        }
                    });
                }

            }
        });
    }
