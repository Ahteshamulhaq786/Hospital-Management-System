@extends(Backend/Doctor/MainTemplate)
@section(assignnurseselected)
active
@endsection
@section(pagetitle)
Assign Nurses
@endsection
@section(stylelinks)
<link href="<?= base_url('doctor_assets/css/plugins/dataTables/datatables.min.css') ?>" rel="stylesheet">
<!-- Sweet Alert -->
<link href="<?= base_url('doctor_assets/css/plugins/sweetalert/sweetalert.css')?>" rel="stylesheet">

@endsection

@section(content)

<div style="margin:10px;">
    <a href="<?= base_url('index.php/Doctor/assign_nurses') ?>">
        <button type="button" class="btn btn-w-m btn-primary">Assign Nurses</button>
    </a>
</div>
<div class="row animated fadeInDown">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Assign Nurses to Patients</h5>
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
                                <th>Date & Time</th>
                                <th>Patient</th>
                                <th>Nurse</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($records as $nurse) : ?>
                            <tr>
                            <td><?= date('D - d M Y', strtotime($this->Admin_model->getdate($nurse->date))) . ' ' . date('h:i:s a', strtotime($nurse->time)); ?>
                                <td><?= $this->Admin_model->getpatientby_id($nurse->patient_id)->name; ?></td>
                                <td><?= $this->Admin_model->getnurseby_id($nurse->nurse_id)->name; ?></td>
                                <td>
                                    <a href="<?= site_url('index.php/doctor/edit_assign_nurses/'.$nurse->id); ?>" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil"></i>&nbsp;
                                        Edit </a>
                                    <a href="<?= site_url('index.php/doctor/delete_assign_nurses/'.$nurse->id); ?>" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i>&nbsp;
                                        Delete </a>
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