@extends(Backend/Doctor/MainTemplate)
@section(patientsselected)
active
@endsection
@section(pagetitle)
Patient
@endsection
@section(stylelinks)
<link href="<?= base_url('doctor_assets/css/plugins/dataTables/datatables.min.css') ?>" rel="stylesheet">
<!-- Sweet Alert -->
<link href="<?= base_url('doctor_assets/css/plugins/sweetalert/sweetalert.css')?>" rel="stylesheet">


@endsection
@section(content)
<div style="margin:10px;">
    <a href="<?= base_url('index.php/Doctor/addpatient') ?>">
        <button type="button" class="btn btn-w-m btn-primary">Add Patient</button>
    </a>
</div>
<div class="row animated fadeInDown">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Patient List</h5>
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Birth Date</th>
                            <th>Age</th>
                            <th>Blood Group</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($records as $record) : ?>
                            <tr>
                                <td style="display: flex; justify-content: center;">
                                    <img src="<?= $record->icon; ?>" class="img-circle" width="40px" height="40px">
                                </td>
                                <td><?= $record->name; ?></td>
                                <td><?= $this->Admin_model->get_login_details($record->id, 'patient')->email; ?></td>
                                <td><?= $record->address ?></td>
                                <td><?= $record->phone ?></td>
                                <td><?= $record->gender ?></td>
                                <td><?= $record->birth_date ?></td>
                                <td><?= $record->age ?></td>
                                <td><?= $record->blood_group ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Actions
                                            <span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                            <li data-toggle="modal" data-target="#myModal2">
                                                <a href="<?= base_url('index.php/doctor/patient_profile?pid=' . $record->id); ?>">
                                                    <i class="fa fa-user"></i> &nbsp;
                                                    Profile
                                                </a>

                                            </li>
                                            <li>
                                                <a href="<?= base_url('index.php/Doctor/prescription?pid=' . $record->id) ?>">
                                                    <i class="fa fa-eye"></i> &nbsp;
                                                    View Medication History </a>
                                            </li>
                                            <li>
                                                <a href="<?= site_url('index.php/doctor/addpatient/update/' . $record->id); ?>">
                                                    <i class="fa fa-pencil"></i> &nbsp;
                                                    Edit </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="<?= site_url('index.php/doctor/delete_patient/' . $record->id); ?>">
                                                    <i class="fa fa-trash-o"></i> &nbsp;
                                                    Delete </a>
                                            </li>
                                        </ul>
                                    </div>
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
</script>
@endsection