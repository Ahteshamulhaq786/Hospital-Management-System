@extends(Frontend/MainTemplate)
@section(content)
<section class="slice--offset parallax-section parallax-section-xl b-xs-bottom custom-page-head" style="background-image: url('<?=base_url('assets/frontend/images/img-15.jpg'); ?>');">
    <div class="container">
        <div class="row py-3">
            <div class="col-lg-12">
                <h1 class="heading text-uppercase c-white">
                    All Departments </h1>

                <span class="clearfix"></span>

                <div class="">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>">
                                Home </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Departments </li>
                        <li class="breadcrumb-item active">
                            Dept Name </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="slice sct-color-1">
    <div class="container">


        <div class="row justify-content-center pt-5">
        </div>
    </div>
</section>
@endsection