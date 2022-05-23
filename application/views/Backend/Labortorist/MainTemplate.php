<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Lab | Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
    <link rel="stylesheet" href="<?= base_url('assets/offline-links/Lab/bootstrap.css'); ?>">
    <!-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"> -->
    <link rel="stylesheet" href="<?= base_url('assets/offline-links/Lab/css.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('lab_assets/css/ready.css') ?>">
    <link rel="stylesheet" href="<?= base_url('lab_assets/css/demo.css') ?>">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/sc-2.0.3/sp-1.2.2/datatables.min.css" /> -->
    <link rel="stylesheet" href="<?= base_url('assets/offline-links/Lab/datatables.min.css'); ?>">
    <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> -->
    <link rel="stylesheet" href="<?= base_url('assets/offline-links/Lab/all.css'); ?>">
	<style>
.footer {
   position: absolute;
   left: 0;
   bottom: 0;
   width: 100%;
}
</style>
    @provide(links)
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <div class="logo-header">
                <a href="index.html" class="logo">
                    Lab Dashboard
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
            </div>
            <nav class="navbar navbar-header navbar-expand-lg">
                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
					<li style="margin-right: 100px;">
                            <span class="m-r-sm text-muted welcome-message">Welcome to Clinic Automation System</span>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false"> <img
                                    src="<?= $this->Admin_model->getlabby_id($_SESSION['PROFILE_ID'])->icon; ?>"
                                    alt="user-img" width="30px"
                                    class="img-circle img-fluid"><span><?= $this->Admin_model->getlabby_id($_SESSION['PROFILE_ID'])->name; ?></span></span>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <div class="user-box">
                                        <div class="u-img"><img
                                                src="<?= $this->Admin_model->getlabby_id($_SESSION['PROFILE_ID'])->icon; ?>"
                                                alt="user"></div>
                                        <div class="u-text">
                                            <h4><?= $this->Admin_model->getlabby_id($_SESSION['PROFILE_ID'])->name; ?>
                                            </h4>
                                            <a href="<?= site_url('index.php/lab/profile'); ?>"
                                                class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                                        </div>
                                    </div>
                                </li>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= site_url('index.php/logout'); ?>"> <img src="<?= base_url('lab_assets/img/poff.png') ?>" style="width: 22px; height: 22px; margin-bottom: 6px" alt=""> Logout</a>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="sidebar">
            <div class="scrollbar-inner sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img class="img-fluid"
                            src="<?= $this->Admin_model->getlabby_id($_SESSION['PROFILE_ID'])->icon; ?>">
                    </div>
                    <div class="info">
                        <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                <?= $this->Admin_model->getlabby_id($_SESSION['PROFILE_ID'])->name; ?>
                                <span class="user-level">Laboratorist</span>
                            </span>
                        </a>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item @provide(dashboardselected)">
                        <a href="<?= base_url('index.php/lab/dashboard'); ?>">
                            <i class="la la-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item @provide(pathologyselected)">
                        <a href="<?= base_url('index.php/lab/pathology_report'); ?>">
                            <i class="la la-fonticons"></i>
                            <p>Report</p>
                        </a>
                    </li>

                    <li class="nav-item @provide(bloodbankselected)">
                        <a href="<?= base_url('index.php/lab/blood_bank'); ?>">
                            <i class="la la-bank"></i>
                            <p>Blood Bank</p>
                        </a>
                    </li>
                    <li class="nav-item @provide(blooddonorselected)">
                        <a href="<?= base_url('index.php/lab/blood_donor'); ?>">
                            <i class="la la-font"></i>
                            <p>Blood Donor</p>
                        </a>
                    </li>

                    <li class="nav-item @provide(profileselected)">
                        <a href="<?= base_url('index.php/lab/profile'); ?>">
                            <i class="la la-book"></i>
                            <p>Profile</p>
                        </a>
                    </li>

                </ul>
            </div>
        </div>


        <div class="main-panel">
            <div class="content">
                @provide(alert)
                @provide(content)
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                    </nav>
                    <div class="copyright ml-auto">
                        Copy right @ 2021 all right reserved <i class="la la-heart heart text-danger"></i>
                        <font color="green">Clinic Automation System</font>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
<script src=<?= base_url('lab_assets/js/core/jquery.3.2.1.min.js') ?>></script>
<script src="<?= base_url('lab_assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') ?>"></script>
<script src="<?= base_url('lab_assets/js/core/popper.min.js') ?>"></script>
<script src="<?= base_url('lab_assets/js/core/bootstrap.min.js') ?>"></script>
<!-- <script src="<?= base_url('lab_assets/js/ready.min.js') ?>"></script> -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script> -->
<!-- <script src="<?= base_url('assets/offline-links/Lab/pdfmake.min.js.js') ?>"></script> -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> -->
<script src="<?= base_url('assets/offline-links/Lab/vfs_fonts.js') ?>"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/sc-2.0.3/sp-1.2.2/datatables.min.js"></script> -->
<script src="<?= base_url('assets/offline-links/Lab/datatables.min.js') ?>"></script>
<script src="<?= base_url('lab_assets/js/plugin/chartist/chartist.min.js') ?>"></script>
<script src="<?= base_url('lab_assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js') ?>"></script>
<!-- <script src="<?= base_url('lab_assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') ?>"></script> -->
<script src="<?= base_url('lab_assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') ?>"></script>
<script src="<?= base_url('lab_assets/js/plugin/jquery-mapael/jquery.mapael.min.js') ?>"></script>
<script src="<?= base_url('lab_assets/js/plugin/jquery-mapael/maps/world_countries.min.js') ?>"></script>
<script src="<?= base_url('lab_assets/js/plugin/chart-circle/circles.min.js') ?>"></script>
<script src="<?= base_url('lab_assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') ?>"></script>
<!-- <script src="<?= base_url('lab_assets/js/demo.js') ?>"></script> -->
@provide(scripts)

</html>