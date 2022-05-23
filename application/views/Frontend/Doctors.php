@extends(Frontend/MainTemplate)
@section(links)
<link rel="stylesheet" href="<?= base_url('doctor_assets/rating/jquery.rateyo.css') ?>">
@endsection
@section(content)
<section class="slice--offset parallax-section parallax-section-xl b-xs-bottom custom-page-head" style="background-image: url('<?= base_url('assets/frontend/images/img-15.jpg'); ?>');">
    <div class="container">
        <div class="row py-3">
            <div class="col-lg-12">
                <h1 class="heading text-uppercase c-white">
                    Doctors Of All Departments </h1>

                <span class="clearfix"></span>

                <div class="">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= site_url('index.php'); ?>">
                                Home </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Doctors </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="slice--offset sct-color-1 pt-4 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="sidebar sidebar--style-2 doctor-sidebar">
                    <div class="sidebar-object">
                        <div class="section-title section-title--style-1">
                            <h3 class="section-title-inner heading-sm strong-500">
                                Doctors Of </h3>
                        </div>
                        <ul class="categories categories--style-2">
                            <li class="<?= $dept_id == 0 ? 'active' : '' ?>">
                                <a href="<?= site_url('index.php/home/doctors'); ?>">
                                    All Departments </a>
                            </li>
                            <?php foreach ($departments as $department) : ?>
                                <li class="<?= $department->id == $dept_id ? 'active' : '' ?>">
                                    <a href="<?= site_url('index.php/home/doctors/' . $department->id); ?>">
                                        <?= $department->name ?> </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="block block-post">
                    <div class="block department-doctor-list">
                        <div class="doctor-grid-view row">
                            <?php if (count($doctors) > 0) { ?>
                                <?php foreach ($doctors as $doctor) : ?>
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
                                <div class="alert alert-danger alert-dismissible fade show m-0 w-100 m-3" role="alert">
                                There are no Doctors in that department
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="doctor-pagination d-flex justify-content-center mb-4 pt-4">
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
                            <a href="<?= base_url('index.php/Home/make_appointment') ?>" class="btn btn-styled btn-base-1 btn-outline btn-icon-left">
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