@extends(Backend/Nurse/MainTemplate)

@section(ap)
active
@endsection

@section(title)
Assigned Patients
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
<!-- <link href="<?= base_url('pharmacist_assets/abc/stylee.css') ?>" rel="stylesheet"> -->
<link href="<?= base_url('pharmacist_assets/abc/modalimg.css') ?>" rel="stylesheet">
<!-- <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet"> -->
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



@endsection


@section(content)

<div class="row animated fadeInDown">
    <div class="col-lg-12">

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Assigned Patient</h5>

            </div>
            <div class="ibox-content">

                <div class="table-responsive">
                    <table id="example" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Nurse</th>
                                <th style="text-align: center;">Assigned Patient</th>
                                <th style="text-align: center;">Assigned By</th>
                                <th style="text-align: center;">Date & Time</th>
                                <th style="text-align: center;">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($records as $nurse) : ?>
                            <tr>
                                <td style="text-align: center;"><?= $this->Admin_model->getnurseby_id($nurse->nurse_id)->name; ?></td>
                                <td style="text-align: center;"><?= $this->Admin_model->getpatientby_id($nurse->patient_id)->name; ?></td>
                                <td style="text-align: center;"><?= $nurse->doctor_id==-1 ? 'Doctor Not Exists' : $this->Admin_model->getdoctorby_id($nurse->doctor_id)->name; ?></td>
                                <td style="text-align: center;"><?= date('D - d M Y', strtotime($this->Admin_model->getdate($nurse->date))) . ' ' . date('h:i:s a', strtotime($nurse->time)); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Actions
                                            <span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                            <li data-toggle="modal" data-target="#myModal2">
                                                <a class="btn" href="<?= base_url('index.php/nurse/patient_profile?pid=' . $nurse->patient_id); ?>">
                                                    <i class="fa fa-user"></i> &nbsp;
                                                    Patient Profile
                                                </a>

                                            </li>
                                            <li>
                                                <a class="btn" href="<?= base_url('index.php/nurse/prescription?pid=' . $nurse->patient_id) ?>">
                                                    <i class="fa fa-eye"></i> &nbsp;
                                                    View Medication History </a>
                                            </li>

                                            <li>
                                                <a class="btn" href="<?= base_url('index.php/nurse/report?pid=' . $nurse->patient_id) ?>">
                                                    <i class="fa fa-book"></i> &nbsp;
                                                    View Report </a>
                                            </li>
                                        </ul>
                                    </div>
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
@endsection