@extends(Backend/Doctor/MainTemplate)
@section(pagetitle)
Patient Profile
@endsection
@section(stylelinks)
<link rel="stylesheet" href="<?= base_url('doctor_assets/rating/jquery.rateyo.css'); ?>">
@endsection
@section(content)
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profile Detail</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        <img alt="image" width="100%" class="img-responsive" src="<?= $patient['icon'] ?>">
                    </div>
                    <div class="ibox-content profile-content">
                        <h4><strong><?= $patient['name'] ?></strong></h4>
                        <p><i class="fa fa-map-marker"></i> <?= $patient['address'] ?></p>
                        <h5?>
                            <?= $patient['email'] ?>
                            </h5>
                            <div class="row m-t-lg">
                                <div class="col-md-4">
                                    <span class="bar">5,3,9,6,5,9,7,3,5,2</span>
                                    <h5><strong><?= $this->Admin_model->get_no_of_diagnosis_reports($_GET['pid']); ?></strong> Diagnosis</h5>
                                </div>
                                <div class="col-md-4">
                                    <span class="bar">5,3,9,6,5,9,7,3,5,2</span>
                                    <h5><strong><?= $this->Admin_model->get_no_of_prescriptions($_GET['pid']); ?></strong> Prescription</h5>
                                </div>
                                <div class="col-md-4">
                                    <span class="bar">5,3,2,-1,-3,-2,2,3,5,2</span>
                                    <h5><strong><?= $patient['feedbacks'] ?></strong> Total Feedbacks</h5>
                                </div>
                            </div>
                            <div class="user-button">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="<?= base_url('index.php/doctor/message'); ?>"><button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Send Message</button></a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>My Feedbacks</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div>
                        <div class="feed-activity-list">

                            <?php if (count($patient['myfeeds']) > 0) { ?>

                                <?php foreach ($patient['myfeeds'] as $feed) : ?>

                                    <div class="feed-element">
                                        <a href="#" class="pull-left">
                                            <img alt="image" class="img-circle" src="<?= $this->Admin_model->getpatientby_id($feed->patient_id)->icon; ?>">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right">

                                                <div class="rateYoMyfeed" data-did="<?= $feed->doctor_id; ?>" data-pid="<?= $feed->patient_id; ?>">
                                                </div>

                                            </small>
                                            <strong><?= $this->Admin_model->getpatientby_id($feed->patient_id)->name; ?></strong> posted Feedback on <strong>My</strong> Profile. <br>
                                            <small class="text-muted"><?= date('D h:i:s a - d.m.Y', strtotime($feed->created_at)); ?></small>
                                            <?php if ($feed->review != '') : ?>
                                                <div class="well">
                                                    <?= $feed->review; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php } else {
                                echo "No Feedbacks and Ratings given by" . $patient['name'] . " on My Profile";
                            } ?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Other Doctors Feedbacks given by <span class="text-danger"><?= $patient['name']; ?></span></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div>
                        <div class="feed-activity-list">
                            <?php if (count($patient['otherfeeds']) > 0) { ?>
                                <?php foreach ($patient['otherfeeds'] as $feed) : ?>

                                    <div class="feed-element">
                                        <a href="#" class="pull-left">
                                            <img alt="image" class="img-circle" src="<?= $this->Admin_model->getpatientby_id($feed->patient_id)->icon; ?>">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right">

                                                <div class="rateYoMyfeed" data-did="<?= $feed->doctor_id; ?>" data-pid="<?= $feed->patient_id; ?>">
                                                </div>

                                            </small>
                                            <strong><?= $this->Admin_model->getpatientby_id($feed->patient_id)->name; ?></strong> posted Feedback on <strong><?= $this->Admin_model->getdoctorby_id($feed->doctor_id)->name; ?></strong> Profile. <br>
                                            <small class="text-muted"><?= date('D h:i:s a - d.m.Y', strtotime($feed->created_at)); ?></small>

                                            <?php if (isset($feed->review)) : ?>
                                                <div class="well">
                                                    <?= $feed->review; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                <?php endforeach; ?>

                            <?php } else { ?>

                                <?= "No Feedbacks and Ratings given by " . $patient['name'] . " to other Doctors"; ?>

                            <?php } ?>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection

@section(scriptlinks)
<!-- Peity -->
<script src="<?= base_url('doctor_assets/js/plugins/peity/jquery.peity.min.js') ?>"></script>
<!-- Peity -->
<script src="<?= base_url('doctor_assets/js/demo/peity-demo.js') ?>"></script>
<script src="<?= base_url('doctor_assets/rating/jquery.rateyo.js'); ?>"></script>
<script>
    $(function() {
        $(".rateYoMyfeed").each(function(key, value) {
            var element = $(this);
            var did = element.data('did');
            var pid = element.data('pid');

            $.ajax({
                url: '<?= base_url('index.php/doctor/fetchstars'); ?>',
                type: 'POST',
                data: {
                    did: did,
                    pid: pid,
                },
                success: function(data) {
                    element.rateYo({
                        rating: data,
                        readOnly: true,
                        starWidth: "10px"
                    });
                }
            });

        });

    });
</script>

@endsection