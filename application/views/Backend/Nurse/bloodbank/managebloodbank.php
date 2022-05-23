@extends(Backend/Nurse/MainTemplate)
<!-- @section(dashboardselected)
active
@endsection -->
@section(title)
Blood Bank Status
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


@section(content)

<div class="mdc-card">
    <div class="row animated fadeInDown">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Blood Bank Status</h5>

                    
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>

                                    <th style="text-align: center;">Blood Group</th>
                                    <th style="text-align: center;">Status</th>
                                    <!-- <th style="text-align: center;">Options</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <td style="text-align: center;">A+</td>
                                    <td style="text-align: center;">10 bags</td>
                                    <td style="text-align: center;">
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                            <a href="<?= base_url('index.php/Nurse/editbloodbank') ?>">
                                                <button type="submit" class="btn btn-warning btn1"
                                                    style="color: white;">
                                                    <i class="fa fa-pencil-alt"></i>Edit</button></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">O+</td>
                                    <td style="text-align: center;">2 bags</td>
                                    <td style="text-align: center;">
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                            <a href="<?= base_url('index.php/Nurse/editbloodbank') ?>">
                                                <button type="submit" class="btn btn-warning btn1"
                                                    style="color: white;">
                                                    <i class="fa fa-pencil-alt"></i>Edit</button></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr> -->
                                <tr class="gradeX">
                                <td style="text-align: center;">A+</td>
                                <td style="text-align: center;"><?= $this->Admin_model->count_A_positive(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td style="text-align: center;">A-</td>
                                <td style="text-align: center;"><?= $this->Admin_model->count_A_negative(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td style="text-align: center;">B+</td>
                                <td style="text-align: center;"><?= $this->Admin_model->count_B_positive(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td style="text-align: center;">B-</td>
                                <td style="text-align: center;"><?= $this->Admin_model->count_B_negative(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td style="text-align: center;">AB+</td>
                                <td style="text-align: center;"><?= $this->Admin_model->count_AB_positive(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td style="text-align: center;">AB-</td>
                                <td style="text-align: center;"><?= $this->Admin_model->count_AB_negative(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td style="text-align: center;">O+</td>
                                <td style="text-align: center;"><?= $this->Admin_model->count_O_positive(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td style="text-align: center;">O-</td>
                                <td style="text-align: center;"><?= $this->Admin_model->count_O_negative(); ?> bags</td>
                            </tr>
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