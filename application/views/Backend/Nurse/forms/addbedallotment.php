@extends(Backend/Nurse/MainTemplate)
<!-- @section(dashboardselected)
active
@endsection -->
@section(title)
Add Bed-Allotment
@endsection
@section(stylelinks)
<link rel="stylesheet" href="<?= base_url('bootstrap_assets/bootstrap.min.css')?>">
<link href="<?=base_url('doctor_assets/css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet">

@endsection


@section(content)

<div class="mdc-card">
    <div>
        <a href="<?= base_url('index.php/Nurse/bedallotment') ?>">
            <button type="button" class="btn btn-w-m btn-primary">Back</button>
        </a>
    </div>
    <br>
    <form action="<?= site_url('index.php/nurse/manage_bedallotments'); ?>" method="post">
        <div class="form-group" style="margin: 0 15px 0 12px;">
            <label for="exampleFormControlInput1">Bed Number:</label>

                <select name="bed_id" required autocomplete="off" class="form-control">
                <option value="0">Select Bed</option>
                        <?php foreach($records->beds as $bed) : ?>
                            <option value="<?= $bed->bed_number; ?>" 
                                <?php echo ($bed->bed_number==$records->bed_id) ? 'selected' : '' ?>
                            >
                                <?= $bed->bed_number.' - '.$bed->bed_type; ?>
                                </option>
                        <?php endforeach; ?>
                </select>
                    </div><br>
        <div class="form-group" style="margin: 0 15px 0 12px;">
            <label for="exampleFormControlInput1">Patient:</label>
             <select name="patient_id" required autocomplete="off" class="form-control">
             <option value="0">Select Patient</option>
                        <?php foreach($records->patients as $patient) : ?>
                            <option value="<?= $patient->id; ?>"
                        <?php echo ($patient->id==$records->patient_id) ? 'selected' : '' ?>
                                ><?= $patient->name; ?></option>
                        <?php endforeach; ?>
                </select>
        </div><br>
        <div class="form-group date" id="data_1">
                <label class="col-lg-2 control-label">Allotment Time</label>
                <div class="col-lg-12">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="allotment_time" required="required" autocomplete="off" class="form-control" value="<?= isset($_POST['allotment_time']) ? $_POST['allotment_time'] : $records->allotment_time; ?>">
                    </div>
                </div>
            </div><br>
        <div class="form-group" id="data_1">
                <label class="col-lg-2 control-label">Discharge Time</label>
                <div class="col-lg-12">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="discharge_time" autocomplete="off" required="required" class="form-control" value="<?= isset($_POST['discharge_time']) ? $_POST['discharge_time'] : $records->discharge_time; ?>">
                    </div>
                </div>
            </div><br>
        
        <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <?php if (isset($records->id) || isset($records->hidden_id)) { ?>
                        <button type="submit" class="btn btn-warning text-white">

                            <i class="fa fa-check"></i>&nbsp;&nbsp;Update</button>

                    <?php } else { ?>

                        <button type="submit" class="btn btn-primary">

                            <i class="fa fa-plus"></i>&nbsp;&nbsp;Add</button>
                    <?php } ?>                    
                </div>
            </div>
                        <?php if (isset($records->id)) : ?>
                <input type="hidden" name="hidden_id" value="<?= $records->id; ?>">
            <?php endif; ?>

            <?php if (isset($records->hidden_id)) : ?>
                <input type="hidden" name="hidden_id" value="<?= $records->hidden_id; ?>">
            <?php endif; ?>
    </form>
</div>

@endsection

@section(scriptlinks)

<!-- jQuery library -->
<script src="<?= base_url('bootstrap_assets/jquery.min.js')?>"></script>

<!-- Popper JS -->
<script src="<?= base_url('bootstrap_assets/popper.min.js')?>"></script>

<!-- Latest compiled JavaScript -->
<script src="<?= base_url('bootstrap_assets/bootstrap.min.js')?>"></script>
<!-- Data picker -->
<script src="<?=base_url('doctor_assets/js/plugins/datapicker/bootstrap-datepicker.js')?>"></script>
<!-- Date range use moment.js same as full calendar plugin -->
<script src="<?=base_url('doctor_assets/js/plugins/fullcalendar/moment.min.js')?>"></script>

<!-- Date range picker -->
<script src="<?=base_url('doctor_assets/js/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script>
$('#data_1 .input-group.date').datepicker({
             todayBtn: "linked",
             keyboardNavigation: false,
             forceParse: false,
             calendarWeeks: true,
             autoclose: true
         });

         $('#data_2 .input-group.date').datepicker({
             startView: 1,
             todayBtn: "linked",
             keyboardNavigation: false,
             forceParse: false,
             autoclose: true,
             format: "dd/mm/yyyy"
         });

         $('#data_3 .input-group.date').datepicker({
             startView: 2,
             todayBtn: "linked",
             keyboardNavigation: false,
             forceParse: false,
             autoclose: true
         });

         $('#data_4 .input-group.date').datepicker({
             minViewMode: 1,
             keyboardNavigation: false,
             forceParse: false,
             forceParse: false,
             autoclose: true,
             todayHighlight: true
         });

         $('#data_5 .input-daterange').datepicker({
             keyboardNavigation: false,
             forceParse: false,
             autoclose: true
         });

         $('input[name="daterange"]').daterangepicker();

         $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

         $('#reportrange').daterangepicker({
             format: 'MM/DD/YYYY',
             startDate: moment().subtract(29, 'days'),
             endDate: moment(),
             minDate: '01/01/2012',
             maxDate: '12/31/2015',
             dateLimit: { days: 60 },
             showDropdowns: true,
             showWeekNumbers: true,
             timePicker: false,
             timePickerIncrement: 1,
             timePicker12Hour: true,
             ranges: {
                 'Today': [moment(), moment()],
                 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                 'This Month': [moment().startOf('month'), moment().endOf('month')],
                 'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
             },
             opens: 'right',
             drops: 'down',
             buttonClasses: ['btn', 'btn-sm'],
             applyClass: 'btn-primary',
             cancelClass: 'btn-default',
             separator: ' to ',
             locale: {
                 applyLabel: 'Submit',
                 cancelLabel: 'Cancel',
                 fromLabel: 'From',
                 toLabel: 'To',
                 customRangeLabel: 'Custom',
                 daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                 monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                 firstDay: 1
             }
         }, function(start, end, label) {
             console.log(start.toISOString(), end.toISOString(), label);
             $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
         });

</script>

@endsection