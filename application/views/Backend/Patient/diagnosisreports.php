@extends(Backend/Patient/MainTemplate)
@section(diagnosisreportselected)
active
@endsection
@section(pagetitle)
Diagnosis Reports
@endsection
@section(stylelinks)
<link href="<?= base_url('doctor_assets/css/plugins/dataTables/datatables.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('doctor_assets/css/plugins/iCheck/custom.css') ?>" rel="stylesheet">
<link href="<?= base_url('doctor_assets/css/plugins/fullcalendar/fullcalendar.css') ?>" rel="stylesheet">
<link href="<?= base_url('doctor_assets/css/plugins/fullcalendar/fullcalendar.print.css') ?>" rel='stylesheet' media='print'>
<link href="<?= base_url('doctor_assets/css/plugins/sweetalert/sweetalert.css') ?>" rel="stylesheet">
@endsection
@section(content)
<div class="modal inmodal" id="diagnosisreport" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Clinic Automation System</h4>

            </div>
            <div class="modal-body" id="diagnosis_modal">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <a id="print_diagnosis" class="btn btn-primary hidden-print">
                    <i class="fa fa-print"></i>&nbsp;
                    Print Diagnosis Reports </a>
            </div>
        </div>
    </div>
</div>


<div class="row animated fadeInDown">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Diagnosis Reports</h5>
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

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Patient</th>
                                <th>Added by</th>
                                <th>Description</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reports as $opr_report) : ?>
                            <tr>
                                <td><?= $opr_report->date; ?></td>
                                <td><?= $this->Admin_model->getpatientby_id($opr_report->patient_id)->name; ?></td>
                                <td>
                                    <?= $opr_report->doctor_id==0 ? 'Laboratorist' : 'Doctor'; ?>
                                </td>
                                <td><?= $opr_report->description; ?></td>
                                <td>
                                <a class="btn btn-default btn-sm view-diagnosis" data-toggle="modal" data-target="#diagnosisreport" data-id="<?= $opr_report->patient_id; ?>">
                                        <i class="fa fa-eye"></i>&nbsp;
                                        View Diagnosis Report </a>
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
@endsection

@section(scriptlinks)
<script src="<?= base_url('doctor_assets/js/plugins/dataTables/datatables.min.js') ?>"></script>

<!-- Sweet alert -->
<script src="<?= base_url('doctor_assets/js/plugins/sweetalert/sweetalert.min.js')?>"></script>

<?php if($this->session->has_userdata('success')): ?>
<script>
$(document).ready(function() {
    swal({
        title: "<?= $this->session->flashdata('success');?>",
        text: "Please Check Your Profile",
        type: "success"
    });
});
</script>
<?php endif; unset($_SESSION['success']); ?>
<script>
$(document).ready(function() {
    $('.dataTables-example').DataTable({
        pageLength: 25,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv'
            },
            {
                extend: 'excel',
                title: 'ExampleFile'
            },
            {
                extend: 'pdf',
                title: 'ExampleFile'
            },

            {
                extend: 'print',
                customize: function(win) {
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            }
        ]

    });

});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('.view_report').click(function() {
        var id = $(this).data('report-id');
        get_report(id);
    });

    function get_report(id) {
        $.ajax({
            url: '<?= base_url('index.php/patient/fetch_report'); ?>', 
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
<script type="text/javascript" src="<?= base_url('admin_assets/plugins/jQuery-Plugin-To-Print-Any-Part-Of-Your-Page-Print/jQuery.print.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('.view-diagnosis').on('click', function(e) {
            e.preventDefault();
            var pid = $(this).data('id');
            get_diagnosis(pid);
        });

        $('#print_diagnosis').click(function(e) {
            e.preventDefault();
            jQuery('#diagnosis_modal').print();
        });

        function get_diagnosis(id) {
            $.ajax({
                url: '<?= site_url('index.php/patient/finddiagnosis'); ?>',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#diagnosis_modal').html(data);
                }
            });
        }
    });
</script>
@endsection