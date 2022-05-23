@extends(Backend/Nurse/MainTemplate)
<!-- @section(dashboardselected)
active
@endsection -->
@section(title)
Report
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
@section(stylelinks)

<link href="<?= base_url('pharmacist_assets/abc/jquery.dataTables.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('pharmacist_assets/abc/stylee.css') ?>" rel="stylesheet">
<link href="<?= base_url('pharmacist_assets/abc/modalimg.css') ?>" rel="stylesheet">

<link rel="stylesheet" href="<?= base_url('assets/offline-links/Nurse/jquery.dataTables.min.css'); ?>">
<!-- <link href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="<?= base_url('assets/offline-links/Nurse/buttons.dataTables.min.css'); ?>">
<!-- <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="<?= base_url('assets/offline-links/Nurse/jquery2.dataTables.min.css'); ?>">
<!-- <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet"> -->

<!-- <link href="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="<?= base_url('assets/offline-links/Nurse//bootstrap-table.min.css'); ?>">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> -->
<link rel="stylesheet" href="<?= base_url('assets/offline-links/Nurse/bootstrap.min.css'); ?>">
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script> -->
<script src="<?= base_url('assets/offline-links/Nurse/jquery-3.5.1.slim.min.js') ?>"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script> -->
<script src="<?= base_url('assets/offline-links/Nurse/bootstrap.bundle.min.js') ?>"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">



@endsection


@section(content)

<div style="margin-bottom:10px;">
    <a href="<?= base_url('index.php/Nurse/assigned_patients') ?>">
        <button type="button" class="btn btn-w-m btn-primary">Back</button>
    </a>
</div>

<div class="row animated fadeInDown">
    <div class="col-lg-12">

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Assigned Patient's Reports</h5>

            </div>
            <div class="ibox-content">

                <div class="table-responsive">
                    <table id="example" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Date</th>
                                <th style="text-align: center;">Patient</th>
                                <th style="text-align: center;">Report Type</th>
                                <th style="text-align: center;">Description</th>
                                <th style="text-align: center;">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reports as $opr_report) : ?>
                            <tr>
                                <td style="text-align: center;"><?= $opr_report->date; ?></td>
                                <td style="text-align: center;">
                                    <?= $this->Admin_model->getpatientby_id($opr_report->patient_id)->name; ?></td>
                                <td style="text-align: center;"><?= $opr_report->type; ?></td>
                                <td style="text-align: center;"><?= $opr_report->description; ?></td>
                                <td style="text-align: center;">
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            
                                            <a data-toggle="modal" data-target="#myModal"
                                                data-report-id="<?= $opr_report->id; ?>"
                                                class="btn btn-primary view view_report">
                                                <i class="fa fa-eye"></i>&nbsp;
                                                View</a>
                                            
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Diagnosis Reports</h5>

            </div>
            <div class="ibox-content">

                <div class="table-responsive">
                    <table id="example1" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Date</th>
                                <th style="text-align: center;">Patient</th>
                                <th style="text-align: center;">Report Type</th>
                                <th style="text-align: center;">Document Type</th>
                                <th style="text-align: center;">Description</th>
                                <th style="text-align: center;">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($diagnosis as $opr_report) : ?>
                            <tr>
                                <td style="text-align: center;"><?= $opr_report->date . ' ' . date('h:i:s A', strtotime($opr_report->time)); ?></td>
                                <td style="text-align: center;">
                                    <?= $this->Admin_model->getpatientby_id($opr_report->patient_id)->name; ?></td>
                                <td style="text-align: center;"><?= $opr_report->report_type; ?></td>
                                <td style="text-align: center;"><?= $opr_report->report_file_type; ?></td>
                                <td style="text-align: center;"><?= $opr_report->description; ?></td>
                                <td style="text-align: center;">
                                            
                                            <a style="text-align:center;"

                                            href="<?= base_url('index.php/nurse/download_diagnosis_report?file='.$opr_report->report_file); ?>"
                                                class="btn btn-primary view view_report">
                                                <i class="fa fa-download"></i>&nbsp;
                                                Download</a>
                                            
                                    
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<!-- Modal -->
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h4 class="modal-title">Report Download</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: center;">File Name</th>
                            <th style="text-align: center;">Options</th>
                        </tr>
                    </thead>
                    <tbody id="report-data">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section(scriptlinks)
<script>
$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script>
<script>
$(document).ready(function() {
    $('#example1').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script>
<script>
$(document).ready(function() {
    $('#example2').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="<?= base_url('assets/offline-links/Nurse/jquery-3.5.1.js') ?>"></script>
<!-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> -->
<script src="<?= base_url('assets/offline-links/Nurse/jquery2.dataTables.min.js') ?>"></script>
<!-- <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script> -->
<script src="<?= base_url('assets/offline-links/Nurse/dataTables.buttons.min.js') ?>"></script>
<!-- <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script> -->
<script src="<?= base_url('assets/offline-links/Nurse/buttons.flash.min.js') ?>"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> -->
<script src="<?= base_url('assets/offline-links/Nurse/jszip.min.js') ?>"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> -->
<script src="<?= base_url('assets/offline-links/Nurse/pdfmake.min.js') ?>"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> -->
<script src="<?= base_url('assets/offline-links/Nurse/vfs_fonts.js') ?>"></script>
<!-- <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script> -->
<script src="<?= base_url('assets/offline-links/Nurse/buttons.html5.min.js') ?>"></script>
<!-- <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script> -->
<script src="<?= base_url('assets/offline-links/Nurse/buttons.print.min.js') ?>"></script>


<!-- <script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.js"></script> -->
<script src="<?= base_url('assets/offline-links/Nurse/bootstrap-table.min.js') ?>"></script>
<script>
var $table = $('#table')

$(function() {
    $('#modalTable').on('shown.bs.modal', function() {
        $table.bootstrapTable('resetView')
    })
})
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('.view_report').click(function() {
        var id = $(this).data('report-id');
        get_report(id);
    });

    function get_report(id) {
        $.ajax({
            url: '<?= base_url('index.php/nurse/fetch_report'); ?>',
            type: "POST",
            data: {
                id: id
            },
            success: function(data) {
                $('#report-data').html(data);
            }
        });
    }
});
</script>
<?php if($this->session->has_userdata('success')): ?>

<?php endif; unset($_SESSION['success']); ?>
@endsection