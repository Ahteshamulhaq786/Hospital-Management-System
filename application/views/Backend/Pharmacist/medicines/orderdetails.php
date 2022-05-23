@extends(Backend/Pharmacist/MainTemplate)
@section(title)
Pharmacist | Order Details
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

    ul li span {
        font-weight: lighter;
        font-size: 0.8rem;
    }

    .table tbody tr td,
    .table thead tr th {
        text-align: center !important;
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
                    <div class="card">
                        <div class="card-header bg-warning">Orders Details</div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap">
                                <div class="p-2 flex-fill">
                                    <ul class="list-group" style="font-family: monospace;font-weight: bold;">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Order Tracking ID
                                            <span><?= $ordersInfo->id; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Order Status
                                            <span><?= $ordersInfo->status; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Payment Status
                                            <span><?= $ordersInfo->payment_status; ?></span>
                                        </li>

                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Delivery Status
                                            <span>
                                                <div class="mdc-switch mdc-switch--secondary" data-mdc-auto-init="MDCSwitch">
                                                    <div class="mdc-switch__track"></div>
                                                    <div class="mdc-switch__thumb-underlay">
                                                        <div class="mdc-switch__thumb">
                                                            <input type="checkbox" value="<?= $ordersInfo->delivery_status; ?>" onchange="changeDeliveryStatus(this)" id="basic-switch" class="mdc-switch__native-control" role="switch" <?= $ordersInfo->delivery_status == 1 ? 'checked' : ''; ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </span>
                                        </li>

                                    </ul>
                                </div>
                                <div class="p-2 flex-fill">
                                    <ul class="list-group" style="font-family: monospace;font-weight: bold;">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Date Created
                                            <span><?= $ordersInfo->created_at; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Date Modified
                                            <span><?= $ordersInfo->updated_at; ?></span>
                                        </li>

                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Total Amount
                                            <span><?= $this->Admin_model->gettotalcharges($ordersInfo->id) . ' ' . $this->Admin_model->get_system_settings()->system_currency ?></span>
                                        </li>

                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Payment Status
                                            <span>
                                                <div class="mdc-switch mdc-switch--secondary" data-mdc-auto-init="MDCSwitch">
                                                    <div class="mdc-switch__track"></div>
                                                    <div class="mdc-switch__thumb-underlay">
                                                        <div class="mdc-switch__thumb">
                                                            <input type="checkbox" value="<?= $ordersInfo->payment_status; ?>" onchange="changePaymentStatus(this)" id="basic-switch-2" class="mdc-switch__native-control" role="switch" <?= $ordersInfo->payment_status == 1 ? 'checked' : ''; ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </span>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-info">Delivery Details</div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap">
                                <div class="p-2 flex-fill">
                                    <ul class="list-group" style="font-family: monospace;font-weight: bold;">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Company
                                            <span><?= $ordersInfo->company; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            City
                                            <span><?= $ordersInfo->city; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            State
                                            <span><?= $ordersInfo->state; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Zip
                                            <span><?= $ordersInfo->zip; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Clinic Patient
                                            <span><?= 'True' ?></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="p-2 flex-fill">
                                    <ul class="list-group" style="font-family: monospace;font-weight: bold;">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Patient
                                            <span>
                                                <?php if ($ordersInfo->name == '') { ?>

                                                    <?= $this->Admin_model->getpatientby_id($ordersInfo->patient_id)->name; ?>


                                                <?php } else { ?>

                                                    <?= $ordersInfo->name; ?>

                                                <?php } ?>
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Email
                                            <span>
                                                <?php if ($ordersInfo->email == '') { ?>

                                                    <?= $this->Admin_model->get_login_details($ordersInfo->patient_id, 'patient')->email; ?>


                                                <?php } else { ?>

                                                    <?= $ordersInfo->email; ?>

                                                <?php } ?>
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Phone
                                            <span>
                                                <?php if ($ordersInfo->phone == '') { ?>

                                                    <?= $this->Admin_model->getpatientby_id($ordersInfo->patient_id)->phone; ?>


                                                <?php } else { ?>

                                                    <?= $ordersInfo->phone; ?>

                                                <?php } ?>
                                            </span>
                                        </li>
                                        <?php if ($ordersInfo->cash_on_delivery == 1) : ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Cash On Delivery
                                                <span><?= 'True' ?></span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ($ordersInfo->cash_on_delivery == 0) : ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Online Payment
                                                <span><?= 'True' ?></span>
                                            </li>
                                        <?php endif; ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Shipping Address
                                            <span><?= $ordersInfo->shipping_address; ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header bg-success">Ordered Medicines</div>
                        <div class="card-body">

                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th data-hide="phone">Patient ID</th>
                                        <th data-hide="phone">Patient</th>
                                        <th data-hide="phone">Medicine</th>
                                        <th data-hide="phone">Amount</th>
                                        <th data-hide="phone">Buy Quantity</th>
                                        <th data-hide="phone">Charges</th>
                                        <th data-hide="phone">Delivery Status</th>
                                        <th data-hide="phone">Payment Status</th>
                                        <th>Availble Qty</th>
                                        <th>Sold Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orderMedicines as $medicine) : ?>
                                        <tr>
                                            <td>
                                                <?= $ordersInfo->patient_id; ?>
                                            </td>
                                            <td>
                                                <?= $this->Admin_model->getpatientby_id($ordersInfo->patient_id)->name; ?>
                                            </td>
                                            <td>
                                                <?= $this->Admin_model->getmedicineby_id($medicine->medicine_id)->name; ?>
                                            </td>
                                            <td>
                                                <?= $this->Admin_model->getmedicineby_id($medicine->medicine_id)->price; ?>
                                            </td>
                                            <td>
                                                <?= $medicine->qty; ?>
                                            </td>
                                            <td>
                                                <?= $medicine->qty * $this->Admin_model->getmedicineby_id($medicine->medicine_id)->price; ?>
                                            </td>
                                            <td>
                                                <span class="label <?= $ordersInfo->delivery_status == 0 ? 'label-danger' : 'label-primary'  ?>"><?= $ordersInfo->delivery_status == 0 ? 'Not Delivered' : 'Delivered'; ?></span>
                                            </td>
                                            <td>
                                                <span class="label <?= $ordersInfo->payment_status==1 ? 'label-success' : 'label-danger'  ?>"><?= $ordersInfo->payment_status == 0 ? 'Unpaid' : 'Paid'; ?></span>
                                            </td>
                                            <td>
                                                <?= $this->Admin_model->getmedicineby_id($medicine->medicine_id)->qty ?>
                                            </td>
                                            <td>
                                                <?= $this->Admin_model->getmedicineby_id($medicine->medicine_id)->sold_qty ?>
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
<script>
    function changeDeliveryStatus(element) {
        var val = $(element).val();
        var status;
        if (val == 0) {
            // change it to 1
            status = 1;
        } else {
            status = 0;
            // change it to 0
        }
        $.ajax({
            url: '<?= base_url('index.php/pharmacist/change_delivery_status'); ?>',
            method: 'POST',
            data: {
                status: status,
                orderId: <?= $ordersInfo->id ?>
            },
            success: function(data) {
                if (data == true) {
                    alert("Delivery Status Updated");
                    location.reload();
                } else {
                    alert("Delivery Status Not Updated");
                }
            }
        });
    }
    function changePaymentStatus(element) {
        var val = $(element).val();
        var status;
        if (val == 0) {
            // change it to 1
            status = 1;
        } else {
            status = 0;
            // change it to 0
        }
        $.ajax({
            url: '<?= base_url('index.php/pharmacist/change_payment_status'); ?>',
            method: 'POST',
            data: {
                status: status,
                orderId: <?= $ordersInfo->id ?>
            },
            success: function(data) {
                if (data == true) {
                    alert("Payment Status Updated");
                    location.reload();
                } else {
                    alert("Payment Status Not Updated");
                }
            }
        });
    }
</script>
@endsection