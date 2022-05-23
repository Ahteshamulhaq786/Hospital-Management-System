@extends(Frontend/MainTemplate)
@section(links)
<link rel="stylesheet" href="<?= base_url('doctor_assets/rating/jquery.rateyo.css') ?>">
<style>
  /* Make the image fully responsive */
  .carousel-inner img {
    width: 100%;
    height: 100%;
  }
  </style>
@endsection
@section(content)
<section>
    <div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner" style="height: auto">
    <div class="carousel-item active" style="height: auto;">
      <img src="<?= base_url('assets/frontend/images/slider1.jpg'); ?>" class="img-fluid img-responsive" alt="Los Angeles">
      <div class="carousel-caption">
        <h3>Where Compassion and Healing Come Together</h3>
        <p>The delivery of good medical care is to do as much nothing as possible</p>
      </div>   
    </div>
    <div class="carousel-item" style="height: auto">
      <img src="<?= base_url('assets/frontend/images/d3.jpg'); ?>" class="img-fluid img-responsive" alt="Chicago">
      <div class="carousel-caption">
        <h3>The Skill To Heal, The Spirit To Care</h3>
      </div>   
    </div>
    <div class="carousel-item" style="height: auto">
      <img src="<?= base_url('assets/frontend/images/slider4.jpg'); ?>" class="img-fluid img-responsive" alt="New York">
      <div class="carousel-caption">
        <h3>Clinic Automation System</h3>
        <p>We love the CAS Services</p>
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
</section>


<section class="slice sct-color-2 pb-0">
<div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="home-widget widget-1">
                    <i class="fa fa-phone"></i>
                    <h4>Emergency Contact</h4>
                    <h3><?= $settings->phone; ?></h3>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="home-widget widget-2">
                    <i class="fa fa-calendar"></i>
                    <h4>Doctor Appointment</h4>
                    <a href="<?= base_url('index.php/Home/make_appointment') ?>" class="btn">
                        Book An Appointment </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="home-widget widget-3">
                    <i class="fa fa-clock-o"></i>
                    <h4>Opening Hours</h4>
                    <ul>
                        <li class="clearfix">Monday-Friday
                            <span class="float-right">9.00-12.00</span>
                        </li>
                        <li class="clearfix">Saturday
                            <span class="float-right">9.00 - 5.00</span>
                        </li>
                        <li class="clearfix">Sunday
                            <span class="float-right">OFF</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="slice sct-color-2 pb-0">
    <div class="container">
        <div class="row align-items-md-center">

            <div class="col col-md-6 col-sm-12 col-12">
                <img src="<?= base_url('assets/frontend/images/welcome.png'); ?>" class="img-fluid img-center">
            </div>

            <div class="col col-md-6 col-sm-12 col-12">
                <div class="px-3 py-3 text-center text-lg-left">
                    <h3 class="heading heading-3 strong-500">
                        Welcome To Clinic Automation System </h3>
                    <p class="mt-4">
                        This system includes registration of patients, Doctors storing their details into the system, and also computerized billing in the pharmacy, and labs. The software has the facility to give a unique id for every patient and stores the clinical details of every patient and hospital tests done automatically. It includes a search facility to know the current status of each patient. This system also provides medicines online. The data can be retrieved easily. The interface is very user-friendly. The data are well protected for personal use and makes the data processing very fast. </p>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="slice slice--arrow bg-base-1">
    <div class="sct-inner container">
        <div class="section-title section-title-inverse section-title--style-1 text-center">
            <h3 class="section-title-inner">
                <span>Our World Class Services</span>
            </h3>
            <span class="section-title-delimiter clearfix d-none"></span>
        </div>

        <div class="fluid-paragraph fluid-paragraph-sm text-center">
            The World Class service of our system is that the common man can easily get his check up done. </div>
    </div>
</section>

<section class="slice-xl sct-color-1 b-xs-bottom">
    <div class="container">
        <div class="row-wrapper">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12" style="margin-top: 10px;">
                    <div class="icon-block icon-block--style-1-v2 block-icon-right block-icon-sm">
                        <div class="block-icon">
                            <img src="<?= base_url('assets/frontend/images/high-quality-services.png'); ?>" width="50">
                        </div>
                        <div class="block-content">
                            <h3 class="heading heading-5 strong-500">
                                High quality service </h3>
                            <br><br>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12" style="margin-top: 10px;">
                    <div class="icon-block icon-block--style-1-v2 block-icon-right block-icon-sm">
                        <div class="block-icon">
                            <img src="<?= base_url('assets/frontend/images/welcome.png'); ?>" width="50">
                        </div>
                        <div class="block-content">
                            <h3 class="heading heading-5 strong-500">
                                Modern hospital and technology </h3>
                            <br><br>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12" style="margin-top: 10px;">
                    <div class="icon-block icon-block--style-1-v2 block-icon-right block-icon-sm">
                        <div class="block-icon">
                            <img src="<?= base_url('assets/frontend/images/welcome.png'); ?>" width="50">
                        </div>
                        <div class="block-content">
                            <h3 class="heading heading-5 strong-500">
                                Ready for intervention </h3>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12" style="margin-top: 10px;">
                    <div class="icon-block icon-block--style-1-v2 block-icon-right block-icon-sm">
                        <div class="block-icon">
                            <img src="<?= base_url('assets/frontend/images/doctor.jpg'); ?>" width="50">
                        </div>
                        <div class="block-content">
                            <h3 class="heading heading-5 strong-500">
                                Specialist consulting for health problems </h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="slice sct-color-1 relative b-xs-bottom department-section">
    <div class="container">
        <div class="section-title section-title--style-1 text-center mb-4">
            <h3 class="section-title-inner text-normal">
                <span>Departments</span>
            </h3>
            <span class="section-title-delimiter clearfix d-none"></span>
        </div>

        <span class="clearfix"></span>

        <span class="space-xs-xl"></span>
        <div class="row-wrapper">
            <div class="row">
                <?php foreach ($departments as $department) : ?>
                    <div class="col-lg-3">
                        <a href="<?= base_url('index.php/home/department/' . $department->id); ?>">
                            <div class="department-small-view">
                                <div class="block-icon text-center">
                                    <img src="<?= $department->icon ?>" alt="" width="60">
                                    <h5><?= $department->name; ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>

