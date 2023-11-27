

<!doctype html>
<html lang="es" dir="ltr">

<head>

    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Login - HB Group">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/hb_group.png') }}">

    <title>Login - HB Group</title>

    <link id="style" href="{{ asset('template/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('template/switcher/css/switcher.css') }}" rel="stylesheet">
    <link href="{{ asset('template/switcher/demo.css') }}" rel="stylesheet">

</head>

<body class="app sidebar-mini ltr login-img">

    <div class="">

        <div id="global-loader">
            <img src="{{ asset('template/images/loader.svg') }}"" class="loader-img" alt="Loader">
        </div>
        <div class="page">
            <div class="">
                <div class="col col-login mx-auto mt-7">
                    <div class="text-center">
                        {{-- <a href="index.html"><img src="{{ asset('images/logo/hb_group.png') }}" class="header-brand-img" alt=""></a> --}}
                    </div>
                </div>

                <div class="container-login100">

                    <div class="wrap-login100 p-6">

                        <form method="POST" class="login100-form validate-form">
                            @csrf

                            <span class="login100-form-title pb-5">
                                <a href="index.html" class="text-center"><img src="{{ asset('images/logo/hb_group.png') }}" class="header-brand-img" alt="" style="width: 67px;"></a><br>
                                Login

                            </span>

                            <div class="panel panel-primary">
                                <div class="tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs">
                                            <li class="mx-0"><a href="#tab5" class="active" data-bs-toggle="tab">Email</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body p-0 pt-5">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab5">
                                            @if (session('status'))
                                                {{ session('status') }}
                                            @endif
                                            <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input class="input100 border-start-0 form-control ms-0" type="text" placeholder="Email" name="email" required>
                                            </div>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input class="input100 border-start-0 form-control ms-0" type="password" placeholder="Password" name="password" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="custom-control custom-checkbox mb-0">
                                                    <input type="checkbox" class="custom-control-input" name="remember" id="remember">
                                                    <span class="custom-control-label">Recordar Contraseña</span>
                                                </label>
                                            </div>
                                            {{-- <div class="text-end pt-4">

                                                <p class="mb-0">
                                                    <a href="forgot-password.html" class="text-primary ms-1">Forgot Password?</a>

                                                </p>
                                            </div> --}}
                                            <div class="container-login100-form-btn">
                                                <button type="submit" class="login100-form-btn btn-primary">
                                                        Ingresar
                                                </button>
                                            </div>
                                            <div class="text-center pt-3">
                                                <p class="text-dark mb-0">Not a member?<a href="register.html" class="text-primary ms-1">Sign UP</a></p>
                                            </div>
                                            <label class="login-social-icon"><span>Login with Social</span></label>
                                            <div class="d-flex justify-content-center">
                                                <a href="javascript:void(0)">
                                                    <div class="social-login me-4 text-center">
                                                        <i class="fa fa-google"></i>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <div class="social-login me-4 text-center">
                                                        <i class="fa fa-facebook"></i>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <div class="social-login text-center">
                                                        <i class="fa fa-twitter"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('template/js/jquery.min.js') }}"></script>
    <script src="{{ asset('template/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/js/show-password.min.js') }}"></script>
    <script src="{{ asset('template/js/generate-otp.js') }}"></script>
    <script src="{{ asset('template/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('template/js/themeColors.js') }}"></script>
    <script src="{{ asset('template/js/custom.js') }}"></script>
    <script src="{{ asset('template/js/custom-swicher.js') }}"></script>
    <script src="{{ asset('template/switcher/js/switcher.js') }}"></script>

</body>

</html>
