@extends(Backend/Pharmacist/MainTemplate)
<!-- @section(dashboardselected)
active
@endsection -->
@section(title)
Pharmacist | + ADD Medicine
@endsection
@section(stylelinks)

<link rel="stylesheet" href="<?= base_url('bootstrap_assets/bootstrap.min.css')?>">



@endsection


@section(content)

<div class="mdc-card">
    <div>
        <a href="<?= base_url('index.php/Pharmacist/medicinesales') ?>">
            <button type="button" class="btn btn-w-m btn-primary">Back</button>
        </a>
    </div>
    <br>
    <form action="<?php echo base_url()?>index.php/Pharmacist/form_validation_sales" method="post">
        <div class="form-group" style="margin-right: 25px;">
            <label for="exampleFormControlInput1">Medicine Name:</label>
            <input type="text" required autocomplete="off" name="medicine_sales_name"
                value="<?= isset($_POST['medicine_sales_name']) ? $_POST['medicine_sales_name'] : $record->medicine_sales_name; ?>"
                class="form-control" id="exampleFormControlInput1">
            <span class="text-danger"><?php echo form_error("medicine_sales_name"); ?></span>
        </div><br>
        <div class="form-group" style="margin-right: 25px;">
            <label for="exampleFormControlInput1">Total Price:</label>
            <input type="text" required autocomplete="off" name="total_price"
                value="<?= isset($_POST['total_price']) ? $_POST['total_price'] : $record->total_price; ?>"
                class="form-control" id="exampleFormControlInput1">
            <span class="text-danger"><?php echo form_error("total_price"); ?></span>
        </div><br>
        <div class="form-group" style="margin-right: 25px;">
            <label for="exampleFormControlInput1">Patient:</label>
            <input type="text" required autocomplete="off" name="patient_name"
                value="<?= isset($_POST['patient_name']) ? $_POST['patient_name'] : $record->patient_name; ?>"
                class="form-control" id="exampleFormControlInput1">
            <span class="text-danger"><?php echo form_error("patient_name"); ?></span>
        </div><br>
        <?php if(isset($record->id) || isset($_POST['hidden_id'])) {?>
        <input type="hidden" name="hidden_id" value="<?= isset($record->id) ? $record->id : $_POST['hidden_id']; ?>">
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" class="btn btn-warning">Update</button>
            </div>
        </div>
        <?php } else{ ?>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>

        <?php } ?>


    </form>
    
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
@endsection