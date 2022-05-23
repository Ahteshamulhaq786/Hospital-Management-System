<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Nurse | @provide(title)</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css"> -->
    <link rel="stylesheet" href="<?= base_url('pharmacist_assets/vendors/mdi/css/materialdesignicons.min.css') ?>">
    <!-- <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css"> -->
    <link rel="stylesheet" href="<?= base_url('pharmacist_assets/vendors/css/vendor.bundle.base.css') ?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css"> -->
    <link rel="stylesheet" href="<?= base_url('pharmacist_assets/vendors/flag-icon-css/css/flag-icon.min.css') ?>">
    <!-- <link rel="stylesheet" href="../assets/vendors/jvectormap/jquery-jvectormap.css"> -->
    <link rel="stylesheet" href="<?= base_url('pharmacist_assets/vendors/jvectormap/jquery-jvectormap.css') ?>">
    <!-- End plugin css for this page -->
    <!-- Layout styles -->
    <!-- <link rel="stylesheet" href="../assets/css/demo/style.css"> -->
    <link rel="stylesheet" href="<?= base_url('pharmacist_assets/css/demo/style.css') ?>">
    <!-- End layout styles -->
    <!-- <link rel="shortcut icon" href="../assets/images/favicon.png" /> -->
    <link rel="shortcut icon" href="<?= base_url('pharmacist_assets/images/favicon.png') ?>" />
    <link href="<?= base_url('doctor_assets/css/animate.css') ?>" rel="stylesheet">
    <link href="<?= base_url('doctor_assets/css/style.css') ?>" rel="stylesheet">
    @provide(stylelinks)

</head>

