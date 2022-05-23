@extends(Backend/Patient/MainTemplate)
@section(paymentmethodselected)
active
@endsection
@section(pagetitle)
Payment Method
@endsection
@section(stylelinks)
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href='https://www.soengsouy.com/favicon.ico' rel='icon' type='image/x-icon' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- library validate -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
<!-- style css -->
<link rel="stylesheet" href="<?= base_url('assets/payment.css'); ?>">
<style>
input[type]{
    margin-bottom:12px !important;
}
.myclass{
    padding-top:10px;
    padding-bottom:10px;
}
.text-danger{
    margin-left:4px !important;
}
</style>
@endsection
@section(content)
<?php if(isset($_SESSION['success'])): ?>
<div class="alert alert-danger">
  <?= $_SESSION['success'];?>
  <?php unset($_SESSION['success']); ?>
</div>
<?php endif; ?>
<form id="validate" action="<?= base_url('index.php/patient/placeorder'); ?>" method="post">
<div class="myrow" style="padding: 15px;">
    <div class="col-75">
        <div class="mycontainer">
                <div class="myrow">
                    <div class="col-50" style="padding:13px">
                        <h3>Contact Information <span class="text-danger" style="font-weight:lighter">(optional)</span></h3><br>
                        <input type="text" name="phone" style="height:60px; border-radius:10px;"
                            placeholder="Mobile Phone Number"><br>
                        <h3>Shipping Details</h3><br>
                        <label for="fname"><i class="fa fa-user"></i> Full Name <span class="text-danger" style="font-weight:lighter">(optional)</span></label>
                        <input type="text" id="fname" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ; ?>" placeholder="Your Name">
                        <label for="email"><i class="fa fa-envelope"></i> Email <span class="text-danger" style="font-weight:lighter">(optional)</span></label>
                        <input type="text" id="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ; ?>" placeholder="Your Email">
                        <label for="adr"><i class="fa fa-home"></i> Shipping Address</label>
                        <input type="text" id="adr" name="shipping_address" value="<?= isset($_POST['shipping_address']) ? $_POST['shipping_address'] : '' ; ?>" placeholder="Your Address">
                        <div class="text-danger"><?= form_error('shipping_address'); ?></div>
                        <div class="myrow myclass">
                            <div class="col-50">
                                <label for="state">Company <span class="text-danger" style="font-weight:lighter">(optional)</span></label>
                                <input type="text" name="company" value="<?= isset($_POST['company']) ? $_POST['company'] : '' ; ?>" placeholder="Your Company">
                            </div>
                            <div class="col-50">
                                <label for="city">City</label>
                                <input type="text" id="city" value="<?= isset($_POST['city']) ? $_POST['city'] : '' ; ?>" name="city" placeholder="Your City">
                                <div class="text-danger"><?= form_error('city'); ?></div>
                            </div>
                        </div>
                        <div class="myrow myclass">
                            <div class="col-50">
                                <label for="state">State</label>
                                <input type="text" name="state" value="<?= isset($_POST['state']) ? $_POST['state'] : '' ; ?>" placeholder="Your State">
                                <div class="text-danger"><?= form_error('state'); ?></div>
                            </div>
                            <div class="col-50">
                                <label for="zip">Zip Code</label>
                                <input type="text" id="zip" value="<?= isset($_POST['zip']) ? $_POST['zip'] : '' ; ?>" name="zip" placeholder="Your Zip Code">
                                <div class="text-danger"><?= form_error('zip'); ?></div>
                            </div>
                        </div>
                        <div class="myrow">
                        <div class="col-50">
                        <h3 style="white-space:nowrap">Shipping Method : <span style="font-weight:lighter">stripe Payment</span></h3>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="col-25">
        <div class="mycontainer">
            <h4>ORDER SUMMARY</h4>
            <h4>
                <font color="green">Cart <span class="price" style="color:green"><i class="fa fa-shopping-cart"></i>
                        <b>4</b></span></font>
            </h4>
            <hr><br>
            <div class="myrow">
                <div class="col-50">
                    <table>
                        <tr>
                            <td>
                                <h4>Subtotal</h4>
                            </td>
                            <td>
                                <h5 style="margin-left: 150px;"><?= $total_price; ?>  <?=
                                $this->Admin_model->get_system_settings()->system_currency
                                ?></h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Shipping fee</h4>
                            </td>
                            <td>
                                <h5 style="margin-left: 150px;" id="feeshipping">
                                   <?=
                                    $this->Admin_model->get_system_settings()->standard_shipping_fee
                                ?>  <?=
                                $this->Admin_model->get_system_settings()->system_currency
                                ?>
                                </h5>
                            </td>
                        </tr>
                    </table>
                    <hr>
                </div>

                <div class="col-50">
                    <table>
                        <tr>
                            <td>
                                <h2>Total</h2>
                                <input type="hidden" id="total_price" value="<?= $total_price ?>">
                                <input type="hidden" id="fee_ship" value="0">
                            </td>
                            <td>
                                <h2 style="margin-left: 130px;" id="total_bill"><?= $total_price+$this->Admin_model->get_sys_settings()->standard_shipping_fee ?> <?= $this->Admin_model->get_system_settings()->system_currency; ?></h2>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <input type="submit" class="btn btn-success" value="Place Order">
                <!-- <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="<?php echo $this->publishableKey?>"
                    data-amount="<?= ($total_price+$this->Admin_model->get_sys_settings()->standard_shipping_fee)*100 ?>"
                    data-name="<?= $this->Admin_model->get_sys_settings()->system_name; ?>"
                    data-description="<?= $this->Admin_model->get_sys_settings()->system_address; ?>"
                    data-image="<?= $this->Admin_model->get_sys_settings()->image_path; ?>"
                    data-currency="<?= strtolower($this->Admin_model->get_sys_settings()->system_currency); ?>"
                    data-email="<?= $this->Admin_model->get_row_by_id()->email; ?>"
                >
                </script> -->
        </div>
    </div>
</div>
</form>
</div>
@endsection

@section(scriptlinks)
@endsection