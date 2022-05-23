@extends(Backend/Patient/MainTemplate)
<<<<<<< HEAD
@section(medicinesselected)
=======
@section(buymedicinesselected)
>>>>>>> 6fb5300fc644392b3c138738e5ae7102603f5c89
active
@endsection
@section(pagetitle)
Buy Medicines
@endsection
@section(search)
<form role="search" class="navbar-form-custom" action="http://webapplayers.com/inspinia_admin-v2.7/search_results.html">
    <div class="form-group">
        <input type="text" autocomplete="off" placeholder="Search Medicines ... " class="form-control" name="top-search" id="top-search">
    </div>
</form>
@endsection
@section(stylelinks)
@endsection
@section(content)
<?php if(isset($_SESSION['failure'])): ?>
<div class="alert alert-info">
  <?= $_SESSION['failure']; unset($_SESSION['failure']) ?>
</div>
<?php endif; ?>
<div class="row" id="divMedicines">
    
</div>
</div>
@endsection

@section(scriptlinks)
<script>
    $(function() {

        refresh_cart();


        function refresh_cart()
        {
            $.ajax({
                url : '<?= site_url('index.php/patient/refresh_cart'); ?>',
                type : 'GET',
                success : function(data)
                {
                    $('#itemscart').html(data);
                }
            });
        }

        function addtocart(qty,medicine_id)
        {
            $.ajax({
                url : '<?= site_url('index.php/patient/addtocart'); ?>',
                type : 'POST',
                data : {qty:qty,med_id:medicine_id},
                success : function(data)
                {
                    alert(data);
                    refresh_cart();
                }
            });
        }
        $(document).on('click','.addcartbtn',function(e){
            e.preventDefault();
            var qty=$(this).parent().children("input").val();
            var medicine_id=$(this).data('medicine_id');
            if(qty=='')
            alert("Please Enter Qunatity for Cart");
            else if(qty==0 || qty<0)
            alert("Quantity Must be Greater than 0");
            else
            addtocart(qty,medicine_id);
        });

        render_all_medicines();

        $('#top-search').keyup(function() {
            var search_term = $(this).val();
            $.ajax({
                url: '<?= site_url('index.php/patient/render_medicines'); ?>',
                type: 'POST',
                data: {
                    medicine: search_term
                },
                success: function(data) {
                    $('#divMedicines').html(data);
                }
            });
        });

        function render_all_medicines()
        {
            $.ajax({
                url: '<?= site_url('index.php/patient/render_all_medicines'); ?>',
                type: 'GET',
                success: function(data) {
                    $('#divMedicines').html(data);
                }
            });
        }
    });
</script>
@endsection