@extends(Backend/Admin/MainTemplate)
@section(title)Payroll List@endsection
@section(content)
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Payroll List</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Employee</th>
                    <th>Account type</th>
                    <th>Summary</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.0</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown">
                            Options
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">
                            <i class="fa fa-eye nav-icon"></i>    
                            View Payroll Details</a>
                            <a class="dropdown-item" href="#">
                            <i class="fa fa-eye nav-icon"></i> Marks as Paid</a>
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
</div>

</div>
<!-- /.card-body -->
</div>
@endsection