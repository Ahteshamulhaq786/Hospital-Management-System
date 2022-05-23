<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Doctor | Dashboard</title>
    <link href="<?= base_url('doctor_assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('doctor_assets/font-awesome/css/font-awesome.css') ?>" rel="stylesheet">
    @provide(stylelinks)
    <link href="<?= base_url('doctor_assets/css/animate.css') ?>" rel="stylesheet">
    <link href="<?= base_url('doctor_assets/css/style.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('doctor_assets/rating/jquery.rateyo.css'); ?>">
</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                                <img alt="Doctor Image" style="border-radius: 100px;width:64px;height: 64px;" src="<?= $this->Admin_model->getdoctorby_id($_SESSION['PROFILE_ID'])->icon; ?>" />
                            </span>
                            <a href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?= $this->Admin_model->getdoctorby_id($_SESSION['PROFILE_ID'])->name; ?></strong>
                                    </span>
                                    <span id="rateYoPPP" style="padding: 0px;">

                                    </span>
                                    <span class="text-muted text-xs block">Doctor</span> </span>

                            </a>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    <li class="@provide(dashboardselected)">
                        <a href="<?= base_url('index.php/doctor/dashboard') ?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                    </li>
                    <li>
                    
                    <li class="@provide(appointmentlistselected)">
                        <a href="<?= base_url('index.php/doctor/appointment_list') ?>"><i class="fa fa-pie-chart"></i><span class="nav-label">Appointment List</span></a>
                    </li>

                    <li class="@provide(requestedappointmentsselected)" style="white-space: nowrap">
                        <a href="<?= base_url('index.php/doctor/requested_appointment') ?>"><i class="fa fa-grav"></i><span class="nav-label">Requested Appointments</span> </a>
                    </li>
                    </li>
                    <li class="@provide(prescriptionselected)">
                        <a href="<?= base_url('index.php/doctor/prescription') ?>"><i class="fa fa-pie-chart"></i> <span class="nav-label">Prescription</span> </a>
                    </li>
                    <li class="@provide(patientsselected)">
                        <a href="<?= base_url('index.php/doctor/patients') ?>"><i class="fa fa-flask"></i> <span class="nav-label">Patients</span></a>
                    </li>

                    <li class="@provide(bedallotmentselected)">
                        <a href="<?= base_url('index.php/doctor/bed_allotment') ?>"><i class="fa fa-edit"></i> <span class="nav-label">Bed Allotment</span></a>
                    </li>

                    <li class="@provide(bloodbankselected)">
                        <a href="<?= base_url('index.php/doctor/bloodbank') ?>"><i class="fa fa-files-o"></i> <span class="nav-label">Blood Bank</span></a>
                    </li>
                    <li class="@provide(reportselected)">
                        <a href="<?= base_url('index.php/doctor/report') ?>"><i class="fa fa-globe"></i> <span class="nav-label">Report</span><span class="label label-info pull-right">NEW</span></a>
                    </li>
                    <li class="@provide(assignnurseselected)">
                        <a href="<?= base_url('index.php/doctor/assign_nurses_list') ?>"><i class="fa fa-plus"></i> <span class="nav-label">Assign Nurses</span></a>
                    </li>
                    <li class="@provide(messageselected)">
                        <a href="<?= base_url('index.php/doctor/message') ?>"><i class="fa fa-laptop"></i> <span class="nav-label">Message</span></a>
                    </li>
                    <li class="@provide(profileselected)">
                        <a href="<?= base_url('index.php/doctor/profile') ?>"><i class="fa fa-table"></i> <span class="nav-label">Profile</span></a>
                    </li>

                    <li class="@provide(reviewratingselected)">
                        <a href="<?= base_url('index.php/doctor/reviewrating') ?>"><i class="fa fa-star-half-full"></i> <span class="nav-label">Review & Reting</span></a>
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
                            <strong>Copyright</strong> Clinic Automation System &copy; 2021
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

    <script src="<?= base_url('doctor_assets/rating/jquery.rateyo.js'); ?>"></script>

    @provide(scriptlinks)

    <script>
        $(function() {
            $.ajax({
                url: '<?= site_url('index.php/doctor/fetch_avg_rating'); ?>',
                type: "POST",
                data: {
                    did: <?= $_SESSION['PROFILE_ID'] ?>,
                },
                success: function(data) {
                    $("#rateYoPPP").rateYo({
                        rating: data,
                        starWidth: "40px",
                        precision: 2,
                        readOnly: true,
                        starWidth: "15px",
                        spacing: "4px"
                    });
                }
            });
        });
    </script>
</body>

</html>