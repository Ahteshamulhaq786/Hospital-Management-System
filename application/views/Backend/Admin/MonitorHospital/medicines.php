@extends(Backend/Admin/MainTemplate)
@section(title)Medicines@endsection
@section(content)
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Medicine List</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="text-align: center;">Name</th>
                    <th style="text-align: center;">Medicine Category</th>
                    <th style="text-align: center;">Description</th>
                    <th style="text-align: center;">Price</th>
                    <th style="text-align: center;">Total Quantity</th>
                    <th style="text-align: center;">Sold Quantity</th>
                    <th style="text-align: center;">status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($medicines as $medicine): ?>
                <tr>
                    <td style="text-align: center;"><?= $medicine->name; ?></td>
                    <td style="text-align: center;">
                        <?= $this->Admin_model->getcategoryby_id($medicine->category_id)->medicine_category_name; ?>
                    </td>
                    <td style="text-align: center;"><?= $medicine->description; ?></td>
                    <td style="text-align: center;"><?= $medicine->price; ?></td>
                    <td style="text-align: center;"><?= $medicine->qty; ?></td>
                    <td style="text-align: center;"><?= $medicine->sold_qty; ?></td>
                    <td style="text-align: center;"><span
                            class="badge badge-info"><?= $medicine->status==1 ? 'available' : 'unavailable' ;?></span>
                    </td>
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