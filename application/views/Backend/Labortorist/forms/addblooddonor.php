@extends(Backend/Labortorist/MainTemplate)
@section(links)

@endsection
@section(blooddonorselected)
active
@endsection
@section(content)
<div class="container-fluid">
    <h4 class="page-title">Add Blood Donor</h4>
    <div class="row">
        <div class="col-md-3">
            <div class="card card-stats card-warning">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="la la-users"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">Visitors</p>
                                <h4 class="card-title">1,294</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats card-success">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="la la-bar-chart"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">Sales</p>
                                <h4 class="card-title">$ 1,345</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats card-danger">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="la la-newspaper-o"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">Subscribers</p>
                                <h4 class="card-title">1303</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats card-primary">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="la la-check-circle"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">Order</p>
                                <h4 class="card-title">576</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-3">
            <a href="<?= base_url('index.php/lab/blood_donor'); ?>"><button class="btn btn-primary">Back</button></a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-8">
            <form role="form" class="form-horizontal form-groups" action="<?php echo base_url()?>index.php/lab/donors"
                method="post">
                <div class="form-group">
                    <label for="squareInput">Name</label>
                    <input required autocomplete="off" name="donor_name"
                        value="<?= isset($_POST['donor_name']) ? $_POST['donor_name'] : $record->donor_name; ?>"
                        type="text" class="form-control input-square" id="squareInput" placeholder="Enter Donor Name">
                    <span class="text-danger"><?php echo form_error("donor_name"); ?></span>
                </div>
                <div class="form-group">
                    <label for="squareInput">Email</label>
                    <input required autocomplete="off" name="donor_email"
                        value="<?= isset($_POST['donor_email']) ? $_POST['donor_email'] : $record->donor_email; ?>"
                        type="text" class="form-control input-square" id="squareInput" placeholder="Enter Donor Email">
                    <span class="text-danger"><?php echo form_error("donor_email"); ?></span>
                </div>
                <div class="form-group">
                    <label for="squareInput">Address</label>
                    <input required autocomplete="off" name="donor_address"
                        value="<?= isset($_POST['donor_address']) ? $_POST['donor_address'] : $record->donor_address; ?>"
                        type="text" class="form-control input-square" id="squareInput"
                        placeholder="Enter Donor Address">
                    <span class="text-danger"><?php echo form_error("donor_address"); ?></span>
                </div>
                <div class="form-group">
                    <label for="squareInput">Phone</label>
                    <input required autocomplete="off" name="donor_phone"
                        value="<?= isset($_POST['donor_phone']) ? $_POST['donor_phone'] : $record->donor_phone; ?>"
                        type="text" class="form-control input-square" id="squareInput" placeholder="Enter Donor Phone">
                    <span class="text-danger"><?php echo form_error("donor_phone"); ?></span>
                </div>
                <div class="form-group">
                    <label for="squareInput">Age</label>
                    <input required autocomplete="off" name="donor_age"
                        value="<?= isset($_POST['donor_age']) ? $_POST['donor_age'] : $record->donor_age; ?>"
                        type="text" class="form-control input-square" id="squareInput" placeholder="Enter Donor Age">
                    <span class="text-danger"><?php echo form_error("donor_age"); ?></span>
                </div>
                <div class="form-group">
                    <label for="pillSelect">Gender</label>
                    <select required autocomplete="off" name="donor_gender" class="form-control" id="pillSelect">
                        <option value="0">Select Gender</option>
                        <option value="male" <?php echo ($record->donor_gender == "male") ? "selected" : ''; ?>>Male
                        </option>
                        <option value="female" <?php echo ($record->donor_gender == "female") ? "selected" : ''; ?>>Female
                        </option>
                    </select>
                    <span class="text-danger"><?php echo form_error("donor_gender"); ?></span>
                </div>
                <div class="form-group">
                    <label for="pillSelect">Blood Group</label>
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
                </div>
                <div class="form-group">
                    <label for="squareInput">Last Donation Date</label>
                    <input required autocomplete="off" name="last_donation_date"
                        value="<?= isset($_POST['last_donation_date']) ? $_POST['last_donation_date'] : $record->last_donation_date; ?>"
                        type="date" class="form-control input-square" id="squareInput" placeholder="Last Donation Date">
                    <span class="text-danger"><?php echo form_error("last_donation_date"); ?></span>
                </div>
                <?php if(isset($record->id) || isset($_POST['hidden_id'])) {?>
                <input type="hidden" name="hidden_id"
                    value="<?= isset($record->id) ? $record->id : $_POST['hidden_id']; ?>">
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
</div>
@endsection

@section(scripts)
<script>
$(document).ready(function() {
    $('#example').DataTable({
        pageLength: 25,
        responsive: true,
        dom: 'Bfltip',
        buttons: [
            'copy', 'excel', 'pdf', 'print', 'csv'
        ]
    });
});
</script>
@endsection