@extends(Backend/Receptionist/MainTemplate)
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
                            </div>
                            
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
        <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><span class="text-danger"><?= $patient['name']; ?>'s Detail</span></h5>

                </div>
                <div class="ibox-content">

                    <div>
                        <div class="feed-activity-list">

                            <table>
                                <tr>
                                    <td>
                                        <font size="4"><b>Email: </b></font>
                                    </td>
                                    <td>
                                        <p style="margin:2px 0 0 50px;"><?= $patient['email'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <font size="4"><b>Address: </b></font>
                                    </td>
                                    <td>
                                        <p style="margin:2px 0 0 50px;"><?= $patient['address'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <font size="4"><b>Age: </b></font>
                                    </td>
                                    <td>
                                        <p style="margin:2px 0 0 50px;"><?= $patient['age'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <font size="4"><b>Gender: </b></font>
                                    </td>
                                    <td>
                                        <p style="margin:2px 0 0 50px;"><?= $patient['gender'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <font size="4"><b>Blood Group: </b></font>
                                    </td>
                                    <td>
                                        <p style="margin:2px 0 0 50px;"><?= $patient['blood_group'] ?></p>
                                    </td>
                                </tr>
                                <tr>

                                    <td>
                                        <font size="4"><b>Phone: </b></font>

                                    </td>
                                    <td>
                                        <p style="margin:2px 0 0 50px;"><?= $patient['phone'] ?></p>
                                    </td>
                                </tr>
                            </table>


                            <p>


                            </p>
                            <p>


                            </p>
                            <p>


                            </p>
                            <p>


                            </p>
                            <p>

                            </p>

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