@extends(Backend/Patient/MainTemplate)
@section(prescriptionselected)
active
@endsection
@section(pagetitle)
Prescription
@endsection
@section(stylelinks)
<link href="<?= base_url('doctor_assets/css/plugins/dataTables/datatables.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('doctor_assets/css/plugins/iCheck/custom.css') ?>" rel="stylesheet">
<link href="<?= base_url('doctor_assets/css/plugins/fullcalendar/fullcalendar.css') ?>" rel="stylesheet">
<link href="<?= base_url('doctor_assets/css/plugins/fullcalendar/fullcalendar.print.css') ?>" rel='stylesheet' media='print'>
<link href="<?= base_url('doctor_assets/css/plugins/sweetalert/sweetalert.css') ?>" rel="stylesheet">

@endsection

@section(content)

<div class="modal inmodal" id="prescriptionreport" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Clinic Automation System</h4>
            </div>
            <div class="modal-body" id="prescription-modal">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <a id="print_pres" class="btn btn-primary hidden-print">
                    <i class="fa fa-print"></i>&nbsp;
                    Print Prescription </a>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal" id="diagnosisreport" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Clinic Automation System</h4>

            </div>
            <div class="modal-body" id="diagnosis_modal">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <a id="print_diagnosis" class="btn btn-primary hidden-print">
                    <i class="fa fa-print"></i>&nbsp;
                    Print Diagnosis Reports </a>
            </div>
        </div>
    </div>
</div>



<div class="row animated fadeInDown">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= $this->Admin_model->getpatientby_id($_SESSION['PROFILE_ID'])->name; ?>'s Prescription</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Patient</th>
                                <th>Doctor</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($prescriptions as $prescription): ?>
                            <tr>                       
                                <td><?= $prescription->date.' '.date('h:i:s A',strtotime($prescription->time)); ?></td>
                                <td><?= $this->Admin_model->getpatientby_id($prescription->patient_id)->name; ?></td>
                                <td><?= $prescription->doctor_id==-1 ? 'Doctor Not Exists' : $this->Admin_model->getdoctorby_id($prescription->doctor_id)->name; ?></td>
                                <td>
                                    <a data-id="<?= $prescription->id; ?>" class="btn btn-default btn-sm view-prescription" data-toggle="modal" data-target="#prescriptionreport">
                                        <i class="fa fa-eye"></i>&nbsp;
                                        View Prescription </a>

                                    <a class="btn btn-default btn-sm view-diagnosis" data-toggle="modal" data-target="#diagnosisreport" data-id="<?= $prescription->patient_id; ?>">
                                        <i class="fa fa-eye"></i>&nbsp;
                                        View Diagnosis Report </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section(scriptlinks)
<script src="<?= base_url('doctor_assets/js/plugins/dataTables/datatables.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'copy'
                },
                {
                    extend: 'csv'
                },
                {
                    extend: 'excel',
                    title: 'ExampleFile'
                },
                {
                    extend: 'pdf',
                    title: 'ExampleFile'
                },

                {
                    extend: 'print',
                    customize: function(win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });

    });
</script>
<script src="<?= base_url('doctor_assets/js/plugins/fullcalendar/moment.min.js') ?>"></script>
<!-- iCheck -->
<script src="<?= base_url('doctor_assets/js/plugins/iCheck/icheck.min.js') ?>"></script>

<!-- Full Calendar -->
<script src="<?= base_url('doctor_assets/js/plugins/fullcalendar/fullcalendar.min.js') ?>"></script>
<script>
    $(document).ready(function() {

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });

        /* initialize the external events
        -----------------------------------------------------------------*/


        $('#external-events div.external-event').each(function() {

            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1111999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            });

        });


        /* initialize the calendar
        -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            events: [{
                    title: 'All Day Event',
                    start: new Date(y, m, 1)
                },
                {
                    title: 'Long Event',
                    start: new Date(y, m, d - 5),
                    end: new Date(y, m, d - 2)
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d - 3, 16, 0),
                    allDay: false
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d + 4, 16, 0),
                    allDay: false
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d + 1, 19, 0),
                    end: new Date(y, m, d + 1, 22, 30),
                    allDay: false
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'http://google.com/'
                }
            ]
        });


    });
</script>
<script type="text/javascript" src="<?= base_url('admin_assets/plugins/jQuery-Plugin-To-Print-Any-Part-Of-Your-Page-Print/jQuery.print.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.view-prescription').on('click', function() {
            var prescription_id = $(this).data('id');
            get_prescription(prescription_id);
        });

        $('#print_pres').click(function(e) {
            e.preventDefault();
            jQuery('#prescription-modal').print();
        });

        $('.view-diagnosis').on('click', function(e) {
            e.preventDefault();
            var pid = $(this).data('id');
            get_diagnosis(pid);
        });


        $('#print_diagnosis').click(function(e) {
            e.preventDefault();
            jQuery('#diagnosis_modal').print();
        });

        function get_diagnosis(id) {
            $.ajax({
                url: '<?= site_url('index.php/patient/finddiagnosis'); ?>',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#diagnosis_modal').html(data);
                }
            });
        }

        function get_prescription(id) {
            $.ajax({
                url: '<?= site_url('index.php/patient/findprescription'); ?>',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#prescription-modal').html(data);
                }
            });
        }
    });
</script>
<script src="<?= base_url('doctor_assets/js/plugins/sweetalert/sweetalert.min.js') ?>"></script>

<?php if ($this->session->has_userdata('success')) : ?>
    <script>
        $(document).ready(function() {
            swal({
                title: "<?= $this->session->flashdata('success'); ?>",
                text: "Please Check Your Profile",
                type: "success"
            });
        });
    </script>
<?php endif;
unset($_SESSION['success']); ?>
@endsection