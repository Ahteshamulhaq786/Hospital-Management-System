@extends(Backend/Pharmacist/MainTemplate)
<!-- @section(dashboardselected)
active
@endsection -->
@section(title)
Pharmacist | + ADD Medicine
@endsection
@section(stylelinks)

<link rel="stylesheet" href="<?= base_url('bootstrap_assets/bootstrap.min.css') ?>">
<link href="<?= base_url('pharmacist_assets/abc/jquery.dataTables.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('pharmacist_assets/abc/stylee.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('pharmacist_assets/abc/style.css') ?>">
<link href="<?= base_url('pharmacist_assets/abc/profile.css') ?>" rel="stylesheet">
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="<?= base_url('assets/offline-links/Pharmacist/bootstrap.min.css'); ?>">
@endsection


@section(content)
<div class="mdc-card">
    <div>
        <a href="<?= base_url('index.php/Pharmacist/managemedicine') ?>">
            <button type="button" class="btn btn-w-m btn-primary">Back</button>
        </a>
    </div>
    <br>
    <form action="<?php echo base_url() ?>index.php/Pharmacist/form_validation_medicine" method="post">
        <div class="form-group" style="margin-right: 25px;">
            <label for="exampleFormControlInput1">Name:</label>
            <input type="text" required autocomplete="off" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : $record->name; ?>" class="form-control" id="exampleFormControlInput1">
            <span class="text-danger"><?php echo form_error("name"); ?></span>
        </div><br>
        <div class="form-group" style="margin-right: 25px;">
            <select required autocomplete="off" name="category_id" class="form-control" id="exampleFormControlSelect1">
            <option value="">Select medicine category</option>
                <?php foreach ($data['categories'] as $categories) : ?>
                    <option value="<?= $categories->id; ?>" 
                    
                    <?php
                        $var="";
                        if(isset($_POST['category_id'])){
                           $var = $_POST['category_id']==$categories->id ? "selected" : '';
                        }
                        else if(isset($record->category_id)){
                            $var = $record->category_id==$categories->id ? "selected" : '';
                        }
                    ?>
                    
                   <?= $var; ?> ><?= $categories->medicine_category_name; ?></option>
                <?php endforeach; ?>
            </select>
            <span class="text-danger"><?php echo form_error("category_id"); ?></span>
        </div><br>
        <div class="form-group" style="margin-right: 25px;">
            <label for="exampleFormControlTextarea1">Description:</label>
            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"><?= isset($_POST['description']) ? $_POST['description'] : $record->description; ?></textarea>
            <span class="text-danger"><?php echo form_error("description"); ?></span>
        </div><br>
        <div class="form-group" style="margin-right: 25px;">
            <label for="exampleFormControlInput1">Price:</label>
            <input required autocomplete="off" type="text" name="price" value="<?= isset($_POST['price']) ? $_POST['price'] : $record->price; ?>" class="form-control" id="exampleFormControlInput1">
            <span class="text-danger"><?php echo form_error("price"); ?></span>
        </div><br>
        <div class="form-group" style="margin-right: 25px;">
            <label for="exampleFormControlInput1">Total Quantity:</label>
            <input required autocomplete="off" type="text" value="<?= isset($_POST['qty']) ? $_POST['qty'] : $record->qty; ?>" name="qty" class="form-control" id="exampleFormControlInput1">
            <span class="text-danger"><?php echo form_error("qty"); ?></span>
        </div><br>
        <div class="form-group" style="margin-right: 25px;">
            <label for="exampleFormControlInput1">Manufacturing Company:</label>
            <input required autocomplete="off" type="text" name="company" value="<?= isset($_POST['company']) ? $_POST['company'] : $record->company; ?>" class="form-control" id="exampleFormControlInput1">
            <span class="text-danger"><?php echo form_error("company"); ?></span>
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
<script src="<?= base_url('bootstrap_assets/jquery.min.js') ?>"></script>

<!-- Popper JS -->
<script src="<?= base_url('bootstrap_assets/popper.min.js') ?>"></script>

<!-- Latest compiled JavaScript -->
<script src="<?= base_url('bootstrap_assets/bootstrap.min.js') ?>"></script>

<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script> -->
<script src="<?= base_url('assets/offline-links/Pharmacist/bootstrap.bundle.min.js') ?>"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script src="<?= base_url('assets/offline-links/Pharmacist/jquery.min.js') ?>"></script>

<script>
    var a = document.getElementById("blah");

    var inputFile = document.getElementById("inputFile");

    function readUrl(input) {
        if (input.files) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = (e) => {
                a.src = e.target.result;
            }
        }
        document.querySelector('.btn2').style.display = 'none';
        document.querySelector('.btn1').addEventListener('click', showBtn);

        function showBtn(e) {
            document.querySelector('.btn2').style.display = 'block';
            e.preventDefault();
        }
    }

    function removeDummy() {
        var elem = document.getElementById('btn-styled');
        elem.remove(elem);
    }
</script>


@endsection