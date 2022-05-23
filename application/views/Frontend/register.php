@extends(Frontend/MainTemplate)
@section(content)
<section class="slice--offset parallax-section parallax-section-xl b-xs-bottom custom-page-head" style="background-image: url('<?= base_url('assets/frontend/images/img-15.jpg'); ?>');">
    <div class="container">
        <div class="row py-3">
            <div class="col-lg-12">
                <h1 class="heading text-uppercase c-white">
                    Appointment </h1>

                <span class="clearfix"></span>

                <div class="">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('index.php'); ?>">
                                Home </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Appointment </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="slice sct-color-2 b-xs-bottom">
    <div class="container">
        <div class="section-title section-title--style-1 text-center mb-3">
            <h3 class="heading heading-2 strong-400">
                Patient Registeration </h3>
            <span class="section-title-delimiter clearfix d-none"></span>
        </div>
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
                <?= $_SESSION['success'];
                unset($_SESSION['success']); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="slice sct-color-2">
    <div class="container">
        <form class="form-default" action="<?= site_url('index.php/home/register'); ?>" method="post" enctype="multipart/form-data">

            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="" class="text-uppercase  c-gray-light">
                            Name </label>
                        <input type="text" class="form-control input-lg" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" placeholder="" name="name">
                        <div class="invalid-feedback d-block"><?= form_error('name'); ?></div>
                    </div>

                    <div class="form-group">
                        <label for="" class="text-uppercase c-gray-light">
                            Email </label>
                        <input type="email" class="form-control input-lg" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" placeholder="" name="email">
                        <div class="invalid-feedback d-block"><?= form_error('email'); ?></div>
                    </div>

                    <div class="form-group">
                        <label for="" class="text-uppercase c-gray-light">
                            Password </label>
                        <input type="text" class="form-control input-lg" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>" placeholder="" name="password">
                        <div class="invalid-feedback d-block"><?= form_error('password'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="text-uppercase c-gray-light">
                            Address </label>
                        <textarea class="form-control no-resize" rows="6" name="address" placeholder="Your Address"><?= isset($_POST['address']) ? $_POST['address'] : '' ?></textarea>
                        <div class="invalid-feedback d-block"><?= form_error('address'); ?></div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="" class="text-uppercase c-gray-light">
                            Phone </label>
                        <input type="text" class="form-control input-lg" value="<?= isset($_POST['phone']) ? $_POST['phone'] : '' ?>" placeholder="" name="phone">
                        <div class="invalid-feedback d-block"><?= form_error('phone'); ?></div>
                    </div>

                    <div class="form-group">
                        <label for="" class="text-uppercase c-gray-light">
                            Birth Day </label>
                        <input type="text" class="form-control input-lg datepicker" placeholder="" name="birthday" value="<?= isset($_POST['birthday']) ? $_POST['birthday'] : '' ?>">
                        <div class="invalid-feedback d-block"><?= form_error('birthday'); ?></div>
                    </div>

                    <div class="form-group">
                        <label for="" class="text-uppercase c-gray-light">
                            Age </label>
                        <input type="text" class="form-control input-lg" value="<?= isset($_POST['age']) ? $_POST['age'] : '' ?>" placeholder="" name="age">
                        <div class="invalid-feedback d-block"><?= form_error('age'); ?></div>
                    </div>

                    <div class="form-group">
                        <label for="" class="text-uppercase c-gray-light">
                            Blood Group </label>


                        <select name="blood_group" class="form-control" autocomplete="off">
                            <option value="">Select Blood Group</option>
                            <option value="A+" <?php if (isset($_POST['blood_group'])) {
                                                    echo $_POST['blood_group']  == 'A+' ? "selected" : '';
                                                } ?>>A+</option>
                            <option value="A-" <?php if (isset($_POST['blood_group'])) {
                                                    echo $_POST['blood_group'] == 'A-' ? "selected" : '';
                                                } ?>>A-</option>
                            <option value="B+" <?php if (isset($_POST['blood_group'])) {
                                                    echo $_POST['blood_group'] == 'B+' ? "selected" : '';
                                                } ?>>B+</option>
                            <option value="B-" <?php if (isset($_POST['blood_group'])) {
                                                    echo $_POST['blood_group'] == 'B-' ? "selected" : '';
                                                } ?>>B-</option>
                            <option value="AB+" <?php if (isset($_POST['blood_group'])) {
                                                    echo $_POST['blood_group'] == 'AB+' ? "selected" : '';
                                                } ?>>AB+</option>
                            <option value="AB-" <?php if (isset($_POST['blood_group'])) {
                                                    echo $_POST['blood_group'] == 'AB-' ? "selected" : '';
                                                } ?>>AB-</option>
                            <option value="O+" <?php if (isset($_POST['blood_group'])) {
                                                    echo $_POST['blood_group'] == 'O+' ? "selected" : '';
                                                } ?>>O+</option>
                            <option value="O-" <?php if (isset($_POST['blood_group'])) {
                                                    echo $_POST['blood_group'] == 'O-' ? "selected" : '';
                                                } ?>>O-</option>
                        </select>

                        <div class="invalid-feedback d-block"><?= form_error('blood_group'); ?></div>

                    </div>
                    <div class="form-group">
                        <label for="" class="text-uppercase c-gray-light">
                            Gender </label>


                        <select class="form-control" name="gender">
                            <option value="">Please Select Gender</option>
                            <option value="male" <?php if (isset($_POST['gender'])) {
                                                        echo $_POST['gender'] == 'male' ? 'selected' : '';
                                                    } ?>>Male</option>
                            <option value="female" <?php if (isset($_POST['gender'])) {
                                                        echo $_POST['gender'] == 'female' ? 'selected' : '';
                                                    } ?>>Female</option>
                        </select>

                        <div class="invalid-feedback d-block"><?= form_error('gender'); ?></div>

                    </div>
                </div>
                <div class="col-sm-12 col-md-6">

                    <div class="form-group">
                        <label for="" class="text-uppercase c-gray-light">
                            Select Image </label>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="icon">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <div class="invalid-feedback d-block"><?= isset($data['error']) ? $data['error'] : ''; ?></div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <img src="" id="imgsrc" style="display:none;width: 150px;height: 84px;" alt="">
                </div>

                <div class="col-12">

                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LdK0XAbAAAAABm1lsYRZAz7-nW2yUictJRRKkrL"></div>
                        <div class="invalid-feedback d-block"><?= isset($data['captcha_error']) ? $data['captcha_error'] : ''; ?></div>
                    </div>

                </div>
                <div class="col-12 pt-3">
                    <button type="submit" class="btn btn-styled btn-base-1" style="cursor: pointer;">
                        <i class="fa fa-calendar mr-1"></i>Register</button>
                    <h6><b>Already</b> have an account? <a href="<?= base_url('index.php/Home/login') ?>" target="_blank">Log In</a></h6>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section(scripts)
<script>
    imgInp = document.getElementById('customFile');
    imgsrc = document.getElementById('imgsrc');
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            imgsrc.src = URL.createObjectURL(file)
            imgsrc.style.display = "block";
        }
    }
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection