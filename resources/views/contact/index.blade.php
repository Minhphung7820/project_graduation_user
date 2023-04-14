@extends('layout.layout')
@section('title', 'Liên hệ')
@section('main')
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Liên hệ</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__content">
                    @if (!empty($infos))
                    <div class="contact__address">
                        <h5>Contact info</h5>
                        @foreach ($infos as $info)
                        <ul>
                            <li>
                                <h6><i class="fa fa-map-marker"></i> Address</h6>
                                <p>
                                    <?php echo $info['address'] != null ? $info['address'] : 'Address'; ?>
                                </p>
                            </li>
                            <li>
                                <h6><i class="fa fa-phone"></i> Phone</h6>
                                <p><span>
                                        <?php echo $info['phoneNumber'] != null ? $info['phoneNumber'] : 'Phone number'; ?>
                                    </span></p>
                            </li>
                            <li>
                                <h6><i class="fa fa-headphones"></i> Support</h6>
                                <p>
                                    <?php echo $info['email'] != null ? $info['email'] : 'email'; ?>
                                </p>
                            </li>
                        </ul>
                        @endforeach
                    </div>
                    @else
                    <h2> LIÊN HỆ</h2>
                    @endif
                    <div class="contact__form">
                        <h5>THÔNG TIN LIÊN HỆ</h5>
                        <form onsubmit="SendMail(); reset(); return false">
                            <input type="text" id="fullname" placeholder="Họ tên">
                            <input type="text" id="email" placeholder="Email">
                            <input type="text" id="phone" placeholder="Số điện thoại">
                            <textarea id="message" id="message" placeholder="Message"></textarea>
                            <button type="submit" id="sendBtn" class="site-btn">Gửi</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact__map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.4436614509846!2d106.6256397147191!3d10.853821092269039!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752bee0b0ef9e5%3A0x5b4da59e47aa97a8!2zQ8O0bmcgVmnDqm4gUGjhuqduIE3hu4FtIFF1YW5nIFRydW5n!5e0!3m2!1svi!2s!4v1668934337096!5m2!1svi!2s"
                        width="780" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script>
    function SendMail() {
        var name = $("#fullname").val().trim();
        var email = $("#email").val().trim();
        var phone = $("#phone").val().trim();
        var message = $("#message").val().trim();
        if (name == '') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: 'Thiếu tên của bạn'
            })
        } else if (email == '') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: 'Thiếu email của bạn'
            })
        } else if (!email.match(/(.+)@(gmail+)\.(com)/i) && !email.match(/(.+)@(fpt.edu+)\.(vn)/i)) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: 'Email không đúng định dạng gmail hoặc edu'
            })
        } else if (phone == '') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: 'Thiếu số điện thoại của bạn'
            })
        } else if (!phone.match(/(0[3|5|7|8|9])+([0-9]{8})\b/g)) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: 'Số điện thoại không hợp lệ'
            })
        } else if (message == '') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: 'Thiếu lời nhắn của bạn'
            })
        } else {
            Email.send({
                Host: "smtp.elasticemail.com",
                Username: "trungthanh01233@gmail.com",
                Password: "B5FAF47DD785ACED6F617F8C176D02482D71",
                To: 'duanthuctapnhom6@gmail.com',
                From: 'trungthanh01233@gmail.com',
                Subject: "Yêu cầu từ trang khách hàng",
                Body: `<h3>Họ Tên: ` + name + `</h3>
                <h3>Số điện thoại: `+ phone + `</h3>
                <h3>Email: `+ email + `</h3>
                <h3>Thông tin liên hệ : `+ message + `</h3><br>`,
            }).then(() => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: 'Đã gửi thành công'
                })
            });
        }
    }
</script>
@endsection