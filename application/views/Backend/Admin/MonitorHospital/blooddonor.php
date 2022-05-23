@extends(Backend/Admin/MainTemplate)
@section(title)Blood Donor@endsection

@section(content)
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Blood Donor List</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="text-align: center;">Name</th>
                    <th style="text-align: center;">Age</th>
                    <th style="text-align: center;">Gender</th>
                    <th style="text-align: center;">Blood Group</th>
                    <th style="text-align: center;">Email</th>
                    <th style="text-align: center;">Phone</th>
                    <th style="text-align: center;">Address</th>
                    <th style="text-align: center;">Last Donation Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($blood_donor as $donor): ?>
                <tr>
                    <td style="text-align: center;"><?= $donor->donor_name; ?></td>
                    <td style="text-align: center;"><?= $donor->donor_age; ?></td>
                    <td style="text-align: center;"><?= $donor->donor_gender; ?></td>
                    <td style="text-align: center;"><?= $donor->donor_blood_group; ?></td>
                    <td style="text-align: center;"><?= $donor->donor_email; ?></td>
                    <td style="text-align: center;"><?= $donor->donor_phone; ?></td>
                    <td style="text-align: center;"><?= $donor->donor_address; ?></td>
                    <td style="text-align: center;"><?= $donor->last_donation_date; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</div>
<!-- /.card-body -->
</div>
@endsection