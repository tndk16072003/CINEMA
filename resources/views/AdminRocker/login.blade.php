<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="/assets_admin_rocker/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="/assets_admin_rocker/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="/assets_admin_rocker/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="/assets_admin_rocker/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="/assets_admin_rocker/css/pace.min.css" rel="stylesheet" />
    <script src="/assets_admin_rocker/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="/assets_admin_rocker/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets_admin_rocker/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="/assets_admin_rocker/css/app.css" rel="stylesheet">
    <link href="/assets_admin_rocker/css/icons.css" rel="stylesheet">
    <title>Rocker - Bootstrap 5 Admin Dashboard Template</title>
</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                            <img src="/assets_admin_rocker/images/logo-img.png" width="180" alt="" />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Đăng Nhập</h3>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" action="/admin/login" method="post">
                                            @csrf
                                            <div class="col-12">
                                                <label class="form-label">Địa Chỉ Email</label>
                                                <input id="email" name="email" type="text" class="form-control"
                                                    placeholder="Nhập vào địa chỉ email">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Mật Khẩu</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input id="password" type="password" class="form-control border-end-0"
                                                        name="password" placeholder="Nhập vào mật khẩu"> <a
                                                        href="javascript:;" class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckChecked" checked>
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Ghi
                                                        Nhớ</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-end"> <a
                                                    href="authentication-forgot-password.html">Quên Mật Khẩu ?</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="bx bxs-lock-open"></i>Đăng Nhập</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="/assets_admin_rocker/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="/assets_admin_rocker/js/jquery.min.js"></script>
    <script src="/assets_admin_rocker/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="/assets_admin_rocker/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="/assets_admin_rocker/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
            $('button').on('click', function() {
                if($('#email').val() == '') {
                    $('button').attr('disabled', 'disabled');
                }
                if($('#password').val() == '') {
                    $('button').attr('disabled', 'disabled');
                }
            });
            $('input').on('keyup', function() {
                $('button').attr('disabled', false);
            });
        });
    </script>
    <!--app JS-->
    <script src="/assets_admin_rocker/js/app.js"></script>
</body>

</html>
