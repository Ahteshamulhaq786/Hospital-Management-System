@extends(Backend/Nurse/MainTemplate)
<!-- @section(dashboardselected)
active
@endsection -->
@section(title)
Manage Blood Donor
@endsection
@section(stylelinks)

<link href="<?= base_url('doctor_assets/css/animate.css') ?>" rel="stylesheet">
<link href="<?= base_url('doctor_assets/css/style.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('bootstrap_assets/bootstrap.min.css')?>">
<!-- <link href="<?= base_url('pharmacist_assets/abc/jquery.dataTables.min.css') ?>" rel="stylesheet"> -->
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
<?php endif; unset($_SESSION['success']);  ?>
@endsection

@section(content)

<div class="mdc-card">
    <div class="row animated fadeInDown">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Donor List</h5>
                    <div class="ibox-tools">
                        <div style="margin:10px;">
                            <a href="<?= base_url('index.php/Nurse/addblooddonor') ?>">
                                <button type="button" class="btn btn-w-m btn-primary"> + Add Donor</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>

                                    <th style="text-align: center;">Name</th>
                                    <th style="text-align: center;">Age</th>
                                    <th style="text-align: center;">Gender</th>
                                    <th style="text-align: center;">Blood Group</th>
                                    <th style="text-align: center;">Last Donation Date</th>
                                    <th style="text-align: center;">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($blood_donor as $donor): ?>
                                <tr>
                                    <td style="text-align: center;"><?= $donor->donor_name; ?></td>
                                    <td style="text-align: center;"><?= $donor->donor_age; ?></td>
                                    <td style="text-align: center;"><?= $donor->donor_gender; ?></td>
                                    <td style="text-align: center;"><?= $donor->donor_blood_group; ?></td>
                                    <td style="text-align: center;"><?= $donor->last_donation_date; ?></td>
                                    <!-- <td style="text-align: center;">
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                            <a href="<?= base_url('index.php/Nurse/addblooddonor') ?>">
                                                <button type="submit" class="btn btn-warning btn1"
                                                    style="color: white;">
                                                    <i class="fa fa-pencil-alt"></i>Edit</button></a>
                                                    <button type="submit" class="btn btn-danger btn2">
                                                    <i class="fa fa-check"></i> Delete </button>
                                            </div>
                                        </div>
                                    </td> -->
                                    <td style="text-align: center;"><a
                                            href="<?= base_url('index.php/nurse/addblooddonor/update/'.$donor->id); ?>"><button
                                                class="btn btn-warning" style="color: white;"><i class="fa fa-pencil-alt"></i> Edit</button></a>&nbsp;&nbsp;<a
                                            href="<?= base_url('index.php/nurse/delete_blood_donor/'.$donor->id); ?>"><button
                                                class="btn btn-danger">Delete</button></a></td>
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