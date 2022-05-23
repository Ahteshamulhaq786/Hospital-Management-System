@extends(Backend/Patient/MainTemplate)
@section(pagetitle)
Doctor Profile
@endsection
@section(profileselected)
active
@endsection
@section(stylelinks)
<link rel="stylesheet" href="<?= base_url('doctor_assets/rating/jquery.rateyo.css'); ?>">
@endsection
@section(content)
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Review and Star Rating</h4>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="email">Stars:</label>
                        <center>
                            <div id="rateYo"></div>
                            <div class="counter"></div>
                        </center>

                    </div>
                    <div class="form-group">
                        <label for="pwd">Post a Review:</label>
                        <textarea class="form-control" id="add-feedback-input" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success add-btn">Add</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="edtmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Review and Star Rating</h4>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="email">Stars:</label>
                        <center>
                            <div id="rateYo2"></div>
                            <div class="counter"></div>
                        </center>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Post a Review:</label>
                        <textarea class="form-control" id="edt-feedback-text" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning edt-btn">Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
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
    $(function () {
        fetch_doc_p();
        fetch_doc_ratings();
        var doc_id = 0;
        var pat_id = 0;
        var globalrating=0;
        function fetch_doc_p()
        {
            $.ajax({
                url : '<?= site_url('index.php/patient/fetch_doc_profile'); ?>',
                type : 'POST',
                data : {did:<?= $_GET['did']; ?>},
                success : function (data){
                    $('#pp').html(data);
                    $.ajax({
                        url : '<?= site_url('index.php/patient/fetch_avg_rating'); ?>',
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
                url: '<?= site_url('index.php/patient/fetch_all_ratings'); ?>',
                type: 'POST',
                data: {did: <?= $_GET['did']; ?>},
                success: function (data) {
                    $('.feed-activity-list').html(data);
                    $('.rateYo').each(function (key, value) {

                        var element = $(this);

                        doc_id = element.data('did');
                        pat_id = element.data('pid');

                        $.ajax({
                            url: '<?= site_url('index.php/patient/fetch_stars'); ?>',
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

        $(document).on('click','.edtrat',function (e){
            e.preventDefault();
            doc_id=$(this).data('ddoctorid');
            //call for no of stars given by patient to that doctor
            $.ajax({
                url : '<?= site_url('index.php/patient/fetch_stars2'); ?>',
                type : 'POST',
                data : {did:doc_id},
                success : function (data){
                    // globalrating=data;
                    var json_data=JSON.parse(data);
                    $('#edt-feedback-text').val(json_data.feedback);
                    $('#rateYo2').rateYo({
                        rating: json_data.stars,
                        numStars: 5,
                        precision: 2,
                        spacing: "10px",
                        starWidth: "30px",
                        onChange: function (rating, rateYoInstance) {
                            $(this).next().text(rating);
                        },
                        onSet: function (rating, rateYoInstance) {
                            globalrating=rating;
                            $(this).next().text(rating);
                            setstars();
                        }
                    });
                }
            });
        });
        $(document).on('click','.addrat',function (e){
            e.preventDefault();
            doc_id=$(this).data('ddoctorid');
            // console.log(globaldid);
            $('#rateYo').rateYo({
                rating: 0,
                numStars: 5,
                precision: 2,
                spacing: "10px",
                starWidth: "30px",
                onChange: function (rating, rateYoInstance) {
                    $(this).next().text(rating);
                },
                onSet: function (rating, rateYoInstance) {
                    globalrating=rating;
                    setstars();
                }
            });
        });

        function setstars()
        {
            // console.log(globaldid);
            $.ajax({
                url : '<?= site_url('index.php/patient/setstars'); ?>',
                type : 'POST',
                data : {did:doc_id,rating:globalrating},
                success : function (data){
                    alert(data);
                    fetch_doc_p();
                    fetch_doc_ratings();
                }
            });
        }

        $('.edt-btn').click(function (e){
            e.preventDefault();
            var txt=$('#edt-feedback-text').val();
            if(txt==''){
                alert('Please Enter Some Feedback about doctor');
            }else
            {
                addfeedback(txt,'#edtmodal');
            }
        });

        $('.add-btn').click(function (e){
            e.preventDefault();
            // console.log('add');
            var txt=$('#add-feedback-input').val();
            if(txt==''){
                alert('Please Enter Some Feedback about doctor');
            }else
            {
                addfeedback(txt,'#myModal');
            }
        });

        function addfeedback(txt,modal){
            $.ajax({
                url : '<?= site_url('index.php/patient/addfeedback') ?>',
                type : 'POST',
                data : {did:doc_id,feedback:txt},
                success : function(data){
                    if(data){
                        fetch_doc_p();
                        fetch_doc_ratings();
                        $(modal).modal('toggle');
                        alert(data);
                    }
                }
            });
        }
        $('#myModal').on('hidden.bs.modal', function () {
            // console.log('hides');
            // fetch_all_doctors();
            var $rateYo = $("#rateYo").rateYo();
            $rateYo.rateYo("destroy");
            $('#add-feedback-input').val('');
        });
        $('#edtmodal').on('hidden.bs.modal', function () {
            // console.log('hides');
            // fetch_all_doctors();
            var $rateYo = $("#rateYo2").rateYo();
            $rateYo.rateYo("destroy");
            $('#edt-feedback-text').val('');
        });
    });
</script>
@endsection