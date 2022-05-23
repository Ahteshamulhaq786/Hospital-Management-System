@extends(Backend/Admin/MainTemplate)
@section(title)Dashboard@endsection
@section(links)
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url('admin_assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
@endsection
@section(content)
<?php if ($this->session->has_userdata('success')) : ?>
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-info"></i> <?= $this->session->flashdata('success'); ?></h5>
</div>
<?php endif; ?>

<div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Messages</span>
                        <span class="info-box-number"><?= $data->chats; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-user-plus"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">User Registrations</span>
                        <span class="info-box-number"><?= $data->users; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="far fa-calendar-alt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Events</span>
                        <span class="info-box-number"><?= $data->events; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Ratings</span>
                        <span class="info-box-number"><?= $data->stars; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <br>

<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $data->patients; ?></h3>

                <p>Total Patients</p>
            </div>
            <div class="icon">
                <i class="nav-icon fa fa-user"></i>
                <!-- <i class="ion ion-bag"></i> -->
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $data->doctors; ?></h3>

                <p>Our Doctors</p>
            </div>
            <div class="icon">
                <i class="nav-icon fa fa-user-md"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $data->pharmacists; ?></h3>

                <p>Pharmacists</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $data->lab_workers; ?></h3>

                <p>Lab Workers</p>
            </div>
            <div class="icon">
                <i class="fa fa-flask"></i>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $data->donors; ?></h3>

                <p>Blood Donors</p>
            </div>
            <div class="icon">
                <i class="fas fa-burn"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $data->nurses; ?></h3>

                <p>Our Nurses</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-nurse"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $data->receptionists; ?></h3>

                <p>Our Receptionists</p>
            </div>
            <div class="icon">
                <i class="fas fa-hospital-user"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $data->diagnosis_reports; ?></h3>

                <p>Diagnosis Reports</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-medical"></i>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $data->medicines; ?></h3>

                <p>Available Medicines</p>
            </div>
            <div class="icon">
                <i class="fas fa-pills"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $data->operationreports; ?></h3>

                <p>Total Operation Reports</p>
            </div>
            <div class="icon">
                <i class="fas fa-plus"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $data->birthreports; ?></h3>

                <p>Total Birth Reports</p>
            </div>
            <div class="icon">
                <i class="fas fa-baby"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $data->deathreports; ?></h3>

                <p>Total Death Reports</p>
            </div>
            <div class="icon">
                <i class="fas fa-procedures"></i>
            </div>
        </div>
    </div>
</div>
<section class="content">
        <h3 class="mt-4 mb-4">Our Doctors</h3>
        <div class="row">
            <!-- /.col -->
            <?php foreach ($data->mydoctors as $doctor) : ?>
            <div class="col-md-4">
                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username"><?= $doctor->name; ?></h3>
                        <h5 class="widget-user-desc"><?= $doctor->phone; ?></h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" style="width:100px; height:100px"
                            src="<?= $doctor->icon; ?>" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-12 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Department</h5>
                                    <span class="description-text"><?= $this->Admin_model->getdeptby_id($doctor->department_id)->name; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <!-- /.col -->
        </div>
        <h3 class="mt-4 mb-4">Our Patients</h3>
        <div class="row">
            <!-- /.col -->
            <?php foreach ($data->mypatients as $doctor) : ?>
            <div class="col-md-4">
                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->


                    <div class="widget-user-header bg-success">
                        <h3 class="widget-user-username"><?= $doctor->name; ?></h3>
                        <h5 class="widget-user-desc"><?= $doctor->phone; ?></h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" style="width:100px; height:100px"
                            src="<?= $doctor->icon; ?>" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Blood Group</h5>
                                    <span class="description-text"><?= $doctor->blood_group; ?></span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Age</h5>
                                    <span class="description-text"><?= $doctor->age; ?></span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">Gender</h5>
                                    <span class="description-text"><?= $doctor->gender; ?></span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    

                </div>

                <!-- /.widget-user -->
            </div>
            <?php endforeach; ?>
            <!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section(scripts)
<!-- SweetAlert2 -->
<script src="<?= base_url('admin_assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>

<?php if ($this->session->has_userdata('success')) : ?>

<script type="text/javascript">
$(document).ready(function() {

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    Toast.fire({
        icon: 'success',
        title: '<?= $this->session->flashdata('success'); ?>'
    });
});
</script>

<?php endif;
unset($_SESSION['success']); ?>
@endsection