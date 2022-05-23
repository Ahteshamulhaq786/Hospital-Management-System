@extends(Backend/Labortorist/MainTemplate)
@section(links)

@endsection
@section(pathologyselected)
active
@endsection
@section(alert)
<?php if ($this->session->has_userdata('success')) : ?>
<div class="alert alert-warning mx-5">
    <p class="m-0"><?= $this->session->flashdata('success'); ?></p>
</div>
<?php endif;
unset($_SESSION['success']);  ?>
@endsection
@section(content)
<div class="container-fluid">
    <h4 class="page-title">Lab Reports</h4>
    <div class="row">
        <div class="col-12 mb-3">
            <a href="<?= base_url('index.php/lab/addreport') ?>"><button class="btn btn-primary">Add Test
                    Report</button></a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Test Type</th>
                                <th>Report Type</th>
                                <th>View Details</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reports as $report) : ?>
                            <tr>
                                <td class="d-flex justify-content-center">
                                    <img src="<?= $this->Admin_model->getpatientby_id($report->patient_id)->icon; ?>"
                                        class="img-circle" width="40px" height="40px">
                                </td>
                                <td><?= $this->Admin_model->getpatientby_id($report->patient_id)->name; ?></td>
                                <td><?= $report->report_type ?></td>
                                <td><?= $report->report_file_type ?></td>

                                <td>
                                    <a data-pid="<?= $report->patient_id; ?>" data-toggle="modal"
                                        data-target="#detailsModal" class="btn btn-info btn-sm viewbtn"
                                        href="<?= site_url('index.php/lab/delete_report/' . $report->id); ?>">
                                        <i class="la la-cut"></i> &nbsp;
                                        View</a>
                                    <div class="modal fade" id="detailsModal">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Report Details</h4>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body" id="reportbody">

                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                <?php if($report->laboratorist_id==$_SESSION['PROFILE_ID']): ?>
                                    <a class="btn btn-warning btn-sm"
                                        href="<?= site_url('index.php/lab/update_report/' . $report->id); ?>">
                                        <i class="la la-edit"></i> &nbsp;
                                        Edit </a>

                                        <?php endif; ?>

                                </td>

                                <td>
                                <?php if($report->laboratorist_id==$_SESSION['PROFILE_ID']): ?>

                                    <a class="btn btn-warning btn-sm btn-danger"
                                        href="<?= site_url('index.php/lab/delete_report/' . $report->id); ?>">
                                        <i class="la la-cut"></i> &nbsp;
                                        Delete </a>
                                        <?php endif; ?>
                                </td>
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
<script>
$(document).ready(function() {
    $('.viewbtn').click(function() {
        var pid = $(this).data('pid');
        $.ajax({
            url: '<?= site_url('index.php/lab/fetchreportdetails'); ?>',
            type: 'POST',
            data: {
                pid: pid
            },
            success: function(data) {
                $('#reportbody').html(data);
            }
        });
    });
});
</script>
@endsection