@extends(Backend/Doctor/MainTemplate)
@section(appointmentlistselected)
active
@endsection
@section(pagetitle)
Appointment
@endsection
@section(stylelinks)
<link href="<?= base_url('doctor_assets/css/plugins/dataTables/datatables.min.css') ?>" rel="stylesheet">
<!-- Sweet Alert -->
<link href="<?= base_url('doctor_assets/css/plugins/sweetalert/sweetalert.css')?>" rel="stylesheet">

@endsection

@section(content)

<div style="margin:10px;">
    <a href="<?= base_url('index.php/Doctor/addappointment') ?>">
        <button type="button" class="btn btn-w-m btn-primary">Add Appointment</button>
    </a>
</div>
<div class="row animated fadeInDown">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Appointment List</h5>
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
                                <th>Doctor</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($appointments as $appointment) : ?>
                            <tr>
                                <!-- <td><?= date('D - d M Y',strtotime($appointment->date)).' '.date('h:i:s a',strtotime($appointment->time ));?></td> -->

                                <td><?= date('D - d M Y',strtotime($this->Admin_model->getdate($appointment->date))).' '.date('h:i:s a',strtotime($appointment->time ));?></td>

                                <td><?= $this->Admin_model->getpatientby_id($appointment->patient_id)->name; ?></td>
                                <td><?= $this->Admin_model->getdoctorby_id($appointment->doctor_id)->name; ?></td>
                                <td>
                                <?php if($appointment->doctor_id==$_SESSION['PROFILE_ID']): ?>
                                    <a href="<?= site_url('index.php/doctor/edit_appointment/'.$appointment->id); ?>" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil"></i>&nbsp;
                                        Edit </a>
                                    <a href="<?= site_url('index.php/doctor/delete_appointment/'.$appointment->id); ?>" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i>&nbsp;
                                        Delete </a>
                                        <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                            </tfoot>
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