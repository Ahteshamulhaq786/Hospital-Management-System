@extends(Backend/Receptionist/MainTemplate)
@section(profileselected)
active
@endsection
@section(pagetitle)
Profile
@endsection
@section(stylelinks)
<link href="<?= base_url('doctor_assets/css/plugins/iCheck/custom.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/chosen/bootstrap-chosen.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/colorpicker/bootstrap-colorpicker.min.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/cropper/cropper.min.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/switchery/switchery.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/jasny/jasny-bootstrap.min.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/nouslider/jquery.nouislider.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/datapicker/datepicker3.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/ionRangeSlider/ion.rangeSlider.css') ?>" rel="stylesheet">
<link href="<?= base_url('doctor_assets/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') ?>"
    rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/clockpicker/clockpicker.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/daterangepicker/daterangepicker-bs3.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/select2/select2.min.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/dualListbox/bootstrap-duallistbox.min.css') ?>" rel="stylesheet">

@endsection
@section(alert)
<?php if ($this->session->has_userdata('success')) : ?>
<div class="alert alert-warning alert-dismissible mx-5">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p class="m-0">
        <?= $this->session->flashdata('success'); ?></p>
</div>
<?php endif; unset($_SESSION['success']); ?>
@endsection
@section(content)


<div class="wrapper wrapper-content animated fadeInRight">
    

    <div class="col-lg-12">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1">Edit Profile</a></li>
                <li class=""><a data-toggle="tab" href="#tab-2">Change Password</a></li>
            </ul>
            <div class="tab-content">

                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <div class="col-lg-10 col-md-10 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-1">
                        <form role="form" class="form-horizontal form-groups"
                                action="<?= site_url('index.php/receptionist/update_profile'); ?>" method="post"
                                enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-9">
                                        <input autocomplete="off" type="text" name="name"
                                            value="<?= isset($_POST['name']) ? $_POST['name'] : $data->name ?>"
                                            class="form-control">
                                        <div class="invalid-feedback d-block text-danger">
                                            <?= form_error('name'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">Email</label>

                                    <div class="col-sm-9">
                                        <input autocomplete="off" type="email" name="email" class="form-control"
                                            value="<?= isset($_POST['email']) ? $_POST['email'] : $data->email; ?>">
                                        <div class="invalid-feedback d-block text-danger">
                                            <?= form_error('email'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="field-ta" class="col-sm-3 control-label">Address</label>

                                    <div class="col-sm-9">
                                        <textarea name="address"
                                            class="form-control "><?= isset($_POST['address']) ? $_POST['address'] : $data->address; ?></textarea>
                                        <div class="invalid-feedback d-block text-danger">
                                            <?= form_error('address'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">Phone</label>

                                    <div class="col-sm-9">
                                        <input autocomplete="off" type="text" name="phone" class="form-control"
                                            value="<?= isset($_POST['phone']) ? $_POST['phone'] : $data->phone ?>">
                                        <div class="invalid-feedback d-block text-danger">
                                            <?= form_error('phone'); ?>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Image</label>
                                    <div class="col-sm-8">
                                        <input type="file" onchange="readURL(this)" class="btn" name="icon">
                                        <div class="invalid-feedback d-block text-danger">
                                            <?php if (isset($_SESSION['upload_error'])) {
                                                echo $_SESSION['upload_error'];
                                                unset($_SESSION['upload_error']);
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-1" style="display:flex;justify-content: center;">
                                        <img id="output" width="60px" src="" alt="">
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-9" style="display: flex;justify-content:center;">
                                        <img src="<?= $data->icon ?>" width="200" height="200" />
                                        <input type="hidden" id="old_img_1" name="old_img" value="<?= $data->icon ?>">
                                    </div>
                                </div>
                                <div class="col-sm-3 control-label col-sm-offset-1">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check"></i> Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        <div class="col-lg-10 col-md-10 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-1">
                            <form role="form" class="form-horizontal form-groups" action="<?= base_url('index.php/receptionist/update_password'); ?>" method="post">

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">Old Password</label>

                                    <div class="col-sm-9">
                                        <input type="text" name="old_pass" class="form-control" id="field-1"
                                        value="<?= isset($_POST['old_pass']) ? $_POST['old_pass'] : ''; ?>" required="">
                                            <div class="invalid-feedback text-danger"><?= form_error('old_pass'); ?></div>
                                        <div class="invalid-feedback text-danger"><?php if(isset($_SESSION['pass_error'])) { echo $_SESSION['pass_error']; } 
                                         unset($_SESSION['pass_error']); ?></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">New Password</label>

                                    <div class="col-sm-9">
                                        <input type="text" name="new_password" class="form-control" id="field-1" value="<?= isset($_POST['new_password']) ? $_POST['new_password'] : ''; ?>"
                                            required="">
                                            <div class="invalid-feedback text-danger"><?= form_error('new_password'); ?></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">Confirm Password</label>

                                    <div class="col-sm-9">
                                        <input type="text" name="conf_pass" class="form-control" id="field-1" value="<?= isset($_POST['conf_pass']) ? $_POST['conf_pass'] : ''; ?>"
                                            required="">
                                            <div class="invalid-feedback text-danger"><?= form_error('conf_pass'); ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-3 control-label col-sm-offset-1">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check"></i> Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section(scriptlinks)
<script src="<?= base_url('doctor_assets/js/plugins/slimscroll/jquery.slimscroll.min.js') ?>"></script>
<!-- Chosen -->
<script src="<?= base_url('doctor_assets/js/plugins/chosen/chosen.jquery.js') ?>"></script>

<!-- JSKnob -->
<script src="<?= base_url('doctor_assets/js/plugins/jsKnob/jquery.knob.js') ?>"></script>

<!-- Input Mask-->
<script src="<?= base_url('doctor_assets/js/plugins/jasny/jasny-bootstrap.min.js') ?>"></script>

<!-- Data picker -->
<script src="<?= base_url('doctor_assets/js/plugins/datapicker/bootstrap-datepicker.js') ?>"></script>

<!-- NouSlider -->
<script src="<?= base_url('doctor_assets/js/plugins/nouslider/jquery.nouislider.min.js') ?>"></script>

<!-- Switchery -->
<script src="<?= base_url('doctor_assets/js/plugins/switchery/switchery.js') ?>"></script>

<!-- IonRangeSlider -->
<script src="<?= base_url('doctor_assets/js/plugins/ionRangeSlider/ion.rangeSlider.min.js') ?>"></script>

<!-- iCheck -->
<script src="<?= base_url('doctor_assets/js/plugins/iCheck/icheck.min.js') ?>"></script>

<!-- MENU -->
<script src="<?= base_url('doctor_assets/js/plugins/metisMenu/jquery.metisMenu.js') ?>"></script>

<!-- Color picker -->
<script src="<?= base_url('doctor_assets/js/plugins/colorpicker/bootstrap-colorpicker.min.js') ?>"></script>

<!-- Clock picker -->
<script src="<?= base_url('doctor_assets/js/plugins/clockpicker/clockpicker.js') ?>"></script>

<!-- Image cropper -->
<script src="<?= base_url('doctor_assets/js/plugins/cropper/cropper.min.js') ?>"></script>

<!-- Date range use moment.js same as full calendar plugin -->
<script src="<?= base_url('doctor_assets/js/plugins/fullcalendar/moment.min.js') ?>"></script>

<!-- Date range picker -->
<script src="<?= base_url('doctor_assets/js/plugins/daterangepicker/daterangepicker.js') ?>"></script>

<!-- Select2 -->
<script src="<?= base_url('doctor_assets/js/plugins/select2/select2.full.min.js') ?>"></script>

<!-- TouchSpin -->
<script src="<?= base_url('doctor_assets/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js') ?>"></script>

<!-- Tags Input -->
<script src="<?= base_url('doctor_assets/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') ?>"></script>

<!-- Dual Listbox -->
<script src="<?= base_url('doctor_assets/js/plugins/dualListbox/jquery.bootstrap-duallistbox.js') ?>">
</script>


<!-- Sweet alert -->
<script src="<?= base_url('doctor_assets/js/plugins/sweetalert/sweetalert.min.js') ?>"></script>
<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#output')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<?php if ($this->session->has_userdata('success')) : ?>
<script>
$(document).ready(function() {
    swal({
        title: "<?= $this->session->flashdata('success'); ?>",
        text: "Please Check Your Profile",
        type: "success"
    });
});
</script>
<?php endif;
unset($_SESSION['success']); ?>
@endsection