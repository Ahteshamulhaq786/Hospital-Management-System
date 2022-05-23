@extends(Backend/Labortorist/MainTemplate)
@section(links)

@endsection
@section(profileselected)
active
@endsection
@section(alert)
<?php if ($this->session->has_userdata('success')) : ?>
    <div class="alert alert-warning mx-5">
        <p class="m-0"><?= $this->session->flashdata('success'); ?></p>
    </div>
<?php endif;
unset($_SESSION['success']);  ?>
@endsection
@section(content)
<div class="container-fluid">
    <h4 class="page-title">Profile</h4>
    <div class="row">
        <div class="col-md-2 col-12">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-home" aria-selected="true">Profile</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-security" role="tab" aria-controls="v-pills-profile" aria-selected="false">Security</a>
            </div>
        </div>
        <div class="col-md-10 col-12">

            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <form method="post" action="<?= base_url('index.php/lab/manage_profile'); ?>" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input required autocomplete="off" type="text" class="form-control" name="name" id="inputEmail3" placeholder="Edit Your Name" value="<?= isset($record->name) ? $record->name : $_POST['name'];  ?>">
                                <div class="invalid-feedback d-block">
                                    <?= form_error('name'); ?>
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input required autocomplete="off" type="email" name="email" value="<?= isset($record->email) ? $record->email : $_POST['email'];  ?>" class="form-control" id="inputEmail3" placeholder="Edit Email">
                                <div class="invalid-feedback d-block">
                                    <?= form_error('email'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3"><?= isset($record->address) ? $record->address : $_POST['address'];  ?></textarea>
                                <div class="invalid-feedback d-block">
                                    <?= form_error('address'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input required autocomplete="off" type="text" name="phone" value="<?= isset($record->phone) ? $record->phone : $_POST['phone'];  ?>" class="form-control" id="inputPassword3" placeholder="Phone">
                                <div class="invalid-feedback d-block">
                                    <?= form_error('phone'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Image</label>
                            <div class="btns col-sm-10">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input onchange="readURL(this);" type="file" id="inputFile" name="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>

                                    </div>
                                    <div class="col-sm-2" style="display: flex;justify-content: center;">
                                        <img width="60px" id="imge" height="60px" src="" style="display: none;">
                                    </div>
                                </div>
                                <div class="invalid-feedback d-block">
                                    <?= form_error('file'); ?>
                                </div>
                                <?php if (isset($_GET['upload_error'])) : ?>
                                    <div class="invalid-feedback d-block">
                                        <?= $_GET['upload_error']; ?>
                                    </div>
                                <?php endif; ?>

                                <img style="width: 150px; height: 150px;" src="<?= isset($record->icon) ? $record->icon : $_POST['prev_img']; ?>" id="blah" alt="Img"><br><br>

                            </div>
                        </div>
                        <input type="hidden" id="prev_img" name="prev_img" value="<?= isset($record->icon) ? $record->icon : $_POST['prev_img']; ?>">
                        <input required autocomplete="off" type="hidden" name="hidden_id" value="<?= $_SESSION['PROFILE_ID']; ?>">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>

                        </div>
                    </form>

                </div>
                <div class="tab-pane fade" id="v-pills-security" role="tabpanel" aria-labelledby="v-pills-home-tab">

                    <form method="post" action="<?= base_url('index.php/lab/edit_pass'); ?>">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Old Password</label>
                            <div class="col-sm-10">
                                <input required autocomplete="off" type="text" name="old_pass" value="<?= isset($_POST['old_pass']) ? $_POST['old_pass'] : ''; ?>" class="form-control" id="inputEmail3" placeholder="Enter Old Password">
                                <div class="invalid-feedback d-block">
                                    <?= form_error('old_pass'); ?>
                                </div>
                                <?php if (isset($_SESSION['form_err_msg'])) : ?>
                                    <div class="invalid-feedback d-block">
                                        <?= $_SESSION['form_err_msg'];
                                        unset($_SESSION['form_err_msg']) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-10">
                                <input required autocomplete="off" type="text" name="new_pass" value="<?= isset($_POST['new_pass']) ? $_POST['new_pass'] : ''; ?>" class="form-control" id="inputEmail3" placeholder="New Password">
                                <div class="invalid-feedback d-block">
                                    <?= form_error('new_pass'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Confirm Password</label>
                            <div class="col-sm-10">
                                <input required autocomplete="off" type="text" name="conf_pass" value="<?= isset($_POST['conf_pass']) ? $_POST['conf_pass'] : ''; ?>" " class=" form-control" id="inputEmail3" placeholder="Confirm New Password">
                                <div class="invalid-feedback d-block">
                                    <?= form_error('conf_pass'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container"><br><br></div>
@endsection

@section(scripts)
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: 'Bfltip',
            buttons: [
                'copy', 'excel', 'pdf', 'print', 'csv'
            ]
        });
    });
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imge')
                    .attr('src', e.target.result).show();
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection