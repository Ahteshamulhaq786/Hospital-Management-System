@extends(Frontend/MainTemplate)
@section(content)
<section class="slice--offset parallax-section parallax-section-xl b-xs-bottom custom-page-head" style="background-image: url('<?= base_url('assets/frontend/images/img-15.jpg'); ?>');">
    <div class="container">
        <div class="row py-3">
            <div class="col-lg-12">
                <h1 class="heading text-uppercase c-white">
                    Contact Us </h1>

                <span class="clearfix"></span>

                <div class="">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('index.php'); ?>">
                                Home </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Contact Us </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="slice b-xs-bottom">
    <div class="container">
        <div class="text-center">
            <h2 class="heading heading-2 strong-400">
                Contact Us For Help </h2>
            <p>
                Please Call Us Or Complete The Form Below And We Will Get To You Shortly </p>
            <button class="btn btn-styled btn-xl btn-base-1 btn-icon-left mt-4">
                <i class="fa fa-mobile"></i><?= $contact_no ?> </button>

        </div>


        <?php if (isset($_SESSION['success'])) : ?>
            <div class="mt-5 mb-0 alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success'];
                unset($_SESSION['success']); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        <?php endif; ?>

    </div>
</section>

<section class="slice sct-color-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Contact form -->
                <form id="form_contact" class="form-default" role="form" action="<?= site_url('index.php/home/makecontact'); ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label for="" class="text-uppercase c-gray-light">
                                    Your Name </label>
                                <input type="text" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" class="form-control form-control-lg" required="">
                                <div class="invalid-feedback d-block"><?= form_error('name'); ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label for="" class="text-uppercase c-gray-light">
                                    Your Email </label>
                                <input type="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" name="email" class="form-control form-control-lg" required="">
                                <div class="invalid-feedback d-block"><?= form_error('email'); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label for="" class="text-uppercase c-gray-light">
                                    Phone </label>
                                <input type="text" name="phone" value="<?= isset($_POST['phone']) ?  $_POST['phone'] : '' ?>" class="form-control form-control-lg" required="">
                                <div class="invalid-feedback d-block"><?= form_error('phone'); ?></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group has-feedback">
                                <label for="" class="text-uppercase c-gray-light">
                                    Address </label>
                                <input type="text" name="address" value="<?= isset($_POST['address']) ? $_POST['address'] : '' ?>" class="form-control form-control-lg" required="">
                                <div class="invalid-feedback d-block"><?= form_error('address'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <label for="" class="text-uppercase c-gray-light">
                                    Message </label>
                                <textarea name="message" class="form-control no-resize" rows="5" required=""><?= isset($_POST['message']) ? $_POST['message'] : '' ?></textarea>
                                <div class="invalid-feedback d-block"><?= form_error('message'); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="g-recaptcha" data-sitekey="6LdK0XAbAAAAABm1lsYRZAz7-nW2yUictJRRKkrL"></div>
                            <div class="invalid-feedback d-block"><?= isset($capchta_error) ? $capchta_error : ''; ?></div>
                        </div>
                    </div>

                    <div class="row">
                        <button type="submit" class="btn btn-styled btn-base-1 mt-4" style="cursor: pointer;">
                            Send Message </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section(scripts)
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection