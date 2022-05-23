@extends(Backend/Doctor/MainTemplate)
@section(pagetitle)
My Feedbacks and Ratings
@endsection
@section(reviewratingselected)
active
@endsection
@section(stylelinks)
<link rel="stylesheet" href="<?= base_url('doctor_assets/rating/jquery.rateyo.css'); ?>">
@endsection
@section(content)
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-4" id="pp">

        </div>
        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Feedbacks & Ratings</h5>
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></div>
@endsection
@section(scriptlinks)
<!-- Peity -->
<script src="<?= base_url('doctor_assets/js/plugins/peity/jquery.peity.min.js') ?>"></script>

<!-- Peity -->
<script src="<?= base_url('doctor_assets/js/demo/peity-demo.js') ?>"></script>
<script src="<?= base_url('doctor_assets/rating/jquery.rateyo.js'); ?>"></script>
<script>
    $(function () {
        fetch_doc_p();
        fetch_doc_ratings();
        var doc_id = 0;
        var pat_id = 0;
        var globalrating=0;
        function fetch_doc_p()
        {
            $.ajax({
                url : '<?= site_url('index.php/doctor/fetch_doc_profile'); ?>',
                type : 'POST',
                data : {did:<?= $_GET['did']; ?>},
                success : function (data){
                    $('#pp').html(data);
                    $.ajax({
                        url : '<?= site_url('index.php/doctor/fetch_avg_rating'); ?>',
                        type : "POST",
                        data : {did:<?= $_GET['did']; ?>},
                        success:function (data){
                            $('#rateYoavg').rateYo({
                                rating: data,
                                numStars: 5,
                                starWidth: "21px",
                                readOnly: true,
                            });
                        }
                    });
                    // $('#rateYofordoctorprofile').rateYo({
                    //     rating: 3.6,
                    // });
                }
            });
        }

        function fetch_doc_ratings() {
            $.ajax({
                url: '<?= site_url('index.php/doctor/fetch_all_ratings'); ?>',
                type: 'POST',
                data: {did: <?= $_GET['did']; ?>},
                success: function (data) {
                    $('.feed-activity-list').html(data);
                    $('.rateYo').each(function (key, value) {

                        var element = $(this);

                        doc_id = element.data('did');
                        pat_id = element.data('pid');

                        $.ajax({
                            url: '<?= site_url('index.php/doctor/fetch_stars'); ?>',
                            type: 'POST',
                            data: {did: doc_id, pid: pat_id},
                            success: function (data) {
                                element.rateYo({
                                    rating: data,
                                    starWidth: "10px",
                                    precision: 2,
                                    readOnly: true,
                                    spacing: "2px"
                                });
                            }
                        });
                    });
                }
            });
        }
    });
</script>
@endsection