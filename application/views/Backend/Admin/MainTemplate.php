<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('admin_assets/plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    @provide(links)
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('admin_assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('admin_assets/plugins/jqvmap/jqvmap.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('admin_assets/dist/css/adminlte.min.css'); ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('admin_assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('admin_assets/plugins/daterangepicker/daterangepicker.css'); ?>">
    <!-- summernote -->
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('admin_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('admin_assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('admin_assets/plugins/summernote/summernote-bs4.css'); ?>">
    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->

    <link rel="stylesheet" href="<?= base_url('assets/offline-links/Admin/css.css'); ?>">

    <!-- My Custom Css -->
    <link rel="stylesheet" href="<?= base_url('admin_assets/dist/css/custom.css'); ?>">
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url('index.php/admin/logout'); ?>" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" onclick="window.print();">
                    <a class="nav-link" title="Print Me!" data-toggle="tooltip" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fa fa-print" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= $this->Admin_model->get_system_settings()->image_path; ?>" class="brand-link">
                <img src="<?= $this->Admin_model->get_system_settings()->image_path; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Clinic Auto System</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="<?= base_url('index.php/Admin/account'); ?>" class="d-block"><?= $this->Admin_model->get_admin_profile()->name; ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="<?= base_url('index.php/Admin/dashboard'); ?>" class="nav-link 
                            <?php if (current_url() == base_url('Admin/dashboard')) {
                                echo "active";
                            } else {
                                echo "";
                            } ?>                       
                            ">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('index.php/Admin/departments'); ?>" class="nav-link 
                            <?php if (current_url() == base_url('Admin/departments')) {
                                echo "active";
                            } else {
                                echo "";
                            } ?>                       
                            ">
                                <i class="nav-icon fa fa-sitemap"></i>
                                <p>
                                    Departments
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('index.php/Admin/doctors'); ?>" class="nav-link 
                            <?php if (current_url() == base_url('Admin/doctors')) {
                                echo "active";
                            } else {
                                echo "";
                            } ?>                       
                            ">
                                <i class="nav-icon fa fa-user-md"></i>
                                <p>
                                    Doctors
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('index.php/Admin/patients'); ?>" class="nav-link 
                            <?php if (current_url() == base_url('Admin/patients')) {
                                echo "active";
                            } else {
                                echo "";
                            } ?>                       
                            ">
                                <i class="nav-icon fa fa-user"></i>
                                <p>
                                    Patients
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('index.php/Admin/nurses'); ?>" class="nav-link 
                            <?php if (current_url() == base_url('Admin/nurses')) {
                                echo "active";
                            } else {
                                echo "";
                            } ?>                       
                            ">
                                <i class="nav-icon fas fa-user-nurse"></i>
                                <p>
                                    Nurses
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('index.php/Admin/pharmacists'); ?>" class="nav-link 
                            <?php if (current_url() == base_url('Admin/pharmacists')) {
                                echo "active";
                            } else {
                                echo "";
                            } ?>                       
                            ">
                                <i class="nav-icon ion ion-person-add"></i>
                                <p>
                                    Pharmacists
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('index.php/Admin/laboratorists'); ?>" class="nav-link 
                            <?php if (current_url() == base_url('Admin/laboratorists')) {
                                echo "active";
                            } else {
                                echo "";
                            } ?>                       
                            ">
                                <i class="nav-icon fa fa-flask"></i>
                                <p>
                                    Laboratorists
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('index.php/Admin/receptionists'); ?>" class="nav-link 
                            <?php if (current_url() == base_url('Admin/receptionists')) {
                                echo "active";
                            } else {
                                echo "";
                            } ?>                       
                            ">
                                <i class="nav-icon fa fa-plus-square"></i>
                                <p>
                                    Receptionist
                                </p>
                            </a>
                        </li>
                        <!-- // charts  -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Monitor Hospital
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                <li class="nav-item">
                                    <a href="<?= base_url('index.php/Admin/bedallotment'); ?>" class="nav-link 
                            <?php if (current_url() == base_url('Admin/bedallotment')) {
                                echo "active";
                            } else {
                                echo "";
                            } ?>                       
                            ">
                                        <i class="nav-icon fas fa-arrow-circle-right"></i>
                                        <p>Bed Allotment</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('index.php/Admin/bloodbank'); ?>" class="nav-link 
                            <?php if (current_url() == base_url('Admin/bloodbank')) {
                                echo "active";
                            } else {
                                echo "";
                            } ?>                       
                            ">
                                        <i class="nav-icon fas fa-burn"></i>
                                        <p>Blood Bank</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('index.php/Admin/blooddonor'); ?>" class="nav-link 
                            <?php if (current_url() == base_url('Admin/blooddonor')) {
                                echo "active";
                            } else {
                                echo "";
                            } ?>                       
                            ">
                                        <i class="nav-icon fas fa-burn"></i>
                                        <p>Blood Donor</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('index.php/Admin/medicines'); ?>" class="nav-link 
                            <?php if (current_url() == base_url('Admin/medicines')) {
                                echo "active";
                            } else {
                                echo "";
                            } ?>                       
                            ">
                                        <i class="nav-icon fas fa-pills"></i>
                                        <p>Medicines</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('index.php/Admin/operationreport'); ?>" class="nav-link 
                            <?php if (current_url() == base_url('Admin/operationreport')) {
                                echo "active";
                            } else {
                                echo "";
                            } ?>                       
                            ">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>Operation Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('index.php/Admin/birthreport'); ?>" class="nav-link 
                            <?php if (current_url() == base_url('Admin/birthreport')) {
                                echo "active";
                            } else {
                                echo "";
                            } ?>                       
                            ">
                                        <i class="nav-icon fas fa-baby"></i>
                                        <p>Birth Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('index.php/Admin/deathreport'); ?>" class="nav-link 
                            <?php if (current_url() == base_url('Admin/deathreport')) {
                                echo "active";
                            } else {
                                echo "";
                            } ?>                       
                            ">
                                        <i class="nav-icon fas fa-procedures"></i>
                                        <p>Death Report</p>
                                    </a>
                                </li>
                            </ul>

                        <li class="nav-item">
                            <a href="<?= base_url('index.php/Admin/noticeboard'); ?>" class="nav-link 
                            <?php if (current_url() == base_url('Admin/noticeboard')) {
                                echo "active";
                            } else {
                                echo "";
                            } ?>                       
                            ">
                                <i class="nav-icon fas fa-exclamation-triangle"></i>
                                <p>
                                    Noticeboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('index.php/Admin/account'); ?>" class="nav-link 
                            <?php if (current_url() == base_url('Admin/account')) {
                                echo "active";
                            } else {
                                echo "";
                            } ?>                       
                            ">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Account
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('index.php/Admin/system_settings'); ?>" class="nav-link 
                            <?php if (current_url() == base_url('Admin/system_settings')) {
                                echo "active";
                            } else {
                                echo "";
                            } ?>                       
                            ">
                                <i class="nav-icon fas fa-wrench"></i>
                                <p>
                                    System Settings
                                </p>
                            </a>
                        </li>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 pl-2 text-dark">@provide(title)</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                <li class="breadcrumb-item active">@provide(title)</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid p-3">

                    @provide(content)

                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2021 </strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Clinic Automation System</b>
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <!-- jQuery -->
    <script src="<?= base_url('admin_assets/plugins/jquery/jquery.min.js'); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('admin_assets/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- ChartJS -->
    <script src="<?= base_url('admin_assets/plugins/chart.js/Chart.min.js'); ?>"></script>
    <!-- Sparkline -->
    <script src="<?= base_url('admin_assets/plugins/sparklines/sparkline.js'); ?>"></script>
    <!-- JQVMap -->
    <script src="<?= base_url('admin_assets/plugins/jqvmap/jquery.vmap.min.js'); ?>"></script>
    <script src="<?= base_url('admin_assets/plugins/jqvmap/maps/jquery.vmap.usa.js'); ?>"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url('admin_assets/plugins/jquery-knob/jquery.knob.min.js'); ?>"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url('admin_assets/plugins/moment/moment.min.js'); ?>"></script>
    <script src="<?= base_url('admin_assets/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('admin_assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
    <!-- Summernote -->
    <script src="<?= base_url('admin_assets/plugins/summernote/summernote-bs4.min.js'); ?>"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url('admin_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('admin_assets/dist/js/adminlte.js'); ?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?= base_url('admin_assets/dist/js/pages/dashboard.js'); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url('admin_assets/dist/js/demo.js'); ?>"></script>
    @provide(scripts)
    <!-- DataTables -->
    <script src="<?= base_url('admin_assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('admin_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
    <script src="<?= base_url('admin_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('admin_assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('admin_assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('admin_assets/plugins/jszip/jszip.min.js') ?>"></script>
    <script src="<?= base_url('admin_assets/plugins/pdfmake/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('admin_assets/plugins/pdfmake/vfs_fonts.js') ?>"></script>
    <script src="<?= base_url('admin_assets/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('admin_assets/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
    <script src="<?= base_url('admin_assets/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>
    <!-- page script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <!--     <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script> -->
</body>

</html>