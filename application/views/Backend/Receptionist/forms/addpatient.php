@extends(Backend/Receptionist/MainTemplate)
@section(patientsselected)
active
@endsection
@section(pagetitle)
Add Patient
@endsection
@section(stylelinks)
<link href="<?= base_url('doctor_assets/css/plugins/iCheck/custom.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/chosen/bootstrap-chosen.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/colorpicker/bootstrap-colorpicker.min.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/cropper/cropper.min.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/switchery/switchery.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/jasny/jasny-bootstrap.min.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/nouslider/jquery.nouislider.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/datapicker/datepicker3.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/ionRangeSlider/ion.rangeSlider.css') ?>" rel="stylesheet">
<link href="<?= base_url('doctor_assets/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') ?>"
    rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/clockpicker/clockpicker.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/daterangepicker/daterangepicker-bs3.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/select2/select2.min.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css') ?>" rel="stylesheet">

<link href="<?= base_url('doctor_assets/css/plugins/dualListbox/bootstrap-duallistbox.min.css') ?>" rel="stylesheet">
@endsection
@section(content)

<div style="margin-bottom:10px;">
    <a href="<?= base_url('index.php/receptionist/patients') ?>">
        <button type="button" class="btn btn-w-m btn-success">Back</button>
    </a>
</div>


