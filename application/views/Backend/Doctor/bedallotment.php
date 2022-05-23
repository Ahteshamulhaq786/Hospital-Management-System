@extends(Backend/Doctor/MainTemplate)

@section(bedallotmentselected)
active
@endsection
@section(pagetitle)
Bed Allotment
@endsection

@section(stylelinks)
<link href="<?= base_url('doctor_assets/css/plugins/dataTables/datatables.min.css') ?>" rel="stylesheet">
<!-- Sweet Alert -->
<link href="<?= base_url('doctor_assets/css/plugins/sweetalert/sweetalert.css')?>" rel="stylesheet">


@endsection
@section(content)
<div style="margin:10px;">
    <a href="<?= base_url('index.php/Doctor/addbedallotment') ?>">
        <button type="button" class="btn btn-w-m btn-primary">Add Bed Allotment</button>
    </a>
</div>
<div class="row animated fadeInDown">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Bed Allotment List</h5>
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
                            <th>Bed Number</th>
                            <th>Bed Type</th>
                            <th>Patient</th>
                            <th>Allotment Time</th>
                            <th>Discharge Time</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($records as $record): ?>
                            <tr>
                                <td><?= 'Bed_' . $record->bed_id; ?></td>
                                <td><?= $this->Admin_model->getBedby_id($record->bed_id)->bed_type; ?></td>
                                <td><?= $this->Admin_model->getpatientby_id($record->patient_id)->name; ?></td>
                                <td><?= $record->allotment_time; ?></td>
                                <td><?= $record->discharge_time; ?></td>
                                <td>
                                    <a href="<?= site_url('index.php/doctor/edit_bedallotment/' . $record->id); ?>"
                                       class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil"></i>&nbsp;
                                        Edit </a>

                                    <a href="<?= site_url('index.php/doctor/delete_bedallotment/' . $record->id) ?>"
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
@endsection

@section(scriptlinks)
<script src="<?= base_url('doctor_assets/js/plugins/dataTables/datatables.min.js') ?>"></script>
<script>
    $(document).ready(function () {
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
                    customize: function (win) {
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