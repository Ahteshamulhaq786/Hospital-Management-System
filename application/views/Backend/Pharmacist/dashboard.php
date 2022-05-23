@extends(Backend/Pharmacist/MainTemplate)
@section(dashboardselected)
active
@endsection
@section(title)
Dashboard
@endsection
@section(stylelinks)
<link rel="stylesheet" href="<?= base_url('bootstrap_assets/bootstrap.min.css') ?>">
<link href="<?= base_url('doctor_assets/css/plugins/iCheck/custom.css') ?>" rel="stylesheet">
<link href="<?= base_url('doctor_assets/css/plugins/fullcalendar/fullcalendar.css') ?>" rel="stylesheet">
<link href="<?= base_url('doctor_assets/css/plugins/fullcalendar/fullcalendar.print.css') ?>" rel='stylesheet'
    media='print'>
@endsection

@section(alert)
<?php if ($this->session->has_userdata('success')) : ?>
<div class="alert alert-warning alert-dismissible mx-5">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p class="m-0">
        <?= $this->session->flashdata('success'); ?></p>
</div>
<?php endif; unset($_SESSION['success']); ?>
@endsection
@section(widgets)
<div
    class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
    <div class="mdc-card info-card info-card--success">
        <div class="card-inner">
            <h5 class="card-title">Total Medicines</h5>
            <h5 class="font-weight-light pb-2 mb-1 border-bottom"><?= $data->medicines; ?></h5>
            <p class="tx-12 text-muted">We'll Take Care Of Your Health</p>
            <div class="card-icon-wrapper">
            <i class="material-icons">attach_money</i>
            </div>
        </div>
    </div>
</div>
<div
    class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
    <div class="mdc-card info-card info-card--danger">
        <div class="card-inner">
            <h5 class="card-title">Total Orders</h5>
            <h5 class="font-weight-light pb-2 mb-1 border-bottom"><?= $data->order_medicines; ?></h5>
            <p class="tx-12 text-muted">Please Order & take medicine</p>
            <div class="card-icon-wrapper">
                <i class="material-icons">attach_money</i>
            </div>
        </div>
    </div>
</div>
<div
    class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
    <div class="mdc-card info-card info-card--primary">
        <div class="card-inner">
            <h5 class="card-title">Delivered Medicines</h5>
            <h5 class="font-weight-light pb-2 mb-1 border-bottom"><?= $data->delivered_medicines; ?></h5>
            <p class="tx-12 text-muted">Fast & Furious Service</p>
            <div class="card-icon-wrapper">
                <i class="material-icons">trending_up</i>
            </div>
        </div>
    </div>
</div>
<div
    class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
    <div class="mdc-card info-card info-card--info">
        <div class="card-inner">
            <h5 class="card-title">Total Sales Income</h5>
            <h5 class="font-weight-light pb-2 mb-1 border-bottom"><?= $data->total_Sales_income; ?></h5>
            <p class="tx-12 text-muted">87% target reached</p>
            <div class="card-icon-wrapper">
                <i class="material-icons">credit_card</i>
            </div>
        </div>
    </div>
</div>
@endsection

@section(content)

<div class="mdc-card">

    <div class="ibox-content">
        <div id="calendar"></div>
    </div>
</div>


@endsection

@section(scriptlinks)


<!-- jQuery library -->
<script src="<?= base_url('bootstrap_assets/jquery.min.js') ?>"></script>

<!-- Popper JS -->
<script src="<?= base_url('bootstrap_assets/popper.min.js') ?>"></script>

<!-- Latest compiled JavaScript -->
<script src="<?= base_url('bootstrap_assets/bootstrap.min.js') ?>"></script>

<!-- iCheck -->
<script src="<?= base_url('doctor_assets/js/plugins/iCheck/icheck.min.js') ?>"></script>
<script src="<?= base_url('doctor_assets/js/plugins/fullcalendar/moment.min.js') ?>"></script>
<script src="<?= base_url('doctor_assets/js/plugins/fullcalendar/fullcalendar.min.js') ?>"></script>
<script>
$(document).ready(function() {

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });

    /* initialize the external events
    -----------------------------------------------------------------*/


    $('#external-events div.external-event').each(function() {

        // store data so the calendar knows to render an event upon drop
        $(this).data('event', {
            title: $.trim($(this).text()), // use the element's text as the event title
            stick: true // maintain when user navigates (see docs on the renderEvent method)
        });

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 1111999,
            revert: true, // will cause the event to go back to its
            revertDuration: 0 //  original position after the drag
        });

    });


    /* initialize the calendar
    -----------------------------------------------------------------*/
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable: false,
        droppable: false, // this allows things to be dropped onto the calendar
        <?php
                         $path = $_SERVER['DOCUMENT_ROOT'];
                         $path .= "/Clinic-Automation-System/ajax/fetch.php";
                ?>
        events: <?php include_once($path); ?>,
    });


});
</script>

@endsection