<div class="row animated fadeInDown">
    <div class="col-lg-10 col-md-10 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-1">
        <form method="post" action="<?= site_url('index.php/receptionist/manage_patients'); ?>"
            enctype="multipart/form-data" class="form-horizontal">
            <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" autocomplete="off" required
                        value="<?= isset($record->name) ? $record->name : $_POST['name']; ?>" name="name"
                        class="form-control">
                    <div class="text-danger d-block text-bold">
                        <p style="padding-left: 2px;padding-top: 2px"><?= form_error('name'); ?></p>
                    </div>
                </div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input autocomplete="off" required
                        value="<?= isset($record->email) ? $record->email : $_POST['email']; ?>" name="email"
                        type="email" class="form-control">
                    <div class="text-danger d-block text-bold">
                        <p style="padding-left: 2px;padding-top: 2px"><?= form_error('email'); ?></p>
                    </div>
                </div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Password</label>

                <div class="col-sm-10"><input type="text" autocomplete="off" required class="form-control"
                        name="password"
                        value="<?= isset($record->password) ? $record->password : $_POST['password']; ?>">
                    <div class="text-danger d-block text-bold">
                        <p style="padding-left: 2px;padding-top: 2px"><?= form_error('password'); ?></p>
                    </div>
                </div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Address</label>

                <div class="col-sm-10">
                    <textarea name="address"
                        class="form-control"><?= isset($record->address) ? $record->address : $_POST['address']; ?></textarea>
                    <div class="text-danger d-block text-bold">
                        <p style="padding-left: 2px;padding-top: 2px"><?= form_error('address'); ?></p>
                    </div>
                </div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Phone</label>

                <div class="col-sm-10">
                    <input type="number" autocomplete="off" required
                        value="<?= isset($record->phone) ? $record->phone : $_POST['phone']; ?>" class="form-control"
                        name="phone">
                    <div class="text-danger d-block text-bold">
                        <p style="padding-left: 2px;padding-top: 2px"><?= form_error('phone'); ?></p>
                    </div>
                </div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Gender</label>
                <div class="col-sm-10">
                    <select name="gender" class="form-control" autocomplete="off" required>

                        <option value="0">Select Gender</option>
                        <option value="male" <?php echo ($record->gender_id == "male") ? "selected" : ''; ?>>Male
                        </option>
                        <option value="female" <?php echo ($record->gender_id == "female") ? "selected" : ''; ?>>FeMale
                        </option>

                    </select>
                </div>
            </div>

            <div class="form-group" id="data_1"><label class="col-sm-2 control-label">Birth Date</label>

                <div class="col-sm-10">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" autocomplete="off" required class="form-control" name="birth_date"
                            value="<?php echo isset($record->birth_date) ? $record->birth_date : set_value('birth_date'); ?>">
                        <div class="text-danger d-block text-bold">
                            <p style="padding-left: 2px;padding-top: 2px"><?= form_error('birth_date'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group"><label class="col-sm-2 control-label">Age</label>

                <div class="col-sm-10">
                    <input type="number" autocomplete="off" required
                        value="<?php echo isset($record->age) ? $record->age : set_value('age'); ?>"
                        class="form-control" name="age">
                    <div class="text-danger d-block text-bold">
                        <p style="padding-left: 2px;padding-top: 2px"><?= form_error('age'); ?></p>
                    </div>
                </div>
            </div>

            <div class="form-group"><label class="col-sm-2 control-label">Blood Group</label>
                <div class="col-sm-10">
                    <select name="blood_group" class="form-control" autocomplete="off" required>

                        <option value="">Select Blood Group</option>
                        <option value="A+" <?= ($record->blood_group_id == "A+") ? "selected" : ''; ?>>A+</option>
                        <option value="A-" <?= ($record->blood_group_id == "A-") ? "selected" : ''; ?>>A-</option>
                        <option value="B+" <?= ($record->blood_group_id == "B+") ? "selected" : ''; ?>>B+</option>
                        <option value="B-" <?= ($record->blood_group_id == "B-") ? "selected" : ''; ?>>B-</option>
                        <option value="AB+" <?= ($record->blood_group_id == "AB+") ? "selected" : ''; ?>>AB+</option>
                        <option value="AB-" <?= ($record->blood_group_id == "AB-") ? "selected" : ''; ?>>AB-</option>
                        <option value="O+" <?= ($record->blood_group_id == "O+") ? "selected" : ''; ?>>O+</option>
                        <option value="O-" <?= ($record->blood_group_id == "O-") ? "selected" : ''; ?>>O-</option>
                    </select>
                </div>
            </div>

            <div class="form-group"><label class="col-sm-2 control-label">Image</label>
                <div class="col-sm-10">
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                            <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                            <span class="fileinput-new">Select file</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" accept="image/*" name="icon" id="file" onchange="loadFile(event)">
                        </span>
                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" onclick="rmimg()"
                            data-dismiss="fileinput">Remove</a>
                    </div>
                    <?php if (isset($_SESSION['upload_errors'])) : ?>

                    <div class="invalid-feedback text-danger d-block text-bold">
                        <?= $_SESSION['upload_errors']; ?>
                    </div>
                    <?php unset($_SESSION['upload_errors']);
                    endif;
                    ?>
                </div>
            </div>
            <?php
            if (isset($record->icon)) {
                $d = $record->icon;
            } else {
                $d = set_value('old_img') == '' ? '' : set_value('old_img');
            }
            ?>
            <input type="hidden" id="old_img_1" name="old_img" value="<?= $d; ?>">

            <div class="form-group"><label class="col-sm-2 control-label"></label>
                <div class="col-sm-10" style="display: flex;justify-content:center;">
                    <img id="output" src="<?= $d; ?>" width="200" height="200" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label text-center"></label>
                <div class="col-sm-10">

                    <?php if (isset($record->id) || isset($record->hidden_id)) { ?>
                    <button type="submit" class="btn btn-warning text-white">

                        <i class="fa fa-check"></i>&nbsp;&nbsp;Update</button>

                    <?php } else { ?>

                    <button type="submit" class="btn btn-success">

                        <i class="fa fa-plus"></i>&nbsp;&nbsp;Add</button>
                    <?php } ?>

                </div>
            </div>
            <?php if (isset($record->id)) : ?>
            <input type="hidden" name="hidden_id" value="<?= $record->id; ?>">
            <?php endif; ?>

            <?php if (isset($record->hidden_id)) : ?>
            <input type="hidden" name="hidden_id" value="<?= $record->hidden_id; ?>">
            <?php endif; ?>

        </form>
    </div>
</div>
</div>
@endsection

@section(scriptlinks)
<script src="<?= base_url('doctor_assets/js/plugins/slimscroll/jquery.slimscroll.min.js') ?>"></script>
<!-- Chosen -->
<script src="<?= base_url('doctor_assets/js/plugins/chosen/chosen.jquery.js') ?>"></script>

<!-- JSKnob -->
<script src="<?= base_url('doctor_assets/js/plugins/jsKnob/jquery.knob.js') ?>"></script>
<!-- Input Mask-->
<script src="<?= base_url('doctor_assets/js/plugins/jasny/jasny-bootstrap.min.js') ?>"></script>

<!-- Data picker -->
<script src="<?= base_url('doctor_assets/js/plugins/datapicker/bootstrap-datepicker.js') ?>"></script>

<!-- NouSlider -->
<script src="<?= base_url('doctor_assets/js/plugins/nouslider/jquery.nouislider.min.js') ?>"></script>

<!-- Switchery -->
<script src="<?= base_url('doctor_assets/js/plugins/switchery/switchery.js') ?>"></script>

<!-- IonRangeSlider -->
<script src="<?= base_url('doctor_assets/js/plugins/ionRangeSlider/ion.rangeSlider.min.js') ?>"></script>

<!-- iCheck -->
<script src="<?= base_url('doctor_assets/js/plugins/iCheck/icheck.min.js') ?>"></script>

<!-- MENU -->
<script src="<?= base_url('doctor_assets/js/plugins/metisMenu/jquery.metisMenu.js') ?>"></script>

<!-- Color picker -->
<script src="<?= base_url('doctor_assets/js/plugins/colorpicker/bootstrap-colorpicker.min.js') ?>"></script>

<!-- Clock picker -->
<script src="<?= base_url('doctor_assets/js/plugins/clockpicker/clockpicker.js') ?>"></script>

<!-- Image cropper -->
<script src="<?= base_url('doctor_assets/js/plugins/cropper/cropper.min.js') ?>"></script>

<!-- Date range use moment.js same as full calendar plugin -->
<script src="<?= base_url('doctor_assets/js/plugins/fullcalendar/moment.min.js') ?>"></script>

<!-- Date range picker -->
<script src="<?= base_url('doctor_assets/js/plugins/daterangepicker/daterangepicker.js') ?>"></script>

<!-- Select2 -->
<script src="<?= base_url('doctor_assets/js/plugins/select2/select2.full.min.js') ?>"></script>

<!-- TouchSpin -->
<script src="<?= base_url('doctor_assets/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js') ?>"></script>

<!-- Tags Input -->
<script src="<?= base_url('doctor_assets/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') ?>"></script>

<!-- Dual Listbox -->
<script src="<?= base_url('doctor_assets/js/plugins/dualListbox/jquery.bootstrap-duallistbox.js') ?>"></script>

<script>
$(document).ready(function() {

    $('.tagsinput').tagsinput({
        tagClass: 'label label-primary'
    });

    var $image = $(".image-crop > img")
    $($image).cropper({
        aspectRatio: 1.618,
        preview: ".img-preview",
        done: function(data) {
            // Output the result data for cropping image.
        }
    });

    var $inputImage = $("#inputImage");
    if (window.FileReader) {
        $inputImage.change(function() {
            var fileReader = new FileReader(),
                files = this.files,
                file;

            if (!files.length) {
                return;
            }

            file = files[0];

            if (/^image\/\w+$/.test(file.type)) {
                fileReader.readAsDataURL(file);
                fileReader.onload = function() {
                    $inputImage.val("");
                    $image.cropper("reset", true).cropper("replace", this.result);
                };
            } else {
                showMessage("Please choose an image file.");
            }
        });
    } else {
        $inputImage.addClass("hide");
    }

    $("#download").click(function() {
        window.open($image.cropper("getDataURL"));
    });

    $("#zoomIn").click(function() {
        $image.cropper("zoom", 0.1);
    });

    $("#zoomOut").click(function() {
        $image.cropper("zoom", -0.1);
    });

    $("#rotateLeft").click(function() {
        $image.cropper("rotate", 45);
    });

    $("#rotateRight").click(function() {
        $image.cropper("rotate", -45);
    });

    $("#setDrag").click(function() {
        $image.cropper("setDragMode", "crop");
    });

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

    var elem = document.querySelector('.js-switch');
    var switchery = new Switchery(elem, {
        color: '#1AB394'
    });

    var elem_2 = document.querySelector('.js-switch_2');
    var switchery_2 = new Switchery(elem_2, {
        color: '#ED5565'
    });

    var elem_3 = document.querySelector('.js-switch_3');
    var switchery_3 = new Switchery(elem_3, {
        color: '#1AB394'
    });

    var elem_4 = document.querySelector('.js-switch_4');
    var switchery_4 = new Switchery(elem_4, {
        color: '#f8ac59'
    });
    switchery_4.disable();

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });

    $('.demo1').colorpicker();

    var divStyle = $('.back-change')[0].style;
    $('#demo_apidemo').colorpicker({
        color: divStyle.backgroundColor
    }).on('changeColor', function(ev) {
        divStyle.backgroundColor = ev.color.toHex();
    });

    $('.clockpicker').clockpicker();

    $('input[name="daterange"]').daterangepicker();

    $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format(
        'MMMM D, YYYY'));

    $('#reportrange').daterangepicker({
        format: 'MM/DD/YYYY',
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: {
            days: 60
        },
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
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                .endOf('month')
            ]
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
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                'September', 'October', 'November', 'December'
            ],
            firstDay: 1
        }
    }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });

    $(".select2_demo_1").select2();
    $(".select2_demo_2").select2();
    $(".select2_demo_3").select2({
        placeholder: "Select a state",
        allowClear: true
    });


    $(".touchspin1").TouchSpin({
        buttondown_class: 'btn btn-white',
        buttonup_class: 'btn btn-white'
    });

    $(".touchspin2").TouchSpin({
        min: 0,
        max: 100,
        step: 0.1,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
        postfix: '%',
        buttondown_class: 'btn btn-white',
        buttonup_class: 'btn btn-white'
    });

    $(".touchspin3").TouchSpin({
        verticalbuttons: true,
        buttondown_class: 'btn btn-white',
        buttonup_class: 'btn btn-white'
    });

    $('.dual_select').bootstrapDualListbox({
        selectorMinimalHeight: 160
    });


});

$('.chosen-select').chosen({
    width: "100%"
});

$("#ionrange_1").ionRangeSlider({
    min: 0,
    max: 5000,
    type: 'double',
    prefix: "$",
    maxPostfix: "+",
    prettify: false,
    hasGrid: true
});

$("#ionrange_2").ionRangeSlider({
    min: 0,
    max: 10,
    type: 'single',
    step: 0.1,
    postfix: " carats",
    prettify: false,
    hasGrid: true
});

$("#ionrange_3").ionRangeSlider({
    min: -50,
    max: 50,
    from: 0,
    postfix: "°",
    prettify: false,
    hasGrid: true
});

$("#ionrange_4").ionRangeSlider({
    values: [
        "January", "February", "March",
        "April", "May", "June",
        "July", "August", "September",
        "October", "November", "December"
    ],
    type: 'single',
    hasGrid: true
});

$("#ionrange_5").ionRangeSlider({
    min: 10000,
    max: 100000,
    step: 100,
    postfix: " km",
    from: 55000,
    hideMinMax: true,
    hideFromTo: false
});

$(".dial").knob();

var basic_slider = document.getElementById('basic_slider');

noUiSlider.create(basic_slider, {
    start: 40,
    behaviour: 'tap',
    connect: 'upper',
    range: {
        'min': 20,
        'max': 80
    }
});

var range_slider = document.getElementById('range_slider');

noUiSlider.create(range_slider, {
    start: [40, 60],
    behaviour: 'drag',
    connect: true,
    range: {
        'min': 20,
        'max': 80
    }
});

var drag_fixed = document.getElementById('drag-fixed');

noUiSlider.create(drag_fixed, {
    start: [40, 60],
    behaviour: 'drag-fixed',
    connect: true,
    range: {
        'min': 20,
        'max': 80
    }
});
</script>
<script>
$(document).ready(function() {
    $("#output").hide();
    <?php if (isset($record->hidden_id) || isset($record->id)) : ?>
    $("#output").show();
    <?php endif; ?>
});
var loadFile = function(event) {
    $("#output").show();
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
};

function rmimg() {
    var image = document.getElementById('output');
    image.src = "";
    $("#output").hide();
    $('#old_img_1').val('');
}
</script>
@endsection