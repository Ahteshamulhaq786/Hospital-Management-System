@extends(Backend/Nurse/MainTemplate)

@section(title)
Patient
@endsection

@section(patientselected)
active
@endsection


@section(stylelinks)
<link rel="stylesheet" href="<?= base_url('bootstrap_assets/bootstrap.min.css')?>">
<link href="<?= base_url('pharmacist_assets/abc/jquery.dataTables.min.css') ?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?= base_url('pharmacist_assets/abc/bs4.datatables.min.css') ?>" />
<style type="text/css">
select.custom-select.custom-select-sm.form-control.form-control-sm {
    width: 50% !important;
}

li.paginate_button.page-item {
    background: none !important;
    border: none !important;
    padding: 2px !important;
}
</style>

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

@section(content)

<div class="mdc-card">
    <div class="row animated fadeInDown">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Patient List</h5>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Image</th>
                                    <th style="text-align: center;">Name</th>
                                    <th style="text-align: center;">Email</th>
                                    <th style="text-align: center;">Phone</th>
                                    <th style="text-align: center;">Birth Date</th>
                                    <th style="text-align: center;">Blood Group</th>
                                    <th style="text-align: center;">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($records as $record) : ?>
                                <tr>
                                    <td style="display: flex; justify-content: center; text-align:center;">
                                    <img src="<?= $record->icon; ?>" class="img-circle" width="40px" height="40px">
                                </td>
                                <td style="text-align: center;"><?= $record->name; ?></td>
                                <td style="text-align: center;"><?= $this->Admin_model->get_login_details($record->id, 'patient')->email; ?></td>
                                <td style="text-align: center;"><?= $record->phone ?></td>
                                <td style="text-align: center;"><?= $record->birth_date ?></td>
                                <td style="text-align: center;"><?= $record->blood_group ?></td>
                                <td style="text-align: center;">
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Actions
                                            <span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                            <li data-toggle="modal" data-target="#myModal2">
                                                <a href="<?= base_url('index.php/nurse/patient_profile?pid=' . $record->id); ?>" class="btn">
                                                    <i class="fa fa-user"></i> &nbsp;
                                                    Profile
                                                </a>

                                            </li>
                                            <li>
                                                <a href="<?= base_url('index.php/nurse/prescription?pid=' . $record->id) ?>" class="btn">
                                                    <i class="fa fa-eye"></i> &nbsp;
                                                    View Medication History </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                </tr>
                                <?php endforeach; ?>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>




@endsection
@section(scriptlinks)
<!-- jQuery library -->
<script src="<?= base_url('bootstrap_assets/jquery.min.js')?>"></script>

<!-- Popper JS -->
<script src="<?= base_url('bootstrap_assets/popper.min.js')?>"></script>

<!-- Latest compiled JavaScript -->
<script src="<?= base_url('bootstrap_assets/bootstrap.min.js')?>"></script>

<script type="text/javascript" src="<?= base_url('pharmacist_assets/abc/datatables.min.js')?>"></script>

<script>
$(document).ready(function() {
    $('.dataTables-example').DataTable({
        pageLength: 10,
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
@endsection