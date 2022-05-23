@extends(Backend/Nurse/MainTemplate)
<!-- @section(assignedpatientselected)
active
@endsection -->
@section(title)
Medication History
@endsection
@section(alert)
<?php if ($this->session->has_userdata('success')) : ?>
    <div class="alert alert-warning alert-dismissible mx-5">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p class="m-0">
            <?= $this->session->flashdata('success'); ?></p>
    </div>
<?php endif;
unset($_SESSION['success']); ?>
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
                <h5>Medication History</h5>

            </div>
            <div class="ibox-content">
                <?php foreach ($prescriptions as $prescription) : ?>
                    <div class="wrapper wrapper-content p-xl">
                        <div class="ibox-content p-xl">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5>Doctor: <span style="font-size: small;" class="text-danger"><?= $prescription->doctor_id==-1 ? 'Doctor Not Exists' : $this->Admin_model->getdoctorby_id($prescription->doctor_id)->name; ?></span></h5>
                                    <address>
                                        <span><strong>Date: </strong> <?= $prescription->date ?></span><br>
                                        <span><strong>Time: </strong> <?= date('h:i:s A', strtotime($prescription->time)) ?></span>
                                        <br>
                                    </address>
                                </div>

                                <div class="col-sm-6 text-right">

                                    <h4 class="text-navy">Patient: <?= $this->Admin_model->getpatientby_id($prescription->patient_id)->name; ?></h4>

                                    <p>
                                        <span><strong>Age:</strong> <?= $this->Admin_model->getpatientby_id($prescription->patient_id)->age; ?></span><br />
                                        <span><strong>Gender:</strong> <?= $this->Admin_model->getpatientby_id($prescription->patient_id)->gender; ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="margin:50px 180px 0 180px;">
                            <div class="col-md-12" style="border: 2px solid green;">
                                <div class="panel panel-primary" data-collapsed="0">
                                    <div class="panel-body"> <b>Case History : </b>
                                        <p> <?= $prescription->case_history ?></p>
                                        <hr> <b>Medication :</b>
                                        <p> <?= $prescription->meditation ?></p>
                                        <hr> <b>Note :</b>
                                        <p> <?= $prescription->note ?></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
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
@endsection