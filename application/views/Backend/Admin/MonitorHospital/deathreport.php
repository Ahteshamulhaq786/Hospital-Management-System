@extends(Backend/Admin/MainTemplate)
@section(title)Death Report@endsection
@section(links)
<!-- Sweet Alert -->
<link href="<?= base_url('doctor_assets/css/plugins/sweetalert/sweetalert.css')?>" rel="stylesheet">

@endsection

@section(content)
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                
                <h4 style="margin-left:23%;" class="modal-title">Clinic Automation System</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align:center">File Name</th>
                            <th style="text-align:center">Options</th>
                        </tr>
                    </thead>
                    <tbody id="report-data">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Death List</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Description</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reports->death as $opr_report) : ?>
                <tr>
                    <td><?= $opr_report->date; ?></td>
                    <td><?= $this->Admin_model->getpatientby_id($opr_report->patient_id)->name; ?></td>
                    <td><?= $opr_report->doctor_id==-1 ? 'Doctor Not Exists' : $this->Admin_model->getdoctorby_id($opr_report->doctor_id)->name; ?></td>
                    <td><?= $opr_report->description; ?></td>
                    <td>
                        <a data-toggle="modal" data-target="#myModal" data-report-id="<?= $opr_report->id; ?>"
                            class="btn btn-default btn-sm view view_report">
                            <i class="fa fa-eye"></i>&nbsp;
                            View</a>
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
@section(scripts)
<!-- Sweet alert -->
<script src="<?= base_url('doctor_assets/js/plugins/sweetalert/sweetalert.min.js')?>"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.view_report').click(function() {
        var id = $(this).data('report-id');
        get_report(id);
    });

    function get_report(id) {
        $.ajax({
            url: '<?= base_url('index.php/admin/fetch_report'); ?>',
            type: "POST",
            data: {
                id: id
            },
            success: function(data) {
                $('#report-data').html(data);
            }
        });
    }
});
</script>
@endsection