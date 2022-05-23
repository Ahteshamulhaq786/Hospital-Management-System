@extends(Backend/Labortorist/MainTemplate)
@section(links)

@endsection
@section(blooddonorselected)
active
@endsection
@section(alert)
<?php if ($this->session->has_userdata('success')) : ?>
<div class="alert alert-warning mx-5">
    <p class="m-0 p-0">
        <?= $this->session->flashdata('success'); ?></p>
</div>
<?php endif; unset($_SESSION['success']);  ?>
@endsection
@section(content)
<div class="container-fluid">
    <h4 class="page-title">Blood Donor</h4>
    <div class="row">
        <div class="col-12 mb-3">
            <a href="<?= base_url('index.php/lab/addblooddonor')?>"><button class="btn btn-primary">Add Blood Donor</button></a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Name</th>
                                <th style="text-align: center;">Email</th>
                                <th style="text-align: center;">Address</th>
                                <th style="text-align: center;">Phone</th>
                                <th style="text-align: center;">Age</th>
                                <th style="text-align: center;">Gender</th>
                                <th style="text-align: center;">Blood Group</th>
                                <th style="text-align: center;">Last Donation Date</th>
                                <th style="text-align: center;">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($blood_donor as $donor): ?>
                            <tr>
                                <td style="text-align: center;"><?= $donor->donor_name; ?></td>
                                <td style="text-align: center;"><?= $donor->donor_email; ?></td>
                                <td style="text-align: center;"><?= $donor->donor_address; ?></td>
                                <td style="text-align: center;"><?= $donor->donor_phone; ?></td>
                                <td style="text-align: center;"><?= $donor->donor_age; ?></td>
                                <td style="text-align: center;"><?= $donor->donor_gender; ?></td>
                                <td style="text-align: center;"><?= $donor->donor_blood_group; ?></td>
                                <td style="text-align: center;"><?= $donor->last_donation_date; ?></td>
                                

                                <td style="text-align: center;"><a
                                            href="<?= base_url('index.php/lab/addblooddonor/update/'.$donor->id); ?>"><button
                                                class="btn btn-warning">Edit</button></a>&nbsp;&nbsp;<a
                                            href="<?= base_url('index.php/lab/delete_blood_donor/'.$donor->id); ?>"><button
                                                class="btn btn-danger">Delete</button></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>


            </div>

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