<section class="slice sct-color-1 relative">
    <div class="container">
        <div class="section-title section-title--style-1 text-center mb-4">
            <h3 class="section-title-inner text-normal">
                <span>Our Awesome Doctors</span>
            </h3>
            <span class="section-title-delimiter clearfix d-none"></span>
        </div>

        <span class="clearfix"></span>

        <span class="space-xs-xl"></span>

        <div class="row-wrapper">
            <div class="row department-doctor-list">
                <?php foreach ($doctors as $doctor) : ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                        <div class="block block--style-4 list doctor-list">
                            <div class="block-image">
                                <div class="view view-fifth">
                                    <img src="<?= $doctor->icon; ?>" style="width: 200px; height: 200px;">
                                    <div class="mask">
                                        <div class="view-buttons">
                                            <span class="view-buttons-inner text-center appointment-btn">
                                                <a href="" data-did="<?= $doctor->id; ?>" onclick="getavgrating(this)" id="<?= base_url('index.php/Home/doctorDetails/' . $doctor->id); ?>" class="btn btn-styled btn-base-1 btn-outline btn-icon-left btn-st-trigger" data-effect="st-effect-1">
                                                    <i class="fa fa-user-md"></i> &nbsp;View Details</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content w-100">
                                <div class="block-body py-2 px-0">
                                    <small>
                                        <?= $this->Admin_model->getdeptby_id($doctor->department_id)->name; ?>
                                    </small>
                                    <h3 class="heading heading-5 strong-500">
                                        <a href="" class="btn-st-trigger" data-effect="st-effect-1" id="<?= base_url('index.php/Home/doctorDetails/1'); ?>">
                                            <?= $doctor->name; ?> </a>
                                    </h3>
                                </div>

                                <div class="block-footer block-footer-fixed-bottom b-xs-top">
                                    <div class="row">
                                        <div class="col-12">
                                            <ul class="social-media social-media--style-1-v4">
                                                <?php $doctor = (array)$doctor; ?>
                                                <?php if ($doctor['fb_link'] != '') : ?>
                                                    <li>

                                                        <a href="<?= '//'.$doctor['fb_link'] ?>" target="_blank">
                                                            <i class="ion ion-social-facebook"></i>
                                                        </a>

                                                    </li>
                                                <?php endif; ?>
                                                <?php if ($doctor['twitter_link'] != '') : ?>
                                                    <li>
                                                        <a href="<?= '//'.$doctor['twitter_link'] ?>" target="_blank">
                                                            <i class="ion ion-social-twitter"></i>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if ($doctor['googleplus_link'] != '') : ?>
                                                    <li>
                                                        <a href="<?= '//'.$doctor['googleplus_link'] ?>" target="_blank">
                                                            <i class="ion ion-social-googleplus"></i>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if ($doctor['Linkedin_link'] != '') : ?>
                                                    <li>
                                                        <a href="<?= '//'.$doctor['Linkedin_link'] ?>" target="_blank">
                                                            <i class="ion ion-social-linkedin"></i>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>


<section class="slice sct-color-2 b-xs-top b-xs-bottom">
    <div class="container">
        <div class="text-center">
            <div class="section-title section-title--style-1 text-center mb-4">
                <h3 class="section-title-inner text-normal">
                    <span>Get In Touch With Our Professionals</span>
                </h3>
                <span class="section-title-delimiter clearfix d-none"></span>
            </div>

            <span class="clearfix"></span>
            <div class="mt-5">
                <a href="<?= base_url('index.php/Home/make_appointment') ?>" class="btn btn-styled btn-lg btn-base-1">
                    Make An Appointment </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section(scripts)
<script src="<?= base_url('doctor_assets/rating/jquery.rateyo.js') ?>"></script>
<script>
    function getavgrating(el) {
        var did = $(el).data('did');
        $(function() {
            $.ajax({
                url: 'http://localhost/Clinic-Automation-system/index.php/home/fetch_avg_rating',
                type: "POST",
                data: {
                    did: did,
                },
                success: function(data) {
                    $("#rateYoPPP").rateYo({
                        rating: data,
                        starWidth: "22px",
                        precision: 2,
                        readOnly: true,
                        spacing: "5px"
                    });
                }
            });
        });
    }
</script>
@endsection