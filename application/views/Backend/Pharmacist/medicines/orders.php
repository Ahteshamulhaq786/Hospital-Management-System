@extends(Backend/Pharmacist/MainTemplate)
@section(title)
Pharmacist | Medicine Orders
@endsection
@section(stylelinks)
<link rel="stylesheet" href="<?= base_url('bootstrap_assets/bootstrap.min.css') ?>">
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
<?php endif;
unset($_SESSION['success']);  ?>
@endsection

@section(content)

<div class="mdc-card">
    <div class="row animated fadeInDown">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Medicine Orders</h5>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Order Id</th>
                                    <th style="text-align: center;">Patient Name</th>
                                    <th style="text-align: center;">Delivery Status</th>
                                    <th style="text-align: center;">See Details</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($orders as $order) : ?>
                                    <tr>
                                        <td style="text-align: center;"><?= $order->id ?></td>
                                        <td style="text-align: center;"><?= $this->Admin_model->getpatientby_id($order->patient_id)->name ?></td>
                                        <td style="text-align: center;">
                                            <?php

                                            if ($order->delivery_status == 0) {
                                            ?>
                                                <span class="badge badge-danger">No Delivered Yet</span>

                                            <?php

                                            } else {
                                            ?>

                                                <span class="badge badge-success">Delivered</span>

                                            <?php

                                            }


                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a class="btn btn-sm btn-warning" href="<?= base_url('index.php/pharmacist/orderdetails/'.$order->id); ?>">Check Details</a>
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

</div>


@endsection
@section(scriptlinks)
<!-- jQuery library -->
<script src="<?= base_url('bootstrap_assets/jquery.min.js') ?>"></script>

<!-- Popper JS -->
<script src="<?= base_url('bootstrap_assets/popper.min.js') ?>"></script>

<!-- Latest compiled JavaScript -->
<script src="<?= base_url('bootstrap_assets/bootstrap.min.js') ?>"></script>

<script type="text/javascript" src="<?= base_url('pharmacist_assets/abc/datatables.min.js') ?>"></script>

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