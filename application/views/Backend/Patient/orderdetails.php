@extends(Backend/Patient/MainTemplate)
@section(orderdetailsselected)
active
@endsection
@section(pagetitle)
Order Details
@endsection
@section(stylelinks)
<!-- FooTable -->
<link href="<?= base_url('doctor_assets/css/plugins/footable/footable.core.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/datapicker/datepicker3.css') ?>" rel="stylesheet">
@endsection
@section(content)
<div class="ibox-content m-b-sm border-bottom">
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success'];
            unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label" for="order_id">Order ID</label>
                <input type="text" id="order_id" disabled name="order_id" value="<?= $orders->id; ?>" placeholder="Order ID" class="form-control">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label" for="status">Order status</label>
                <input type="text" id="status" disabled name="status" value="<?= $orders->status; ?>" placeholder="Status" class="form-control">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label" for="customer">Patient</label>
                <input type="text" id="customer" disabled name="customer" value="<?= $this->Admin_model->getpatientby_id($orders->patient_id)->name; ?>" placeholder="" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label" for="date_added">Date added</label>
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="date_added" type="text" class="form-control" disabled value="<?= $orders->created_at; ?>">
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label" for="date_modified">Date modified</label>
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="date_modified" type="text" class="form-control" disabled value="<?= $orders->updated_at ?>">
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label" for="amount">Total Amount <span class="text-danger" style="font-weight: lighter;">(Included Delivery Charges <?= $this->Admin_model->get_system_settings()->standard_shipping_fee; ?>)</span></label>
                <input type="text" id="amount" disabled name="amount" value="<?= $this->Admin_model->gettotalcharges($orders->id) . ' ' . $this->Admin_model->get_system_settings()->system_currency ?>" placeholder="Amount" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-10">
            <div class="container-fuild">
                <?php if ($this->Admin_model->getorderby_id($orders->id)->cash_on_delivery == 0 && $this->Admin_model->getorderby_id($orders->id)->pay_with_card == 0) { ?>
                    <a href="<?= base_url('index.php/patient/cash_on_delivery?order_id=' . $orders->id); ?>" class="btn btn-warning">Cash On Delivery</a>
                    <form style="display: inline;" action="<?= base_url('index.php/patient/makepayment?order_id=' . $orders->id); ?>" method="post">
                        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="<?php echo $this->publishableKey ?>" data-amount="<?php echo $this->Admin_model->gettotalcharges($orders->id) * 100; ?>" data-name="<?= $this->Admin_model->get_sys_settings()->system_name; ?>" data-description="Stripe Payment Method" data-image="<?= $this->Admin_model->get_sys_settings()->image_path; ?>" data-currency="<?= strtolower($this->Admin_model->get_sys_settings()->system_currency); ?>" data-email="<?= $this->Admin_model->get_row_by_id()->email; ?>">
                            data - oid = "<?= $orders->id; ?>"
                        </script>
                    </form>
                <?php } else { ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="date_added">Payment Status</label>
                                <div class="input-group date">
                                    <?php if ($this->Admin_model->getorderby_id($orders->id)->cash_on_delivery == 0 && $this->Admin_model->getorderby_id($orders->id)->pay_with_card == 1) { ?>
                                        <span class="input-group-addon"><i class="fa fa-cc-stripe" style="color: blue;" aria-hidden="true"></i>&nbsp;&nbsp;Pay with Card</span><input id="date_added" type="text" class="form-control" disabled value="<?= "true" ?>">
                                    <?php } else if ($this->Admin_model->getorderby_id($orders->id)->cash_on_delivery == 1 && $this->Admin_model->getorderby_id($orders->id)->pay_with_card == 0) { ?>
                                        <span class="input-group-addon"><i class="fa fa-money" style="color: red;" aria-hidden="true"></i>&nbsp;&nbsp;Cash On Delivery</span><input id="date_added" type="text" class="form-control" disabled value="<?= "true" ?>">
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php

                } ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                    <thead>
                        <tr>
                            <th data-hide="phone">Patient</th>
                            <th data-hide="phone">Medicine</th>
                            <th data-hide="phone">Amount</th>
                            <th data-hide="phone">Quantity</th>
                            <th data-hide="phone">Charges</th>
                            <th data-hide="phone">Delivery Status</th>
                            <th data-hide="phone">Payment Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orderMedicines as $medicine) : ?>
                            <tr>
                                <td>
                                    <?= $this->Admin_model->getpatientby_id($_SESSION['PROFILE_ID'])->name; ?>
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
                                    <span class="label label-primary"><?= $orders->delivery_status == 0 ? 'Not Delivered' : 'Delivered'; ?></span>
                                </td>
                                <td>
                                    <span class="label label-success"><?= $orders->payment_status == 0 ? 'Pending' : 'Paid'; ?></span>
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a href="<?= base_url('index.php/patient/delete_order?oid=' . $medicine->id . '&&order_detail_id=' . $medicine->order_detail_id); ?>"><button class="btn btn-danger btn-xs">Delete</button></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <ul class="pagination pull-right"></ul>
                            </td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section(scriptlinks)
<!-- Data picker -->
<script src="<?= base_url('doctor_assets/js/plugins/datapicker/bootstrap-datepicker.js') ?>"></script>
<!-- FooTable -->
<script src="<?= base_url('doctor_assets/js/plugins/footable/footable.all.min.js') ?>"></script>

<!-- Page-Level Scripts -->
<!-- Page-Level Scripts -->
<script>
    $(document).ready(function() {

        $('.footable').footable();

        $('#date_added').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $('#date_modified').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

    });
</script>
@endsection