<body>
    <!-- <script src="../assets/js/preloader.js"></script> -->
    <script src="<?= base_url('pharmacist_assets/js/preloader.js') ?>"></script>
    <div class="body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
            <div class="mdc-drawer__header">
                <img style="border-radius: 100px;width:64px;height: 64px; margin-top:35px"
                    src="<?= $this->Admin_model->getnurseby_id($_SESSION['PROFILE_ID'])->icon; ?>" alt="">
                <h4 style="margin: 10px 0 0 8px;">
                    <font color="white"><?= $this->Admin_model->getnurseby_id($_SESSION['PROFILE_ID'])->name; ?>
                    </font>
                </h4>

            </div><br>
            <div class="mdc-drawer__content">
                <div class="user-info">
                    <!-- <p class="name">Clyde Miles</p>
                    <p class="email">clydemiles@elenor.us</p> -->
                </div>
                <div class="mdc-list-group">
                    <nav class="mdc-list mdc-drawer-menu">

                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="<?= base_url('index.php/Nurse/dashboard') ?>">
                                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                                    aria-hidden="true">home</i>
                                Dashboard
                            </a>
                        </div>
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="<?= base_url('index.php/Nurse/assigned_patients') ?>">
                                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                                    aria-hidden="true">track_changes</i>
                                Assigned Patients
                            </a>
                        </div>

                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="<?= base_url('index.php/Nurse/allpatients') ?>">
                                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                                    aria-hidden="true">track_changes</i>
                                Patients
                            </a>
                        </div>

                        <div class="mdc-list-item mdc-drawer-item ">
                            <a class="mdc-expansion-panel-link" data-toggle="expansionPanel" data-target="ui-sub-menu">
                                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                                    aria-hidden="true">dashboard</i>
                                Bedrooms / Ward
                                <i class="mdc-drawer-arrow material-icons">chevron_right</i>
                            </a>
                            <div class="mdc-expansion-panel" id="ui-sub-menu">
                                <nav class="mdc-list mdc-drawer-submenu">
                                    <div class="mdc-list-item mdc-drawer-item">
                                        <a class="mdc-drawer-link"
                                            href="<?= base_url('index.php/Nurse/bedallotment') ?>">
                                            Bed Allotment
                                        </a>
                                    </div>
                                </nav>
                            </div>

                        </div>
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-expansion-panel-link" data-toggle="expansionPanel"
                                data-target="sample-page-submenu">
                                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                                    aria-hidden="true">pages</i>
                                Blood Bank
                                <i class="mdc-drawer-arrow material-icons">chevron_right</i>
                            </a>
                            <div class="mdc-expansion-panel" id="sample-page-submenu">
                                <nav class="mdc-list mdc-drawer-submenu">
                                    <div class="mdc-list-item mdc-drawer-item">
                                        <a class="mdc-drawer-link"
                                            href="<?= base_url('index.php/Nurse/managebloodbank') ?>">
                                            Blood Bank Status
                                        </a>
                                    </div>
                                    <div class="mdc-list-item mdc-drawer-item">
                                        <a class="mdc-drawer-link" href="<?= base_url('index.php/Nurse/blooddonor') ?>">
                                            Blood Donor
                                        </a>
                                    </div>
                                </nav>
                            </div>
                        </div>
                        <!-- <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="<?= base_url('index.php/Nurse/report') ?>">
                                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                                    aria-hidden="true">track_changes</i>
                                Report
                            </a>
                        </div> -->
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="<?= base_url('index.php/nurse/profile') ?>">
                                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                                    aria-hidden="true">pie_chart_outlined</i>
                                Profiles
                            </a>
                        </div>
                    </nav>
                </div>
                <div class="profile-actions">
                    <a href="javascript:;">Settings</a>
                    <span class="divider"></span>
                    <a href="<?= site_url('index.php/logout'); ?>">Logout</a>
                </div>

            </div>
        </aside>
        <!-- partial -->
        <div class="main-wrapper mdc-drawer-app-content">
            <!-- partial:partials/_navbar.html -->
            <header class="mdc-top-app-bar">
                <div class="mdc-top-app-bar__row">
                    <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
                        <button
                            class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button sidebar-toggler">menu</button>
                        <span style="margin-left: 100px;">Welcome To Clinic Automation System</span>
                        <!-- <div
                            class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon search-text-field d-none d-md-flex">
                            <i class="material-icons mdc-text-field__icon">search</i>
                            <input class="mdc-text-field__input" id="text-field-hero-input">
                            <div class="mdc-notched-outline">
                                <div class="mdc-notched-outline__leading"></div>
                                <div class="mdc-notched-outline__notch">
                                    <label for="text-field-hero-input" class="mdc-floating-label"></label>
                                    <h4>@provide(title)</h4>
                                </div>
                                <div class="mdc-notched-outline__trailing"></div>
                            </div>
                        </div> -->
                    </div>
                    <div
                        class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end mdc-top-app-bar__section-right">
                        <div class="menu-button-container menu-profile d-none d-md-block">
                            <button class="mdc-button mdc-menu-button">
                                <span class="d-flex align-items-center">
                                    <span class="figure">
                                        <img src="<?= $this->Admin_model->getnurseby_id($_SESSION['PROFILE_ID'])->icon; ?>"
                                            alt="user" class="user" />
                                    </span>
                                    <span
                                        class="user-name"><?= $this->Admin_model->getnurseby_id($_SESSION['PROFILE_ID'])->name; ?></span>
                                </span>
                            </button>
                            <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                                    <li class="mdc-list-item" role="menuitem">
                                        <div class="item-thumbnail item-thumbnail-icon-only">
                                            <i class="mdi mdi-account-edit-outline text-primary"></i>
                                        </div>
                                        <div
                                            class="item-content d-flex align-items-start flex-column justify-content-center">
                                            <a style="text-decoration: none;"
                                                href="<?= base_url('index.php/nurse/profile') ?>">
                                                <h6 class="item-subject font-weight-normal">Profile</h6>
                                            </a>

                                        </div>
                                    </li>
                                    <a style="text-decoration: none;" href="<?= site_url('index.php/logout'); ?>">
                                        <li class="mdc-list-item" role="menuitem">
                                            <div class="item-thumbnail item-thumbnail-icon-only">
                                                <i class="mdi mdi-settings-outline text-primary"></i>
                                            </div>
                                            <div
                                                class="item-content d-flex align-items-start flex-column justify-content-center">
                                                <h6 class="item-subject font-weight-normal">Logout</h6>
                                            </div>
                                        </li>
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- partial -->
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-8">
                    <h4 style="margin: 25px;">
                        @provide(title)
                    </h4>
                </div>
            </div>
            <div class="page-wrapper mdc-toolbar-fixed-adjust"><br>
                @provide(alert)
                <main class="content-wrapper">
                    <div class="mdc-layout-grid">
                        <div class="mdc-layout-grid__inner">
                            @provide(widgets)

                            <div class=" mdc-layout-grid__cell--span-12">
                                @provide(content)
                            </div>

                        </div>
                    </div>
                </main>
                <!-- partial:partials/_footer.html -->
                <footer style="background-color: #3b0470; opacity: 70%; color:seashell;">
                    <div class="mdc-layout-grid">
                        <div class="mdc-layout-grid__inner">
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                <span class="text-center text-sm-left d-block d-sm-inline-block tx-14">Copyright ©
                                    2021 all right reserved</span>
                            </div>
                            <div
                                class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop d-flex justify-content-end">
                                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center tx-14">CLINIC
                                    AUTOMATION SYSTEM</span>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- partial -->
            </div>
        </div>
    </div>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <!-- plugins:js -->
    <!-- <script src="../assets/vendors/js/vendor.bundle.base.js"></script> -->
    <script src="<?= base_url('pharmacist_assets/vendors/js/vendor.bundle.base.js') ?>"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- <script src="../assets/vendors/chartjs/Chart.min.js"></script> -->
    <script src="<?= base_url('pharmacist_assets/vendors/chartjs/Chart.min.js') ?>"></script>
    <!-- <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script> -->
    <script src="<?= base_url('pharmacist_assets/vendors/jvectormap/jquery-jvectormap.min.js') ?>"></script>
    <!-- <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
    <script src="<?= base_url('pharmacist_assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') ?>"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <!-- <script src="../assets/js/material.js"></script> -->
    <script src="<?= base_url('pharmacist_assets/js/material.js') ?>"></script>
    <!-- <script src="../assets/js/misc.js"></script> -->
    <script src="<?= base_url('pharmacist_assets/js/misc.js') ?>"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- <script src="../assets/js/dashboard.js"></script> -->
    <script src="<?= base_url('pharmacist_assets/js/dashboard.js') ?>"></script>
    <!-- End custom js for this page-->
    @provide(scriptlinks)
</body>

</html>