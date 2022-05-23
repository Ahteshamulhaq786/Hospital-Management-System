@extends(Backend/Admin/MainTemplate)
@section(title)Bed Allotment@endsection
@section(content)
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Bed Allotment List</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Bed number</th>
                    <th>Bed Type</th>
                    <th>Patient</th>
                    <th>Allotment time</th>
                    <th>Discharge time</th>

                </tr>
            </thead>
            <tbody>
            <?php foreach ($records as $record): ?>
                            <tr>
                                <td><?= 'Bed_' . $record->bed_id; ?></td>
                                <td><?= $this->Admin_model->getBedby_id($record->bed_id)->bed_type; ?></td>
                                <td><?= $this->Admin_model->getpatientby_id($record->patient_id)->name; ?></td>
                                <td><?= $record->allotment_time; ?></td>
                                <td><?= $record->discharge_time; ?></td>
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