
<!doctype html>

<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        Login | Bayanno Hospital Management System    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="https://creativeitem.com/demo/bayanno/uploads/favicon.png">
    <link rel="stylesheet" href="https://creativeitem.com/demo/bayanno/assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://creativeitem.com/demo/bayanno/assets/login_page/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://creativeitem.com/demo/bayanno/assets/login_page/css/normalize.css">
    <link rel="stylesheet" href="https://creativeitem.com/demo/bayanno/assets/login_page/css/main.css">
    <link rel="stylesheet" href="https://creativeitem.com/demo/bayanno/assets/login_page/css/style.css">
    <link rel="stylesheet"
          href="https://creativeitem.com/demo/bayanno/assets/common/izitoast/css/iziToast.min.css" type="text/css">
    <script src="https://creativeitem.com/demo/bayanno/assets/login_page/js/vendor/modernizr-2.8.3.min.js"></script>
<!--    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600" rel="stylesheet">
</head>
<body>
<div class="main-content-wrapper">
    <div class="login-area">
        <div class="login-header">
            <a href="https://creativeitem.com/demo/bayanno/index.php/login" class="logo">
                <img src="https://creativeitem.com/demo/bayanno/uploads/logo.png" height="60" alt="">
            </a>
            <h2 class="title">Bayanno Hospital Management System</h2>
        </div>
        <div class="login-content">
            <form method="post" role="form" id="form_login"
                  action="https://creativeitem.com/demo/bayanno/index.php/login/do_login">
                <div class="form-group">
                    <input type="email" class="input-field" name="email" placeholder="Email"
                           required autocomplete="off" id = "email">
                </div>
                <div class="form-group">
                    <input type="password" class="input-field" name="password" placeholder="Password"
                           required autocomplete="off" id = "password">
                </div>
                <button type="submit" class="btn btn-primary">Login<i class="fa fa-lock"></i></button>
            </form>

            <div class="login-bottom-links">
                <a href="https://creativeitem.com/demo/bayanno/index.php/login/forgot_password" class="link">
                    Forgot Your Password ?
                </a>
            </div>
            <br/>
            <!--demo login buttons-->
                <button type="button" class="btn btn-default" id="admin"
                    onclick="demo_login(this.id)">
                    Admin                </button>
                <button type="button" class="btn btn-default" id="doctor"
                        onclick="demo_login(this.id)">
                    Doctor                </button>
                <button type="button" class="btn btn-default" id="patient"
                        onclick="demo_login(this.id)">
                    Patient                </button>
                <button type="button" class="btn btn-default" id="nurse"
                        onclick="demo_login(this.id)">
                    Nurse                </button>
                <br><br>
                <button type="button" class="btn btn-default" id="receptionist"
                        onclick="demo_login(this.id)">
                    Receptionist                </button>
                <button type="button" class="btn btn-default" id="laboratorist"
                        onclick="demo_login(this.id)">
                    Laboratorist                </button>
                <button type="button" class="btn btn-default" id="pharmacist"
                        onclick="demo_login(this.id)">
                    Pharmacist                </button>
                <br><br>
                <button type="button" class="btn btn-default" id="accountant"
                        onclick="demo_login(this.id)">
                    Accountant                </button>
                <!--demo login buttons-->
        </div>
    </div>
    <div class="image-area"></div>
</div>

<script src="https://creativeitem.com/demo/bayanno/assets/login_page/js/vendor/jquery-1.12.0.min.js"></script>
<script src="https://creativeitem.com/demo/bayanno/assets/common/izitoast/js/iziToast.min.js"></script>




<script>
    function demo_login(id) {
        var email = id + '@example.com';
        var password = '1234';
        $('#email').val(email);
        $('#password').val(password);
    }
</script>
</body>
</html>
<script type="text/javascript" src="http://creativeitem.com/demo/buy/buy_bayanno.js"></script>