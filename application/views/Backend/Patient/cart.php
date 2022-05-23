@extends(Backend/Patient/MainTemplate)
@section(cartselected)
active
@endsection
@section(pagetitle)
Buy Medicines
@endsection
@section(stylelinks)
@endsection
@section(content)
<div class="col-md-9" id="carted_items">
</div>
<div class="col-md-3" id="cart_summary">
</div>
</div>
@endsection

@section(scriptlinks)
<script>
    $(function() {
        fetch_carted_products();

        fetch_cart_summary();

        function fetch_cart_summary()
        {
            $.ajax({
                url : '<?= site_url('index.php/patient/fetch_cart_summary'); ?>',
                type : 'GET',
                success : function(data)
                {
                    $('#cart_summary').html(data);
                }
            });
        }

        function fetch_carted_products() {
            $.ajax({
                url: '<?= site_url('index.php/patient/get_carted_items'); ?>',
                type: 'GET',
                success: function(data) {
                    $('#carted_items').html(data);
                }
            });
        }
        $(document).on('click','.remcart',function(e){
            e.preventDefault();
            var m_id=$(this).data('mid');
            remove_cart_item(m_id);
            fetch_cart_summary();
        });

        function remove_cart_item(mid)
        {
            $.ajax({
                url : '<?= site_url('index.php/patient/rm_cart'); ?>',
                type : 'POST',
                data : {mid:mid},
                success : function(data)
                {
                    $('.ibox-'+mid).hide('fade');
                    refresh_cart();
                }
            });
        }

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
    });
</script>
@endsection