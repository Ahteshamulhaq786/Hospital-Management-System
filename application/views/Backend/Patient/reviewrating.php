@extends(Backend/Patient/MainTemplate)
@section(reviewratingselected)
active
@endsection
@section(pagetitle)
Review & Rating
@endsection
@section(stylelinks)
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?= base_url('doctor_assets/rating/jquery.rateyo.css'); ?>">
@endsection
@section(content)
<div class="row" id="doctors_list">
</div>
<!-- Modal -->
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
</div>
@endsection

@section(scriptlinks)
<!-- Latest compiled and minified JavaScript -->
<script src="<?= base_url('doctor_assets/rating/jquery.rateyo.js'); ?>"></script>
<script>
    //Make sure that the dom is ready
    $(function () {

        var globalrating=0;
        var globaldid=0;

        fetch_all_doctors();
        function fetch_all_doctors() {
            $.ajax({
                url: '<?= site_url('index.php/patient/fetchalldoctors'); ?>',
                type: 'GET',
                success: function (data) {
                    // console.log(data);
                    $('#doctors_list').html(data);
                    $('.avg-rating').each(function (key,value){
                        var element=$(this);
                        var did=element.data('did');
                        $.ajax({
                            url : '<?= site_url('index.php/patient/fetch_avg_rating'); ?>',
                            type : "POST",
                            data : {did:did},
                            success:function (data){
                                element.rateYo({
                                    rating: data,
                                    numStars: 5,
                                    starWidth: "21px",
                                    readOnly: true,
                                });
                            }
                        });
                    });
                }
            });

        }

        $('.add-btn').click(function (e){
            e.preventDefault();
            var txt=$('#add-feedback-input').val();
            if(txt==''){
                alert('Please Enter Some Feedback about doctor');
            }else
            {
                addfeedback(txt,'#myModal');
            }
        });

        $(document).on('click','.addrat',function (e){
            e.preventDefault();
            globaldid=$(this).data('ddoctorid');
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

        $(document).on('click','.edtrat',function (e){
            e.preventDefault();
            globaldid=$(this).data('ddoctorid');
            //call for no of stars given by patient to that doctor
            $.ajax({
                url : '<?= site_url('index.php/patient/fetch_stars2'); ?>',
                type : 'POST',
                data : {did:globaldid},
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
        function setstars()
        {
            // console.log(globaldid);
            $.ajax({
                url : '<?= site_url('index.php/patient/setstars'); ?>',
                type : 'POST',
                data : {did:globaldid,rating:globalrating},
                success : function (data){
                    alert(data);
                    fetch_all_doctors();
                }
            });
        }
        $('#myModal').on('hidden.bs.modal', function () {
            var $rateYo = $("#rateYo").rateYo();
            $rateYo.rateYo("destroy");
            $('#add-feedback-input').val('');
        });

        $('#edtmodal').on('hidden.bs.modal', function () {
            var $rateYo = $("#rateYo2").rateYo();
            $rateYo.rateYo("destroy");
            $('#edt-feedback-text').val('');
        });

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

        function addfeedback(txt,modal){
            $.ajax({
                url : '<?= site_url('index.php/patient/addfeedback') ?>',
                type : 'POST',
                data : {did:globaldid,feedback:txt},
                success : function(data){
                        if(data){
                            fetch_all_doctors();
                            $(modal).modal('toggle');
                            alert(data);
                        }
                }
            });
        }
    });
</script>
@endsection