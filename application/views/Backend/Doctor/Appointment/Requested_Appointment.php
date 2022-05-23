@extends(Backend/Doctor/MainTemplate)
@section(requestedappointmentsselected)
active
@endsection
@section(pagetitle)
Requested Appointments
@endsection
@section(stylelinks)
<link href="<?= base_url('doctor_assets/css/plugins/dataTables/datatables.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('doctor_assets/css/plugins/sweetalert/sweetalert.css')?>" rel="stylesheet">
@endsection
@section(content)
<div class="row animated fadeInDown">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Requested Appointments</h5>
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
                <table class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointments as $appointment) : ?>
                            <tr>
                            <td><?= date('D - d M Y',strtotime($this->Admin_model->getdate($appointment->date))).' '.date('h:i:s a',strtotime($appointment->time ));?></td>
                            
                                <td><?= $this->Admin_model->getpatientby_id($appointment->patient_id)->name; ?></td>
                                <td><?= $this->Admin_model->getdoctorby_id($appointment->doctor_id)->name; ?></td>
                                <td>
                                <?php if($appointment->doctor_id==$_SESSION['PROFILE_ID']): ?>
                                    <a href="<?= site_url('index.php/doctor/edit_req_appointment/' . $appointment->id); ?>" class="btn btn-primary btn-sm">
                                        <i class="fa fa-pencil"></i>&nbsp;
                                        Approve </a>
                                    <a href="<?= site_url('index.php/doctor/delete_req_appointment/' . $appointment->id); ?>" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i>&nbsp;
                                        Delete </a>

                                <?php endif; ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                </table>

            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section(scriptlinks)
<script src="<?= base_url('doctor_assets/js/plugins/dataTables/datatables.min.js') ?>"></script>
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
<!-- iCheck -->
<script src="<?= base_url('doctor_assets/js/plugins/sweetalert/sweetalert.min.js')?>"></script>

<?php if($this->session->has_userdata('success')): ?>
    <script>

        $(document).ready(function (){
            swal({
                title: "<?= $this->session->flashdata('success');?>",
                text: "Please Check Your Profile",
                type: "success"
            });
        });

    </script>
<?php endif; unset($_SESSION['success']); ?>

@endsection