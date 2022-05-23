@extends(Backend/Doctor/MainTemplate)
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
</div>
@endsection

@section(scriptlinks)
<!-- Latest compiled and minified JavaScript -->
<script src="<?= base_url('doctor_assets/rating/jquery.rateyo.js'); ?>"></script>
<script>
    //Make sure that the dom is ready
    $(function () {

        fetch_all_doctors();

        // fetch_dept_doctors();

        // function fetch_dept_doctors()
        // {
        //     $.ajax({
        //         url : '<?= site_url('index.php/doctor/fetchdoctorsofDept'); ?>',
        //         type : 'POST',
        //         data : {startswith:'a'},
        //         success : function(data)
        //         {
        //             $('#doctors_list').html(data);
        //         }
        //     });
        // }

        function fetch_all_doctors() {
            $.ajax({
                url: '<?= site_url('index.php/doctor/fetchalldoctors'); ?>',
                type: 'POST',
                success: function (data) {
                    // console.log(data);
                    $('#doctors_list').html(data);
                    $('.avg-rating').each(function (key,value){
                        var element=$(this);
                        var did=element.data('did');
                        $.ajax({
                            url : '<?= site_url('index.php/doctor/fetch_avg_rating'); ?>',
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
    });
</script>
@endsection