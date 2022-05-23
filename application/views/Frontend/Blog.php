@extends(Frontend/MainTemplate)
@section(content)
<section class="slice--offset parallax-section parallax-section-xl b-xs-bottom custom-page-head" style="background-image: url('<?=base_url('assets/frontend/images/img-15.jpg'); ?>');">
    <div class="container">
        <div class="row py-3">
            <div class="col-lg-12">
                <h1 class="heading text-uppercase c-white">
                    Blog </h1>

                <span class="clearfix"></span>

                <div class="">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?=base_url('index.php'); ?>">
                                Home </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Blog </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="slice sct-color-1">
    <div class="container">
        <div class="row masonry">
            <div class="masonry-item col-sm-6 col-md-4">
                <div class="block block--style-3">
                    <div class="block-image relative">
                        <div class="">
                            <a href="<?=base_url('index.php/Home/department')?>">
                                <img src="<?=base_url('assets/frontend/images/doctor.jpg'); ?>">
                            </a>
                        </div>
                    </div>
                    <div class="block-body">
                        <h3 class="heading heading-5 strong-500">
                            <a href="<?=base_url('index.php/Home/department')?>">
                                Why employer healthcare strategies must be local one </a>
                        </h3>
                        <p>
                            The best employers care not only about their employees’ productivity, but their well-being. And if you’re heading up a large company that employs ...
                        </p>
                    </div>
                    <div class="block-footer b-xs-top">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <ul class="inline-links inline-links--style-3">
                                    <li>
                                        <i class="fa fa-calendar"></i> 20 Oct, 2017 </li>
                                </ul>
                            </div>
                            <div class="col-6 text-right">
                                <a href="<?=base_url('index.php/Home/department')?>" class="link link-sm link--style-2">
                                    <i class="fa fa-long-arrow-right"></i> Read More </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="masonry-item col-sm-6 col-md-4">
                <div class="block block--style-3">
                    <div class="block-image relative">
                        <div class="">
                            <a href="<?=base_url('index.php/Home/department')?>">
                                <img src="<?=base_url('assets/frontend/images/doctor.jpg'); ?>">
                            </a>
                        </div>
                    </div>
                    <div class="block-body">
                        <h3 class="heading heading-5 strong-500">
                            <a href="<?=base_url('index.php/Home/department')?>">
                                Why employer healthcare strategies must be local two </a>
                        </h3>
                        <p>
                            The best employers care not only about their employees’ productivity, but their well-being. And if you’re heading up a large company that employs ...
                        </p>
                    </div>
                    <div class="block-footer b-xs-top">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <ul class="inline-links inline-links--style-3">
                                    <li>
                                        <i class="fa fa-calendar"></i> 20 Oct, 2017 </li>
                                </ul>
                            </div>
                            <div class="col-6 text-right">
                                <a href="<?=base_url('index.php/Home/department')?>" class="link link-sm link--style-2">
                                    <i class="fa fa-long-arrow-right"></i> Read More </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="masonry-item col-sm-6 col-md-4">
                <div class="block block--style-3">
                    <div class="block-image relative">
                        <div class="">
                            <a href=<?=base_url('index.php/Home/department')?>">
                                <img src="<?=base_url('assets/frontend/images/doctor.jpg'); ?>">
                            </a>
                        </div>
                    </div>
                    <div class="block-body">
                        <h3 class="heading heading-5 strong-500">
                            <a href="<?=base_url('index.php/Home/department')?>">
                                Why employer healthcare strategies must be local three </a>
                        </h3>
                        <p>
                            The best employers care not only about their employees’ productivity, but their well-being. And if you’re heading up a large company that employs ...
                        </p>
                    </div>
                    <div class="block-footer b-xs-top">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <ul class="inline-links inline-links--style-3">
                                    <li>
                                        <i class="fa fa-calendar"></i> 20 Oct, 2017 </li>
                                </ul>
                            </div>
                            <div class="col-6 text-right">
                                <a href="https://creativeitem.com/demo/bayanno/index.php/home/blog_details/4" class="link link-sm link--style-2">
                                    <i class="fa fa-long-arrow-right"></i> Read More </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center pt-5">
        </div>
    </div>
</section>
@endsection