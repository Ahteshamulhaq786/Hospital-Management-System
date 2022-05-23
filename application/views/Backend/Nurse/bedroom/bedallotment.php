@extends(Backend/Nurse/MainTemplate)
<!-- @section(dashboardselected)
active
@endsection -->
@section(title)
Bed Allotment
@endsection
@section(stylelinks)
<link href="<?= base_url('pharmacist_assets/abc/jquery.dataTables.min.css') ?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?= base_url('pharmacist_assets/abc/bs4.datatables.min.css')?>"/>
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
                    <h5>Bed Allotment</h5>
                    <div class="ibox-tools">
                        <div style="margin:10px;">
                            <a href="<?= base_url('index.php/Nurse/addbedallotment') ?>">
                                <button type="button" class="btn btn-w-m btn-primary"> + Add Bed Allotment</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>

                                    <th style="text-align: center;">Bed Number</th>
                                    <th style="text-align: center;">Bed Type</th>
                                    <th style="text-align: center;">Patient</th>
                                    <th style="text-align: center;">Allotment Time</th>
                                    <th style="text-align: center;">Discharge Time</th>
                                    <th style="text-align: center;">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($records as $record): ?>
                            <tr>
                                <td style="text-align: center;"><?= 'Bed_' . $record->bed_id; ?></td>
                                <td style="text-align: center;"><?= $this->Admin_model->getBedby_id($record->bed_id)->bed_type; ?></td>
                                <td style="text-align: center;"><?= $this->Admin_model->getpatientby_id($record->patient_id)->name; ?></td>
                                <td style="text-align: center;"><?= $record->allotment_time; ?></td>
                                <td style="text-align: center;"><?= $record->discharge_time; ?></td>
                                <td style="text-align: center;">
                                    <a href="<?= site_url('index.php/nurse/edit_bedallotment/' . $record->id); ?>"
                                       class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil"></i>&nbsp;
                                        Edit </a>

                                    <a href="<?= site_url('index.php/nurse/delete_bedallotment/' . $record->id) ?>"
                                       class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i>&nbsp;
                                        Delete </a>
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