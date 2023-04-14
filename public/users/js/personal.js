var host =window.location.host;
$(document).ready(function () {
    $.ajaxSetup({
        data: {
            host:host,
        },
    });
    if($(window).width()>=1200){
        loadBill();
        loadBill1();
        loadAllBill();
    }else{
        $(".billdetailbtn").click(function (e) { 
            e.preventDefault();
            var id= $(this).attr('data-id');
            var host = window.location.host;
            $.ajax({
                type: "post",
                url: "http://127.0.0.1:3000/api/singleBill",
                data:   
                {
                    id:id,
                    host:host
                },
                dataType: "JSON",
                success: function (response) {
                    if(response.check==true){
                        console.log(response.result);
                        var stt='';
                        var str=``;
                        str+=`
                        <table class="table tabledetail">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                        `;
                        var i =1;
                        response.result.forEach(el => {
                            var price = el["qty"]*(el["price"]-(el["price"]*el["discount"]/100));
                            str+=`
                                <tr>
                                    <td><p class="p_checkout">`+(i++)+`</p> </td>
                                    <td><img class="img_checkout" src="http://127.0.0.1:3000/images/`+el['image']+`" alt=""></td>
                                    <td><p class="p_checkout">`+el["name"]+`</p> </td>
                                    <td><p class="p_checkout">`+el["qty"]+` </p></td>
                                    <td><pclass="p_checkout">`+numeral(price).format('0,0')+`</pclass=> </td>
                                </tr>
                                
                            `;
                        });
                        if(response.status==2){
                            str+=`
                           
                            </tbody>
                            <tfooter>
                            <tr>
                            <td colspan="4"></td>
                            <td colspan="1"><button class="btn btn-sm btn-success" id="btnRCBill" data-id="`+id+`">Đã nhận hàng</button></td>
                             </tr>
                            </tfooter>
                            </table>
                            `;
                        }else{
                            str+=`
                            </tbody>
                            </table>
                            `;
                        }
    
                        $("#resultBillDetail").html(str);
                        $("#btnRCBill").click(function (e) { 
                            e.preventDefault();
                            var id = $(this).attr('data-id');
                            var host = window.location.host;
                            Swal.fire({
                                icon:'question',
                                text: 'Giao hàng thành công?',
                                showDenyButton: true,
                                showCancelButton: false,
                                confirmButtonText: 'Đúng',
                                denyButtonText: `Không`,
                              }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                  $.ajax({
                                    type: "post",
                                    url: "http://127.0.0.1:3000/api/updateBill",
                                    data: {
                                        id:id,
                                        host:host,
                                        stt:3
                                    },
                                    dataType: "JSON",
                                    success: function (response) {
                                        if(response.check==true){
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
                                                icon: 'success',
                                                title: 'Giao hàng thành công'
                                              }).then(()=>{
                                                window.location.reload();
                                              })
                                        }else if(response.check==false){
                                            if(response.message.id){
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
                                                    icon: 'success',
                                                    title: response.message.id
                                                  })
                                            }else if(response.message){
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
                                                    icon: 'success',
                                                    title: response.message
                                                  })
                                            }
                                        }
                                    }
                                  });
                                } else if (result.isDenied) {
                                  
                                }
                              })
                        });
                    }
                }
            });
           
        });
        $("#allBillsLink").click(function (e) { 
            e.preventDefault();
            window.location.reload();
        });
    }

});
function loadBill1(){
    var host = window.location.host;
    var email = $("#useremaillogin").val();
    $.ajax({
        type: "post",
        url: "http://127.0.0.1:3000/api/getUserBills2",
        data:   
        {
            host:host,
            email:email,
        },
        dataType: "JSON",
        success: function (response) {
            // console.log(response.result);
            var i=1;
           var str=``;
           str+=`
           <table class="table tablebills">
           <thead class="table-dark">
               <tr>
                   <th>#</th>
                   <th>Ngày đặt hàng</th>
                   <th>Tổng tiền</th>
                   <th>Tình trạng</th>
                   <th class="desktop"></th>
               </tr>
           </thead>
           <tbody>
           `;
            response.result.forEach(el => {
                var stt='';
                if(el['status']==1){
                    stt=`<b>Đã đặt hàng</b>`;
                }else if(el['status']==2){
                    stt=`<b>Đang giao</b>`;
                }else if(el['status']==0){
                    stt=` <b>Đã hủy</b>`;
                }else if(el['status']==3){
                    stt=` <b>Thành công</b>`;
                }
                sttbill=el['status'];
                str+=`
                <tr>
                    <td>`+(i++)+`</td>
                    <td>`+el["created_at"]+`</td>
                    <td>`+numeral(el["total"]).format('0,0')+`</td>
                    <td>
                    `+stt+`
                    </td>
                    <td class="desktop">
                       <a href="#" class="btn-sm btn-success billdetailbtn " data-id="`+el["idBill"]+`">Chi tiết</a>
                    </td>
               </tr>
                `;
            });
           str+=`   
            </tbody>
            </table>
           `;
            $("#resultBillDetail").html(str);
            $(".billdetailbtn").click(function (e) { 
                e.preventDefault();
                var id = $(this).attr('data-id');
                var host = window.location.host;
                $.ajax({
                    type: "post",
                    url: "http://127.0.0.1:3000/api/singleBill",
                    data:   
                    {
                        host:host,
                        id:id,
                    },
                    dataType: "JSON",
                    success: function (response) {
                        if(response.check==true){
                            var str=``;
                            str+=`
                            <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                            `;
                            var i =1;
                            response.result.forEach(el => {
                                var price = el["qty"]*(el["price"]-(el["price"]*el["discount"]/100));
                                str+=`
                                <tr>
                                <td><p class="p_checkout">`+(i++)+`</p> </td>
                                <td><img class="img_checkout" src="http://127.0.0.1:3000/images/`+el['image']+`" alt=""></td>
                                <td><p class="p_checkout">`+el["name"]+`</p> </td>
                                <td><p class="p_checkout">`+el["qty"]+` </p></td>
                                <td><p class="p_checkout">`+numeral(price).format('0,0')+`</p> </td>
                                </tr>
                                `;
                            });
                            
                            if(response.status==2){
                                str+=`
                            </tbody>
                                </table>
                                <table>
                                <tr>
                                    <td>
                                    <button class="btn btn-sm btn-success" id="btnRCBill" data-id="`+id+`">Đã nhận hàng</button>
                                    </td>
                                </tr>
                                </table>
                                `;
                            }else{
                                str+=`
                            </tbody>
                            </table>
                            `;
                            }
                            
                            $("#resultBillDetail").html(str);
                            
                            // ====================================


                            $("#btnRCBill").click(function (e) { 
                                e.preventDefault();
                                var id = $(this).attr('data-id');
                                var host = window.location.host;
                                Swal.fire({
                                    icon:'question',
                                    text: 'Giao hàng thành công?',
                                    showDenyButton: true,
                                    showCancelButton: false,
                                    confirmButtonText: 'Đúng',
                                    denyButtonText: `Không`,
                                  }).then((result) => {
                                    /* Read more about isConfirmed, isDenied below */
                                    if (result.isConfirmed) {
                                      $.ajax({
                                        type: "post",
                                        url: "http://127.0.0.1:3000/api/updateBill",
                                        data: {
                                            host:host,
                                            id:id,
                                            stt:3
                                        },
                                        dataType: "JSON",
                                        success: function (response) {
                                            if(response.check==true){
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
                                                    icon: 'success',
                                                    title: 'Giao hàng thành công'
                                                  }).then(()=>{
                                                    window.location.reload();
                                                  })
                                            }else if(response.check==false){
                                                if(response.message.id){
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
                                                        icon: 'success',
                                                        title: response.message.id
                                                      })
                                                }else if(response.message){
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
                                                        icon: 'success',
                                                        title: response.message
                                                      })
                                                }
                                            }
                                        }
                                      });
                                    } else if (result.isDenied) {
                                      
                                    }
                                  })
                            });
                        }
                    }
                });
            });
        }
        });
}
function loadAllBill(){
    var sttbill='';
    $("#allBillsLink").click(function (e) {
        var host = window.location.host;
        var email = $("#useremaillogin").val();
        $.ajax({
            type: "post",
            url: "http://127.0.0.1:3000/api/getUserBills2",
            data:   
            {
                host:host,
                email:email,
            },
            dataType: "JSON",
            success: function (response) {
                console.log(response.result);
                var i=1;
               var str=``;
               str+=`
               <table class="table">
               <thead class="table-dark">
                   <tr>
                       <th>#</th>
                       <th>Ngày đặt hàng</th>
                       <th>Tổng tiền</th>
                       <th>Tình trạng</th>
                       <th class="desktop"></th>
                   </tr>
               </thead>
               <tbody>
               `;
                response.result.forEach(el => {
                    var stt='';
                    if(el['status']==1){
                        stt=`<b>Đã đặt hàng</b>`;
                    }else if(el['status']==2){
                        stt=`<b>Đang giao</b>`;
                    }else if(el['status']==0){
                        stt=` <b>Đã hủy</b>`;
                    }else if(el['status']==3){
                        stt=` <b>Thành công</b>`;
                    }
                    sttbill=el['status'];
                    str+=`
                    <tr>
                        <td>`+(i++)+`</td>
                        <td>`+el["created_at"]+`</td>
                        <td>`+numeral(el["total"]).format('0,0')+`</td>
                        <td>
                        `+stt+`
                        </td>
                        <td class="desktop">
                           <a href="#" class="btn-sm btn-success billdetailbtn" data-id="`+el["idBill"]+`">Chi tiết</a>
                        </td>
                   </tr>
                    `;
                });
               str+=`   
                </tbody>
                </table>
               `;
                $("#resultBillDetail").html(str);
                $(".billdetailbtn").click(function (e) { 
                    e.preventDefault();
                    var id = $(this).attr('data-id');
                    var host = window.location.host;
                    $.ajax({
                        type: "post",
                        url: "http://127.0.0.1:3000/api/singleBill",
                        data:   
                        {
                            id:id,
                            host:host,
                        },
                        dataType: "JSON",
                        success: function (response) {
                            if(response.check==true){
                                var str=``;
                                str+=`
                                <table class="table tabledetail">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                `;
                                var i =1;
                                response.result.forEach(el => {
                                    var price = el["qty"]*(el["price"]-(el["price"]*el["discount"]/100));
                                    str+=`
                                    <tr>
                                    <td><p class="p_checkout">`+(i++)+`</p> </td>
                                    <td><img class="img_checkout"  src="http://127.0.0.1:3000/images/`+el['image']+`" alt=""></td>
                                    <td><p class="p_checkout">`+el["name"]+`</p> </td>
                                    <td><p class="p_checkout">`+el["qty"]+` </p></td>
                                    <td><p class="p_checkout">`+numeral(price).format('0,0')+`</p> </td>
                                    </tr>
                                    `;
                                });
                                if(response.status==2){
                                    str+=`
                                    </tbody>
                                </table>
                                <table>
                                <tr>
                                    <td>
                                    <button class="btn btn-sm btn-success" id="btnRCBill" data-id="`+id+`">Đã nhận hàng</button>
                                    </td>
                                </tr>
                                </table>
                                    `;
                                }else{
                                    str+=`
                                </tbody>
                                </table>
                                `;
                                }
                                
                                $("#resultBillDetail").html(str);
                                
                                // ====================================


                                $("#btnRCBill").click(function (e) { 
                                    e.preventDefault();
                                    var id = $(this).attr('data-id');
                                    var host = window.location.host;
                                    Swal.fire({
                                        icon:'question',
                                        text: 'Giao hàng thành công?',
                                        showDenyButton: true,
                                        showCancelButton: false,
                                        confirmButtonText: 'Đúng',
                                        denyButtonText: `Không`,
                                      }).then((result) => {
                                        /* Read more about isConfirmed, isDenied below */
                                        if (result.isConfirmed) {
                                          $.ajax({
                                            type: "post",
                                            url: "http://127.0.0.1:3000/api/updateBill",
                                            data: {
                                                id:id,
                                                host:host,
                                                stt:3
                                            },
                                            dataType: "JSON",
                                            success: function (response) {
                                                if(response.check==true){
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
                                                        icon: 'success',
                                                        title: 'Giao hàng thành công'
                                                      }).then(()=>{
                                                        window.location.reload();
                                                      })
                                                }else if(response.check==false){
                                                    if(response.message.id){
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
                                                            icon: 'success',
                                                            title: response.message.id
                                                          })
                                                    }else if(response.message){
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
                                                            icon: 'success',
                                                            title: response.message
                                                          })
                                                    }
                                                }
                                            }
                                          });
                                        } else if (result.isDenied) {
                                          
                                        }
                                      })
                                });
                            }
                        }
                    });
                });

            }
        });
        
    });
}
// =================================================
function loadBill(){
    $(".billdetailbtn").click(function (e) { 
        e.preventDefault();
        var id= $(this).attr('data-id');
        var host = window.location.host;
        $.ajax({
            type: "post",
            url: "http://127.0.0.1:3000/api/singleBill",
            data:   
            {
                id:id,
                host:host
            },
            dataType: "JSON",
            success: function (response) {
                if(response.check==true){
                    console.log(response.result);
                    var stt='';
                    var str=``;
                    str+=`
                    <table class="table tabledetail">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                    `;
                    var i =1;
                    response.result.forEach(el => {
                        var price = el["qty"]*(el["price"]-(el["price"]*el["discount"]/100));
                        str+=`
                            <tr>
                                <td><p class="p_checkout">`+(i++)+`</p> </td>
                                <td><img class="img_checkout" src="http://127.0.0.1:3000/images/`+el['image']+`" alt=""></td>
                                <td><p class="p_checkout">`+el["name"]+`</p> </td>
                                <td><p class="p_checkout">`+el["qty"]+` </p></td>
                                <td><p class="p_checkout">`+numeral(price).format('0,0')+`</p> </td>
                            </tr>
                            
                        `;
                    });
                    if(response.status==2){
                        str+=`
                       
                        </tbody>
                        <tfooter>
                        <tr>
                        <td colspan="4"></td>
                        <td colspan="1"><button class="btn btn-sm btn-success" id="btnRCBill" data-id="`+id+`">Đã nhận hàng</button></td>
                         </tr>
                        </tfooter>
                        </table>
                        `;
                    }else{
                        str+=`
                        </tbody>
                        </table>
                        `;
                    }

                    $("#resultBillDetail").html(str);
                    $("#btnRCBill").click(function (e) { 
                        e.preventDefault();
                        var id = $(this).attr('data-id');
                        var host = window.location.host;
                        Swal.fire({
                            icon:'question',
                            text: 'Giao hàng thành công?',
                            showDenyButton: true,
                            showCancelButton: false,
                            confirmButtonText: 'Đúng',
                            denyButtonText: `Không`,
                          }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                              $.ajax({
                                type: "post",
                                url: "http://127.0.0.1:3000/api/updateBill",
                                data: {
                                    id:id,
                                    host:host,
                                    stt:3
                                },
                                dataType: "JSON",
                                success: function (response) {
                                    if(response.check==true){
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
                                            icon: 'success',
                                            title: 'Giao hàng thành công'
                                          }).then(()=>{
                                            window.location.reload();
                                          })
                                    }else if(response.check==false){
                                        if(response.message.id){
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
                                                icon: 'success',
                                                title: response.message.id
                                              })
                                        }else if(response.message){
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
                                                icon: 'success',
                                                title: response.message
                                              })
                                        }
                                    }
                                }
                              });
                            } else if (result.isDenied) {
                              
                            }
                          })
                    });
                }
            }
        });
       
    });
}
