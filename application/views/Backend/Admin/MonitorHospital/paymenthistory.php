@extends(Backend/Admin/MainTemplate)
@section(title)Payments History@endsection
@section(content)
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Payment List</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Invoice number</th>
                    <th>Title</th>
                    <th>Patient</th>
                    <th>Creation date</th>
                    <th>Due date</th>
                    <th>Vat percentage</th>
                    <th>Discount Amount</th>
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
                    <td>Win 95+ / OSX.1+</td>
                    <td class="">
                        <div class="btn-group d-block">
                            <div class="container">
                                <a href="#" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit"></i>&nbsp;Edit
                                </a>
                                <a href="#" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>&nbsp;Delete
                                </a>
                            </div>

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