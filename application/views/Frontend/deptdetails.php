@extends(Frontend/MainTemplate)
@section(links)
<link rel="stylesheet" href="<?= base_url('doctor_assets/rating/jquery.rateyo.css') ?>">
@endsection
@section(content)
<section class="slice--offset parallax-section parallax-section-xl b-xs-bottom custom-page-head" style="background-image: url('<?=base_url('assets/frontend/images/img-15.jpg'); ?>');">
    <div class="container">
        <div class="row py-3">
            <div class="col-lg-12">
                <h1 class="heading text-uppercase c-white">
                    <?= $department->name ?> </h1>

                <span class="clearfix"></span>

                <div class="">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>">
                                Home </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="<?= base_url('index.php/home/department'); ?>">Departments </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?= $department->name ?> </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="slice sct-color-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="sidebar sidebar--style-2 department-sidebar">
                    <div class="sidebar-object">
                        <ul class="categories categories--style-2">
                            <?php $departmentts = $this->Admin_model->get_depts(); ?>
                            <?php foreach ($departmentts as $departmentt) : ?>
                                <li class="<?= $departmentt->id == $detp_id ? 'active' : '' ?>">
                                    <a href="<?= site_url('index.php/home/department/' . $departmentt->id); ?>">
                                        <?= $departmentt->name ?> </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="appointment-btn">
                            <a href="<?=base_url('index.php/Home/make_appointment')?>" class="btn btn-styled btn-base-1 btn-outline btn-icon-left">
                                <i class="fa fa-calendar"></i>
                                Book Appointment </a>
                        </div>
                    </div>
                    <div class="sidebar-object text-center">
                        <p class="mb-1">For Emergency Contact</p>
                        <h3>
                            0483229176 </h3>
                    </div>

                </div>
            </div>

            <div class="col-lg-9">
                <div class="block block-post">
                    <div class="block-body block-post-body b-xs-bottom mb-5 pb-5">
                        <p><?= $department->description; ?></p>
                    </div>
                    <div class="department-price-list row mb-5">
                        <div class="col-md-12">
                            <h4 class="heading heading-4 strong-400 text-normal">
                                <?= $department->name ?> Department Facilities </h4>
                            <span class="short-delimiter--style-1 mb-4"></span>
                            <div class="accordion accordion--style-3" id="collapseFour">
                                <?php $facilities = $this->Admin_model->getfacilityby_deptid($department->id); ?>
                                <?php if (count($facilities) > 0) { ?>
                                    <?php foreach ($facilities as $facility) : ?>
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title ">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#collapseFour" href="#collapseFour-1" aria-hidden="false" aria-expanded="true">
                                                        <?= $facility->title; ?> </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFour-1" class="panel-collapse collapse show">
                                                <div class="card-body">
                                                    <p>
                                                        <?= $facility->description; ?> </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    <?php endforeach; ?>
                                <?php } else { ?>
                                    There are no Facilties for <?= $department->name ?> Department
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="block department-doctor-list mb-5 ">
                        <h4 class="heading heading-4 strong-400 text-normal">
                            Awesome Doctors Of <?= $department->name ?> Department </h4>
                        <span class="short-delimiter--style-1 mb-4"></span>
                        <div class="doctor-grid-view row">
                            <?php $doctors = $this->Admin_model->getdoctorsof_dept($department->id); 
                                if(count($doctors)>0){
                            ?>
                            <?php foreach ($doctors as $doctor) : ?>
                                <!-- <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                    <div class="block block--style-1 list doctor-department-list">
                                        <div class="block-image">
                                            <div class="view view-fifth">
                                                <img src="<?= $doctor->icon ?>" width="133px" alt="<?= $doctor->name . '.jpg' ?>">
                                                
                                            </div>
                                        </div>
                                        <div class="block-content w-100">
                                            <div class="block-body py-1">
                                                <h3 class="heading heading-5 strong-500">
                                                    <a href="#" class="btn-st-trigger" data-effect="st-effect-1" id="">
                                                        <?= $doctor->name ?></a>
                                                </h3>
                                            </div>
                                            <div class="block-footer block-footer-fixed-bottom b-xs-top">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <ul class="social-media social-media--style-1-v4">
                                                            <?php if ($doctor->fb_link != '') : ?>
                                                                <li>

                                                                    <a href="<?= $doctor->fb_link ?>" target="_blank">
                                                                        <i class="ion ion-social-facebook"></i>
                                                                    </a>

                                                                </li>
                                                            <?php endif; ?>
                                                            <?php if ($doctor->twitter_link != '') : ?>
                                                                <li>
                                                                    <a href="<?= $doctor->twitter_link ?>" target="_blank">
                                                                        <i class="ion ion-social-twitter"></i>
                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>
                                                            <?php if ($doctor->googleplus_link != '') : ?>
                                                                <li>
                                                                    <a href="<?= $doctor->googleplus_link ?>" target="_blank">
                                                                        <i class="ion ion-social-googleplus"></i>
                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>
                                                            <?php if ($doctor->Linkedin_link != '') : ?>
                                                                <li>
                                                                    <a href="<?= $doctor->Linkedin_link ?>" target="_blank">
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
                                </div> -->
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                        <div class="block block--style-4 list doctor-list">
                                            <div class="block-image">
                                                <div class="view view-fifth">
                                                    <img class="img-fluid" style="width: 200px;height: 200px;" src="<?= $doctor->icon; ?>" alt="doctor.jpg">
                                                    <div class="mask">
                                                        <div class="view-buttons">
                                                            <span class="view-buttons-inner text-center appointment-btn">
                                                                <a href="" data-did="<?= $doctor->id; ?>" onclick="getavgrating(this)" id="<?= base_url('index.php/Home/doctorDetails/' . $doctor->id); ?>" class="btn btn-styled btn-base-1 btn-outline btn-icon-left btn-st-trigger" data-effect="st-effect-1">
                                                                    <i class="fa fa-user-md"></i> &nbsp;Profiles</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block-content w-100">
                                                <div class="block-body py-2 px-0">
                                                    <h3 class="heading heading-5 strong-500">
                                                        <a href="" class="btn-st-trigger" data-effect="st-effect-1" id="<?= base_url('index.php/Home/doctorDetails/' . $doctor->id); ?>">
                                                            <?= $doctor->name; ?> </a>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php endforeach; ?>
                            <?php } else { ?>
                                There are No Doctors for <?= $department->name ?> Department
                            <?php } ?>
                        </div>
                    </div>


                </div>
            </div>

        </div>

    </div>

</section>
<section class="slice-sm sct-color-2 b-xs-top b-xs-bottom appointment-cta">
    <div class="container">
        <div class="px-4">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-9">
                        <div class="text-center text-lg-left">
                            <h1 class="heading heading-4 text-normal strong-500 c-white">
                                Get In Touch With Our Specialists </h1>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="py-4 text-center text-lg-right">
                            <a href="<?= base_url('index.php/home/make_appointment'); ?>" class="btn btn-styled btn-base-1 btn-outline btn-icon-left">
                                <i class="fa fa-calendar"></i>Book Appointment </a>
                        </div>
                    </div>
                </div>
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