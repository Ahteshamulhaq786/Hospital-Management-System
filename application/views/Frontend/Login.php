<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        Login | Clinic Automation Sysem </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?=base_url('assets/frontend/images/Mylogo2.PNG'); ?>">
    <link rel="stylesheet" href="<?=base_url('assets/offline-links/login/bootstrap.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/offline-links/login/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/offline-links/login/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/offline-links/login/normalize.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/offline-links/login/main.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/offline-links/login/style.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/offline-links/login/iziToast.min.css')?>" type="text/css">
    <script src="<?=base_url('assets/offline-links/login/modernizr-2.8.3.min.js')?>"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
<div class="main-content-wrapper">
    <div class="login-area" style="background: white;">
        <?php if($this->session->has_userdata('failure')): ?>
        <div class="alert alert-danger alert-dismissible m-3">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= $this->session->flashdata('failure');?>
        </div>
    <?php endif;
        unset($_SESSION['failure']);
     ?>
        <div class="login-header">
            <a href="<?=base_url('index.php/Home/login')?>" class="logo">
                <img src="<?=base_url('assets/frontend/images/Mylogo2.PNG'); ?>" height="60" alt="">
            </a>
            <br><br>
            <h4 class="title text-dark" style="color:black;">Clinic Automation Sysem</h4>
        </div>
        <div class="login-content">
            <form method="post" action="<?=site_url('index.php/admin/validate');?>" role="form" id="form_login">
                <div class="form-group">
                    <?php 
                    if(isset($_POST['email']))
                        $email=$_POST['email'];
                    else if(isset($_GET['email']))
                        $email=$this->Admin_model->decryption($_GET['email']);
                    else
                        $email='';
                    ?>
                    <input type="email" value="<?= $email; ?>" class="input-field" name="email" placeholder="Email"
                           required autocomplete="off" id = "email">
                           <div class="invalid-feedback text-danger text-left font-weight-lighter d-block">
                               <?= form_error('email');?>
                           </div>
                </div>
                <div class="form-group">
                    <input type="password" class="input-field" name="password" placeholder="Password"
                           required autocomplete="off" id = "password">
                           <div class="invalid-feedback text-danger text-left font-weight-lighter d-block"><?= form_error('password');?></div>
                </div><br>
                <button type="submit" class="btn btn-primary" style="background-color: #004485;">Login<i class="fa fa-lock"></i></button>

                <h6><b>Don't</b> have an account? <a href="<?= base_url('index.php/home/register_patient') ?>" target="_blank">Sign Up</a></h6>

            </form>

            <br/>

        </div>
    </div>
    <div class="image-area"></div>
</div>

<!-- jQuery library -->
<script src="<?=base_url('assets/offline-links/login/jquery.min.js')?>"></script>

<!-- Popper JS -->
<script src="<?=base_url('assets/offline-links/login/popper.min.js')?>"></script>

<!-- Latest compiled JavaScript -->
<script src="<?=base_url('assets/offline-links/login/bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/offline-links/login/iziToast.min.js')?>"></script>
</body>
</html>
