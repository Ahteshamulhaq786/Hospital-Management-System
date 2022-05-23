@extends(Backend/Pharmacist/MainTemplate)
<!-- @section(dashboardselected)
active
@endsection -->
@section(title)
Pharmacist | + ADD Medicine Category
@endsection
@section(stylelinks)

<link rel="stylesheet" href="<?= base_url('bootstrap_assets/bootstrap.min.css')?>">

@endsection


@section(content)

<div class="mdc-card">
    <div>
        <a href="<?= base_url('index.php/Pharmacist/medicinecategory') ?>">
            <button type="button" class="btn btn-w-m btn-primary">Back</button>
        </a>
    </div>
    <br>
    <div class="container" style="margin-right: 20px;">
        <form action="<?php echo base_url() ?>index.php/Pharmacist/form_validation" method="post">

            <div class="form-group" style="margin-right: 25px;">
                <label for="exampleFormControlInput1">Medicine Category:</label>
                <input type="text" required autocomplete="off" name="medicine_category_name"
                    value="<?= isset($_POST['medicine_category_name']) ? $_POST['medicine_category_name'] : $record->medicine_category_name; ?>" class="form-control"
                    id="exampleFormControlInput1">
                <span class="text-danger"><?php echo form_error("medicine_category_name"); ?></span>
            </div><br>

            <div class="form-group" style="margin-right: 25px;">
                <label for="exampleFormControlTextarea1">Medicine Category Description:</label>
                <textarea class="form-control" name="medicine_category_description" id="exampleFormControlTextarea1"
                    rows="3"><?= isset($_POST['medicine_category_description']) ? $_POST['medicine_category_description'] : $record->medicine_category_description; ?></textarea>
                <span class="text-danger"><?php echo form_error("medicine_category_description"); ?></span>
            </div><br>
            <?php if(isset($record->id) || isset($_POST['hidden_id'])) {?>
        <input type="hidden" name="hidden_id" value="<?= isset($record->id) ? $record->id : $_POST['hidden_id']; ?>">

        <div class="form-group" style="margin-right: 25px;">
        <label for="exampleFormControlInput1">Status:</label>
        <select required autocomplete="off" name="status" class="form-control">
            <option value="">Select Medicine Status</option>
            <?php if(isset($_POST['status'])){
                    ?>
                <option value="1" <?= $_POST['status']=='1' ? 'selected' : ''; ?>>Available</option>
                <option value="0" <?= $_POST['status']=='0' ? 'selected' : ''; ?>>Unavailable</option>
                    <?php 
            }else{
                ?>
            <option value="1" <?= $record->status=='1'  ? 'selected' : ''; ?>>Available</option>
            <option value="0" <?= $record->status=='0'  ? 'selected' : ''; ?>>Unavailable</option>

                <?php

            } ?>
        </select>
        <span class="text-danger"><?php echo form_error("status"); ?></span>
        </div><br>

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