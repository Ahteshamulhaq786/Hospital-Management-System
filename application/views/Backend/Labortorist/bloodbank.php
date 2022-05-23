@extends(Backend/Labortorist/MainTemplate)
@section(links)

@endsection
@section(bloodbankselected)
active
@endsection
@section(content)
<div class="container-fluid">
    <h4 class="page-title">Blood Bank</h4>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Blood Group</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>A+</td>
                                <td><?= $this->Admin_model->count_A_positive(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td>A-</td>
                                <td><?= $this->Admin_model->count_A_negative(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td>B+</td>
                                <td><?= $this->Admin_model->count_B_positive(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td>B-</td>
                                <td><?= $this->Admin_model->count_B_negative(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td>AB+</td>
                                <td><?= $this->Admin_model->count_AB_positive(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td>AB-</td>
                                <td><?= $this->Admin_model->count_AB_negative(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td>O+</td>
                                <td><?= $this->Admin_model->count_O_positive(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td>O-</td>
                                <td><?= $this->Admin_model->count_O_negative(); ?> bags</td>
                            </tr>
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