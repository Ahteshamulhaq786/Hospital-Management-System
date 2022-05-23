@extends(Frontend/MainTemplate)
@section(content)
<section class="slice--offset parallax-section parallax-section-xl b-xs-bottom custom-page-head" style="background-image: url('<?=base_url('assets/frontend/images/img-15.jpg'); ?>');">
    <div class="container">
        <div class="row py-3">
            <div class="col-lg-12">
                <h1 class="heading text-uppercase c-white">
                    About Us </h1>

                <span class="clearfix"></span>

                <div class="">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?=base_url('index.php'); ?>">
                                Home </a>
                        </li>
                        <li class="breadcrumb-item active">
                            About Us </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="slice sct-color-1 pb-0" id="scrollToSection">
    <div class="container no-padding">
        <div class="row row-no-padding">
            <div class="col-md-12">
                <div class="section-title section-title--style-1 text-center mb-4">
                    <h3 class="section-title-inner text-uppercase">
                        About Clinic Automation System </h3>
                    <span class="section-title-delimiter clearfix d-none"></span>
                </div>

                <span class="clearfix"></span>

                <div class="text-center">
                    <div class="fluid-paragraph fluid-paragraph-md c-gray-light about-text">
                    This system includes registration of patients, Doctors storing their details into the system, and also computerized billing in the pharmacy, and labs. The software has the facility to give a unique id for every patient and stores the clinical details of every patient and hospital tests done automatically. It includes a search facility to know the current status of each patient.<br><br><br><img alt="" src="<?=base_url('assets/frontend/images/Bottom-Banner-1.png'); ?>"><br><br><br>This system also provides medicines online. The data can be retrieved easily. The interface is very user-friendly. The data are well protected for personal use and makes the data processing very fast.
.<br><br> </div>
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

        <div class="fluid-paragraph fluid-paragraph-sm strong-300 text-center">
        The World Class service of our system is that the common man can easily get his check up done. </div>
    </div>
</section>

<section class="slice-xl sct-color-1">
    <div class="container">
        <div class="row-wrapper">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="icon-block icon-block--style-1-v2 block-icon-right block-icon-sm">
                        <div class="block-icon">
                            <img src="<?=base_url('assets/frontend/images/high-quality-services.png'); ?>" width="50">
                        </div>
                        <div class="block-content">
                            <h3 class="heading heading-5 strong-500">
                                High quality service </h3>
                            <br><br>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="icon-block icon-block--style-1-v2 block-icon-right block-icon-sm">
                        <div class="block-icon">
                            <img src="<?=base_url('assets/frontend/images/favicon.png'); ?>" width="50">
                        </div>
                        <div class="block-content">
                            <h3 class="heading heading-5 strong-500">
                                Modern hospital and technology </h3>
                           <br><br>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="icon-block icon-block--style-1-v2 block-icon-right block-icon-sm">
                        <div class="block-icon">
                            <img src="<?=base_url('assets/frontend/images/welcome.png'); ?>" width="50">
                        </div>
                        <div class="block-content">
                            <h3 class="heading heading-5 strong-500">
                                Ready for intervention </h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="icon-block icon-block--style-1-v2 block-icon-right block-icon-sm">
                        <div class="block-icon">
                            <img src="<?=base_url('assets/frontend/images/doctor.jpg'); ?>" width="50">
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
<section class="slice sct-color-2 b-xs-top b-xs-bottom">
    <div class="container">
        <div class="text-center">
            <div class="section-title section-title--style-1 text-center mb-4">
                <div class="mt-5">
                    <a href="<?=base_url('index.php/Home/make_appointment')?>" class="btn btn-styled btn-lg btn-base-1">
                        Make An Appointment </a>
                </div>
            </div>
        </div>
</section>
@endsection