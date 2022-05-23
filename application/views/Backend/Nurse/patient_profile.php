@extends(Backend/Nurse/MainTemplate)
<!-- @section(assignedpatientselected)
active
@endsection -->
@section(title)
Patient Profile
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

<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profile Detail</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        <img alt="image" width="100%" class="img-responsive" src="<?= $patient['icon'] ?>">
                    </div>
                    <div class="ibox-content profile-content">
                        <h4><strong><?= $patient['name'] ?></strong></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><span class="text-danger"><?= $patient['name']; ?>'s Detail</span></h5>

                </div>
                <div class="ibox-content">

                    <div>
                        <div class="feed-activity-list">

                            <table>
                                <tr>
                                    <td>
                                        <font size="4"><b>Email: </b></font>
                                    </td>
                                    <td>
                                        <p style="margin:2px 0 0 50px;"><?= $patient['email'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <font size="4"><b>Address: </b></font>
                                    </td>
                                    <td>
                                        <p style="margin:2px 0 0 50px;"><?= $patient['address'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <font size="4"><b>Age: </b></font>
                                    </td>
                                    <td>
                                        <p style="margin:2px 0 0 50px;"><?= $patient['age'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <font size="4"><b>Gender: </b></font>
                                    </td>
                                    <td>
                                        <p style="margin:2px 0 0 50px;"><?= $patient['gender'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <font size="4"><b>Blood Group: </b></font>
                                    </td>
                                    <td>
                                        <p style="margin:2px 0 0 50px;"><?= $patient['blood_group'] ?></p>
                                    </td>
                                </tr>
                                <tr>

                                    <td>
                                        <font size="4"><b>Phone: </b></font>

                                    </td>
                                    <td>
                                        <p style="margin:2px 0 0 50px;"><?= $patient['phone'] ?></p>
                                    </td>
                                </tr>
                            </table>


                            <p>


                            </p>
                            <p>


                            </p>
                            <p>


                            </p>
                            <p>


                            </p>
                            <p>

                            </p>

                        </div>
                    </div>

                </div>
            </div>
            <!-- <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Other Doctors Feedbacks given by <span class="text-danger"><?= $patient['name']; ?></span></h5>
                    
                </div>
                <div class="ibox-content">

                    <div>
                        <div class="feed-activity-list">
                            
        </div>
    </div>

</div>

</div> -->

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