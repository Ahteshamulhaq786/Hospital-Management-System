@extends(Backend/Nurse/MainTemplate)
<!-- @section(dashboardselected)
active
@endsection -->
@section(title)
Add Blood Donor
@endsection
@section(stylelinks)

<link rel="stylesheet" href="<?= base_url('bootstrap_assets/bootstrap.min.css')?>">


@endsection


@section(content)

<div class="mdc-card">
    <div>
        <a href="<?= base_url('index.php/Nurse/blooddonor') ?>">
            <button type="button" class="btn btn-w-m btn-primary">Back</button>
        </a>
    </div>
    <br>
    <form action="<?php echo base_url()?>index.php/nurse/donors" method="post">
        <div class="form-group" style="margin-right: 25px;">
            <label for="exampleFormControlInput1">Name:</label>
            <!-- <input type="text" class="form-control" id="exampleFormControlInput1"> -->
            <input required autocomplete="off" name="donor_name"
                value="<?= isset($_POST['donor_name']) ? $_POST['donor_name'] : $record->donor_name; ?>" type="text"
                class="form-control input-square" id="exampleFormControlInput1" placeholder="Enter Donor Name">
            <span class="text-danger"><?php echo form_error("donor_name"); ?></span>
        </div><br>
        <div class="form-group" style="margin-right: 25px;">
            <label for="exampleFormControlInput1">Email:</label>
            <!-- <input type="mail" class="form-control" id="exampleFormControlInput1"> -->
            <input required autocomplete="off" name="donor_email"
                value="<?= isset($_POST['donor_email']) ? $_POST['donor_email'] : $record->donor_email; ?>" type="text"
                class="form-control input-square" id="squareInput" placeholder="Enter Donor Email">
            <span class="text-danger"><?php echo form_error("donor_email"); ?></span>
        </div><br>
        <div class="form-group" style="margin-right: 25px;">
            <label for="exampleFormControlTextarea1">Address:</label>
            <input required autocomplete="off" name="donor_address"
                        value="<?= isset($_POST['donor_address']) ? $_POST['donor_address'] : $record->donor_address; ?>"
                        type="text" class="form-control input-square" id="squareInput"
                        placeholder="Enter Donor Address">
                    <span class="text-danger"><?php echo form_error("donor_address"); ?></span>
        </div><br>
        <div class="form-group" style="margin-right: 25px;">
            <label for="exampleFormControlInput1">Phone:</label>
            <input required autocomplete="off" name="donor_phone"
                        value="<?= isset($_POST['donor_phone']) ? $_POST['donor_phone'] : $record->donor_phone; ?>"
                        type="text" class="form-control input-square" id="squareInput" placeholder="Enter Donor Phone">
                    <span class="text-danger"><?php echo form_error("donor_phone"); ?></span>
        </div><br>
        <div class="form-group" style="margin-right: 25px;">
            <label for="exampleFormControlInput1">Gender:</label>
            <select required autocomplete="off" name="donor_gender" class="form-control" id="pillSelect">
                        <option value="0">Select Gender</option>
                        <option value="male" <?php echo ($record->donor_gender == "male") ? "selected" : ''; ?>>Male
                        </option>
                        <option value="female" <?php echo ($record->donor_gender == "female") ? "selected" : ''; ?>>Female
                        </option>
                    </select>
                    <span class="text-danger"><?php echo form_error("donor_gender"); ?></span>
        </div><br>
        <div class="form-group" style="margin-right: 25px;">
            <label for="exampleFormControlInput1">Age:</label>
            <input required autocomplete="off" name="donor_age"
                        value="<?= isset($_POST['donor_age']) ? $_POST['donor_age'] : $record->donor_age; ?>"
                        type="text" class="form-control input-square" id="squareInput" placeholder="Enter Donor Age">
                    <span class="text-danger"><?php echo form_error("donor_age"); ?></span>
        </div><br>
        <div class="form-group" style="margin-right: 25px;">
            <label for="exampleFormControlInput1">Blood Group:</label>
            <select required autocomplete="off" name="donor_blood_group" class="form-control" id="pillSelect">
                    <option value="">Select Blood Group</option>
                        <option value="A+" <?= ($record->donor_blood_group == "A+") ? "selected" : ''; ?>>A+</option>
                        <option value="A-" <?= ($record->donor_blood_group == "A-") ? "selected" : ''; ?>>A-</option>
                        <option value="B+" <?= ($record->donor_blood_group == "B+") ? "selected" : ''; ?>>B+</option>
                        <option value="B-" <?= ($record->donor_blood_group == "B-") ? "selected" : ''; ?>>B-</option>
                        <option value="AB+" <?= ($record->donor_blood_group == "AB+") ? "selected" : ''; ?>>AB+</option>
                        <option value="AB-" <?= ($record->donor_blood_group == "AB-") ? "selected" : ''; ?>>AB-</option>
                        <option value="O+" <?= ($record->donor_blood_group == "O+") ? "selected" : ''; ?>>O+</option>
                        <option value="O-" <?= ($record->donor_blood_group == "O-") ? "selected" : ''; ?>>O-</option>
                    </select>
                    <span class="text-danger"><?php echo form_error("donor_blood_group"); ?></span>
        </div><br>
        <div class="form-group" style="margin-right: 25px;">
            <label for="exampleFormControlInput1">Last Duration Date:</label>
            <input required autocomplete="off" name="last_donation_date"
                        value="<?= isset($_POST['last_donation_date']) ? $_POST['last_donation_date'] : $record->last_donation_date; ?>"
                        type="date" class="form-control input-square" id="squareInput" placeholder="Last Donation Date">
                    <span class="text-danger"><?php echo form_error("last_donation_date"); ?></span>
        </div><br>
        <!-- <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-check"></i> Save </button>
            </div>
        </div> -->
        <?php if(isset($record->id) || isset($_POST['hidden_id'])) {?>
                <input type="hidden" name="hidden_id"
                    value="<?= isset($record->id) ? $record->id : $_POST['hidden_id']; ?>">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" style="color: white;" class="btn btn-warning">Update</button>
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

@endsection

@section(scriptlinks)

<!-- jQuery library -->
<script src="<?= base_url('bootstrap_assets/jquery.min.js')?>"></script>

<!-- Popper JS -->
<script src="<?= base_url('bootstrap_assets/popper.min.js')?>"></script>

<!-- Latest compiled JavaScript -->
<script src="<?= base_url('bootstrap_assets/bootstrap.min.js')?>"></script>

@endsection