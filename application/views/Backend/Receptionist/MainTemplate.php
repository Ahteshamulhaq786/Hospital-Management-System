<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Receptionist | @provide(pagetitle)</title>

    <link href="<?= base_url('doctor_assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('doctor_assets/font-awesome/css/font-awesome.css') ?>" rel="stylesheet">

    @provide(stylelinks)


    <link href="<?= base_url('doctor_assets/css/animate.css') ?>" rel="stylesheet">
    <link href="<?= base_url('doctor_assets/css/style.css') ?>" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                                <img style="border-radius: 100px;width:64px;height: 64px;" alt="image" src="<?= $this->Admin_model->getreceptionistby_id($_SESSION['PROFILE_ID'])->icon; ?>" />
                            </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?= $this->Admin_model->getreceptionistby_id($_SESSION['PROFILE_ID'])->name; ?></strong>
                                    </span> <span class="text-muted text-xs block">Receptionist</span> </span> </a>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    <li class="@provide(dashboardselected)">
                        <a href="<?= base_url('index.php/receptionist/dashboard') ?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Appointment</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">

                            <li class="@provide(appointmentlistselected)">
                                <a href="<?= base_url('index.php/receptionist/appointment_list') ?>">Appointment List</a>
                            </li>

                            <li class="@provide(requestedappointmentsselected)">
                                <a href="<?= base_url('index.php/receptionist/requested_appointment') ?>">Requested Appointments</a>
                            </li>

                        </ul>
                    </li>
                    <li class="@provide(patientsselected)">
                        <a href="<?= base_url('index.php/receptionist/patients') ?>"><i class="fa fa-flask"></i> <span class="nav-label">Patients</span></a>
                    </li>
                    <li class="@provide(profileselected)">
                        <a href="<?= base_url('index.php/receptionist/profile') ?>"><i class="fa fa-table"></i> <span class="nav-label">Profile</span></a>
                    </li>
                </ul>

            </div>
        </nav>

        <!-- heading of page  -->

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Welcome to Clinic Automation System</span>
                        </li>
                        <li>
                            <a href="<?= site_url('index.php/logout'); ?>">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-8">
                    <h2>
                        @provide(pagetitle)
                    </h2>
                </div>
                
            </div>
            <div class="row">
                <div class="col-lg-12">
                
                    <div class="wrapper wrapper-content">
                    @provide(alert)
                        <div class="row">

                            <!-- Content  -->

                            @provide(content)




                            <!-- Content  -->



                        </div>
                    </div>
                    <div class="footer">
                        <div class="pull-right">
                            <strong>All Rights Reserved</strong>
                        </div>
                        <div>
                            <strong>Copyright</strong> &copy; Clinic Automation System 2021
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Mainly scripts -->

    <script src="<?= base_url('doctor_assets/js/jquery-3.1.1.min.js') ?>"></script>
    <script src="<?= base_url('doctor_assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('doctor_assets/js/plugins/metisMenu/jquery.metisMenu.js') ?>"></script>
    <script src="<?= base_url('doctor_assets/js/plugins/slimscroll/jquery.slimscroll.min.js') ?>"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?= base_url('doctor_assets/js/inspinia.js') ?>"></script>
    <script src="<?= base_url('doctor_assets/js/plugins/pace/pace.min.js') ?>"></script>

    <!-- jQuery UI -->
    <script src="<?= base_url('doctor_assets/js/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>

    @provide(scriptlinks)

</body>

</html>