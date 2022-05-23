@extends(Backend/Admin/MainTemplate)
@section(title)Add Blood Donor@endsection
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
<section>
    <div class="container-fluid d-flex justify-content-end mb-3">
        <a href="<?= site_url('index.php/admin/blooddonor');?>">
            <button type="button" class="btn btn-sm btn-info">
            Back
        </button>
        </a>
        
    </div>

</section>
<div class="card">

    <div class="card-header">
        <h3 class="card-title">Manage Donors</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form role="form" action="<?= site_url('index.php/admin/donors'); ?>" method="post"
            enctype="multipart/form-data">
            <div class="form-group row">
                <label for="" class="col-12 col-md-3 text-center control-label">Name</label>

                <div class="col-12 col-md-7">
                    <input required autocomplete="off" name="donor_name"
                        value="<?= isset($_POST['donor_name']) ? $_POST['donor_name'] : $record->donor_name; ?>"
                        type="text" class="form-control input-square" id="exampleFormControlInput1"
                        placeholder="Enter Donor Name">
                    <span class="text-danger"><?php echo form_error("donor_name"); ?></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="" class="col-12 col-md-3 text-center control-label">Email</label>

                <div class="col-12 col-md-7">
                    <input required autocomplete="off" name="donor_email"
                        value="<?= isset($_POST['donor_email']) ? $_POST['donor_email'] : $record->donor_email; ?>"
                        type="text" class="form-control input-square" id="squareInput" placeholder="Enter Donor Email">
                    <span class="text-danger"><?php echo form_error("donor_email"); ?></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="" class="col-12 col-md-3 text-center control-label">Address</label>

                <div class="col-12 col-md-7">
                <input required autocomplete="off" name="donor_address"
                        value="<?= isset($_POST['donor_address']) ? $_POST['donor_address'] : $record->donor_address; ?>"
                        type="text" class="form-control input-square" id="squareInput"
                        placeholder="Enter Donor Address">
                    <span class="text-danger"><?php echo form_error("donor_address"); ?></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="" class="col-12 col-md-3 text-center control-label">Phone</label>

                <div class="col-12 col-md-7">
                <input required autocomplete="off" name="donor_phone"
                        value="<?= isset($_POST['donor_phone']) ? $_POST['donor_phone'] : $record->donor_phone; ?>"
                        type="text" class="form-control input-square" id="squareInput" placeholder="Enter Donor Phone">
                    <span class="text-danger"><?php echo form_error("donor_phone"); ?></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="" class="col-12 col-md-3 text-center control-label">Age</label>

                <div class="col-12 col-md-7">
                <input required autocomplete="off" name="donor_age"
                        value="<?= isset($_POST['donor_age']) ? $_POST['donor_age'] : $record->donor_age; ?>"
                        type="text" class="form-control input-square" id="squareInput" placeholder="Enter Donor Age">
                    <span class="text-danger"><?php echo form_error("donor_age"); ?></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="" class="col-12 col-md-3 text-center control-label">Gender</label>

                <div class="col-12 col-md-7">
                <select required autocomplete="off" name="donor_gender" class="form-control" id="pillSelect">
                        <option value="0">Select Gender</option>
                        <option value="male" <?php echo ($record->donor_gender == "male") ? "selected" : ''; ?>>Male
                        </option>
                        <option value="female" <?php echo ($record->donor_gender == "female") ? "selected" : ''; ?>>Female
                        </option>
                    </select>
                    <span class="text-danger"><?php echo form_error("donor_gender"); ?></span>
                    <div class="invalid-feedback text-danger d-block text-bold">
                        <?= form_error('gender'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-12 col-md-3 text-center control-label">Blood Group</label>

                <div class="col-12 col-md-7">
                <select required autocomplete="off" name="donor_blood_group" class="form-control" id="pillSelect">
                    <option value="">Select Blood Group</option>
                        <option value="A+" <?= ($record->donor_blood_group == "A+") ? "selected" : ''; ?>>A+</option>
                        <option value="A-" <?= ($record->donor_blood_group == "A-") ? "selected" : ''; ?>>A-</option>
                        <option value="B+" <?= ($record->donor_blood_group == "B+") ? "selected" : ''; ?>>B+</option>
                        <option value="B-" <?= ($record->donor_blood_group == "B-") ? "selected" : ''; ?>>B-</option>
                        <option value="AB+" <?= ($record->donor_blood_group == "AB+") ? "selected" : ''; ?>>AB+</option>
                        <option value="AB-" <?= ($record->donor_blood_group == "AB-") ? "selected" : ''; ?>>AB-</option>
                        <option value="O+" <?= ($record->donor_blood_group == "O+") ? "selected" : ''; ?>>O+</option>
                        <option value="O-" <?= ($record->donor_blood_group == "O-") ? "selected" : ''; ?>>O-</option>
                    </select>
                    <span class="text-danger"><?php echo form_error("donor_blood_group"); ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-12 col-md-3 text-center control-label">Last Donation Date</label>

                <div class="col-12 col-md-7">
                <input required autocomplete="off" name="last_donation_date"
                        value="<?= isset($_POST['last_donation_date']) ? $_POST['last_donation_date'] : $record->last_donation_date; ?>"
                        type="date" class="form-control input-square" id="squareInput" placeholder="Last Donation Date">
                    <span class="text-danger"><?php echo form_error("last_donation_date"); ?></span>
                </div>
            </div>
            <?php if(isset($record->id) || isset($_POST['hidden_id'])) {?>
                <input type="hidden" name="hidden_id" style="margin-left: 100px;"
                    value="<?= isset($record->id) ? $record->id : $_POST['hidden_id']; ?>">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" style="color: white;" class="btn btn-warning">Update</button>
                    </div>
                </div>
                <?php } else{ ?>

                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button style="margin-left: 100px;" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>

                <?php } ?>
        </form>

    </div>
</div>
</div>
<!-- /.card-body -->
</div>
@endsection
@section(scripts)
<script src="<?= base_url('admin_assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<script>
function loadFile(event) {
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
};

function rmimg() {
    var image = document.getElementById('output');
    image.src = "";
    $("#old_img_1").val('');
}
</script>
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