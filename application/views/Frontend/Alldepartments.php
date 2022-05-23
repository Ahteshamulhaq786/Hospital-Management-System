@extends(Frontend/MainTemplate)
@section(content)
<section class="slice--offset parallax-section parallax-section-xl b-xs-bottom custom-page-head" style="background-image: url('<?= base_url('assets/frontend/images/img-15.jpg'); ?>');">
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
                    </ol>
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
@endsection