@extends(Backend/Doctor/MainTemplate)
@section(reportselected)
active
@endsection
@section(pagetitle)
Reports
@endsection
@section(stylelinks)
<link href="<?= base_url('doctor_assets/css/plugins/dataTables/datatables.min.css') ?>" rel="stylesheet">
<!-- Sweet Alert -->
<link href="<?= base_url('doctor_assets/css/plugins/sweetalert/sweetalert.css')?>" rel="stylesheet">


@endsection
@section(content)
<div style="margin:10px;">
    <a href="<?= base_url('index.php/Doctor/addreport') ?>">
        <button type="button" class="btn btn-w-m btn-primary">Add Report</button>
    </a>
</div>
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <i class="fa fa-laptop modal-icon"></i>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>File Name</th>
                            <th>Options</th>
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


<div class="row animated fadeInDown">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Operation Reports</h5>
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
                                <th>Doctor</th>
                                <th>Patient</th>
                                <th>Description</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reports->operation as $opr_report) : ?>
                            <tr>
                                <td><?= $opr_report->date; ?></td>
                                <td><?= $opr_report->doctor_id==-1 ? 'Doctor Not Exists' : $this->Admin_model->getdoctorby_id($opr_report->doctor_id)->name; ?></td>
                                <td><?= $this->Admin_model->getpatientby_id($opr_report->patient_id)->name; ?></td>
                                <td><?= $opr_report->description; ?></td>
                                <td>
                                
                                

                                <?php if($opr_report->doctor_id==$_SESSION['PROFILE_ID']): ?>
                                    <a href="<?= site_url('index.php/doctor/edit_report/' . $opr_report->id); ?>"
                                        class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil"></i>&nbsp;
                                        Edit </a>

                                        <a data-toggle="modal" data-target="#myModal"
                                        data-report-id="<?= $opr_report->id; ?>"
                                        class="btn btn-default btn-sm view view_report">
                                        <i class="fa fa-eye"></i>&nbsp;
                                        View</a>
                                    

                                    <a href="<?= site_url('index.php/doctor/delete_report/' . $opr_report->id); ?>"
                                        class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i>&nbsp;
                                        Delete </a>
                                        <?php endif; ?>
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


<div class="row animated fadeInDown">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Birth Reports</h5>
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
                                <th>Doctor</th>
                                <th>Patient</th>
                                <th>Description</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reports->birth as $opr_report) : ?>
                            <tr>
                                <td><?= $opr_report->date; ?></td>
                                <td><?= $opr_report->doctor_id==-1 ? 'Doctor Not Exists' :  $this->Admin_model->getdoctorby_id($opr_report->doctor_id)->name; ?></td>
                                <td><?= $this->Admin_model->getpatientby_id($opr_report->patient_id)->name; ?></td>
                                <td><?= $opr_report->description; ?></td>
                                <td>
                                
                                <?php if($opr_report->doctor_id==$_SESSION['PROFILE_ID']): ?>
                                    <a href="<?= site_url('index.php/doctor/edit_report/' . $opr_report->id); ?>"
                                        class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil"></i>&nbsp;
                                        Edit </a>

                                        <a data-toggle="modal" data-target="#myModal"
                                        data-report-id="<?= $opr_report->id; ?>"
                                        class="btn btn-default btn-sm view view_report">
                                        <i class="fa fa-eye"></i>&nbsp;
                                        View</a>
                                    
                                    <a href="<?= site_url('index.php/doctor/delete_report/' . $opr_report->id); ?>"
                                        class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i>&nbsp;
                                        Delete </a>
                                        <?php endif; ?>
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

<div class="row animated fadeInDown">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Death Reports</h5>
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
                                <th>Doctor</th>
                                <th>Patient</th>
                                <th>Description</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reports->death as $opr_report) : ?>
                            <tr>
                                <td><?= $opr_report->date; ?></td>
                                <td><?= $opr_report->doctor_id==-1 ? 'Doctor Not Exists' :  $this->Admin_model->getdoctorby_id($opr_report->doctor_id)->name; ?></td>
                                <td><?= $this->Admin_model->getpatientby_id($opr_report->patient_id)->name; ?></td>
                                <td><?= $opr_report->description; ?></td>
                                <td>
                                
                                <?php if($opr_report->doctor_id==$_SESSION['PROFILE_ID']): ?>
                                    <a href="<?= site_url('index.php/doctor/edit_report/' . $opr_report->id); ?>"
                                        class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil"></i>&nbsp;
                                        Edit </a>

                                        <a data-toggle="modal" data-target="#myModal"
                                        data-report-id="<?= $opr_report->id; ?>"
                                        class="btn btn-default btn-sm view view_report">
                                        <i class="fa fa-eye"></i>&nbsp;
                                        View</a>
                                    
                                    <a href="<?= site_url('index.php/doctor/delete_report/' . $opr_report->id); ?>"
                                        class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i>&nbsp;
                                        Delete </a>
                                        <?php endif; ?>
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
            url: '<?= base_url('index.php/doctor/fetch_report'); ?>', 
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
@endsection