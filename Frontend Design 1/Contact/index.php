<?php include('header.php') ?>
<section class="slice--offset parallax-section parallax-section-xl b-xs-bottom custom-page-head" style="background-image: url('https://creativeitem.com/demo/bayanno/assets/frontend/default/images/img-15.jpg');">
    <div class="container">
        <div class="row py-3">
            <div class="col-lg-12">
                <h1 class="heading text-uppercase c-white">
                    Contact Us </h1>

                <span class="clearfix"></span>

                <div class="">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="https://creativeitem.com/demo/bayanno/index.php/home">
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
                <i class="fa fa-mobile"></i>1-800-400-7400 </button>
        </div>
    </div>
</section>

<section class="slice sct-color-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Contact form -->
                <form id="form_contact" class="form-default" role="form" action="https://creativeitem.com/demo/bayanno/index.php/home/contact_us/contact" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label for="" class="text-uppercase c-gray-light">
                                    Your Name </label>
                                <input type="text" name="name" class="form-control form-control-lg" required="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label for="" class="text-uppercase c-gray-light">
                                    Your Email </label>
                                <input type="email" name="email" class="form-control form-control-lg" required="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label for="" class="text-uppercase c-gray-light">
                                    Phone </label>
                                <input type="text" name="phone" class="form-control form-control-lg" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group has-feedback">
                                <label for="" class="text-uppercase c-gray-light">
                                    Address </label>
                                <input type="text" name="address" class="form-control form-control-lg" required="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <label for="" class="text-uppercase c-gray-light">
                                    Message </label>
                                <textarea name="message" class="form-control no-resize" rows="5" required=""></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6LePbzgUAAAAAPoKsV10vpTe74Jv67R2ETggFiVC"></div>
                            </div>
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

<?php include('footer.php') ?>