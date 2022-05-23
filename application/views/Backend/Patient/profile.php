@extends(Backend/Patient/MainTemplate)
@section(profileselected)
active
@endsection
@section(pagetitle)
Profile
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


<div class="wrapper wrapper-content animated fadeInRight">

    <div class="col-lg-12">
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="alert alert-info">
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1">Edit Profile</a></li>
                <li class=""><a data-toggle="tab" href="#tab-2">Change Password</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <div class="col-lg-10 col-md-10 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-1">
                            <form role="form" class="form-horizontal form-groups" action="<?= site_url('index.php/patient/update_profile'); ?>" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-9">
                                        <input autocomplete="off" type="text" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : $data->name ?>" class="form-control">
                                        <div class="invalid-feedback d-block text-danger">
                                            <?= form_error('name'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">Email</label>

                                    <div class="col-sm-9">
                                        <input autocomplete="off" type="email" name="email" class="form-control" value="<?= isset($_POST['email']) ? $_POST['email'] : $data->email; ?>">
                                        <div class="invalid-feedback d-block text-danger">
                                            <?= form_error('email'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="field-ta" class="col-sm-3 control-label">Address</label>

                                    <div class="col-sm-9">
                                        <textarea name="address" class="form-control "><?= isset($_POST['address']) ? $_POST['address'] : $data->address; ?></textarea>
                                        <div class="invalid-feedback d-block text-danger">
                                            <?= form_error('address'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">Phone</label>

                                    <div class="col-sm-9">
                                        <input autocomplete="off" type="text" name="phone" class="form-control" value="<?= isset($_POST['phone']) ? $_POST['phone'] : $data->phone ?>">
                                        <div class="invalid-feedback d-block text-danger">
                                            <?= form_error('phone'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="data_1">
                                    <label for="field-1" class="col-sm-3 control-label">Birth Date</label>
                                    <div class="col-sm-9">
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" autocomplete="off" required name="birth_date" class="form-control" value="<?= isset($_POST['birth_date']) ? $_POST['birth_date'] :  $data->birth_date; ?>">
                                            <div class="invalid-feedback d-block text-danger">
                                                <?= form_error('birth_date'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">Age</label>

                                    <div class="col-sm-9">
                                        <input autocomplete="off" type="number" name="age" class="form-control" value="<?= isset($_POST['age']) ? $_POST['age'] : $data->age ?>">
                                        <div class="invalid-feedback d-block text-danger">
                                            <?= form_error('age'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-3 control-label">Gender</label>
                                    <div class="col-sm-9">
                                        <select name="gender" class="form-control" autocomplete="off">
                                            <option value="">Select Gender</option>
                                            <option value="male" <?php if (isset($_POST['gender'])) {
                                                                        echo $_POST['gender'] == "male" ? "selected" : '';
                                                                    } else {
                                                                        echo $data->gender == "male" ? "selected" : '';
                                                                    } ?>>Male
                                            </option>
                                            <option value="female" <?php if (isset($_POST['gender'])) {
                                                                        echo $_POST['gender'] == "female" ? "selected" : '';
                                                                    } else {
                                                                        echo $data->gender == "female" ? "selected" : '';
                                                                    } ?>>FeMale
                                            </option>
                                        </select>
                                        <div class="invalid-feedback d-block text-danger">
                                            <?= form_error('gender'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-3 control-label">Blood Group</label>
                                    <div class="col-sm-9">
                                        <select name="blood_group" class="form-control" autocomplete="off">

                                            <option value="">Select Blood Group</option>
                                            <option value="A+" <?php if (isset($_POST['blood_group'])) {
                                                                    echo $_POST['blood_group'] == "A+" ? "selected" : '';
                                                                } else {
                                                                    echo $data->blood_group == "A+" ? "selected" : '';
                                                                } ?>>A+</option>
                                            <option value="A-" <?php if (isset($_POST['blood_group'])) {
                                                                    echo $_POST['blood_group'] == "A-" ? "selected" : '';
                                                                } else {
                                                                    echo $data->blood_group == "A-" ? "selected" : '';
                                                                } ?>>A-</option>
                                            <option value="B+" <?php if (isset($_POST['blood_group'])) {
                                                                    echo $_POST['blood_group'] == "B+" ? "selected" : '';
                                                                } else {
                                                                    echo $data->blood_group == "B+" ? "selected" : '';
                                                                } ?>>B+</option>
                                            <option value="B-" <?php if (isset($_POST['blood_group'])) {
                                                                    echo $_POST['blood_group'] == "B-" ? "selected" : '';
                                                                } else {
                                                                    echo $data->blood_group == "B-" ? "selected" : '';
                                                                } ?>>B-</option>
                                            <option value="AB+" <?php if (isset($_POST['blood_group'])) {
                                                                    echo $_POST['blood_group'] == "AB+" ? "selected" : '';
                                                                } else {
                                                                    echo $data->blood_group == "AB+" ? "selected" : '';
                                                                } ?>>AB+</option>
                                            <option value="AB-" <?php if (isset($_POST['blood_group'])) {
                                                                    echo $_POST['blood_group'] == "AB-" ? "selected" : '';
                                                                } else {
                                                                    echo $data->blood_group == "AB-" ? "selected" : '';
                                                                } ?>>AB-</option>
                                            <option value="O+" <?php if (isset($_POST['blood_group'])) {
                                                                    echo $_POST['blood_group'] == "O+" ? "selected" : '';
                                                                } else {
                                                                    echo $data->blood_group == "O+" ? "selected" : '';
                                                                } ?>>O+</option>
                                            <option value="O-" <?php if (isset($_POST['blood_group'])) {
                                                                    echo $_POST['blood_group'] == "O-" ? "selected" : '';
                                                                } else {
                                                                    echo $data->blood_group == "O-" ? "selected" : '';
                                                                } ?>>O-</option>
                                        </select>
                                        <div class="invalid-feedback d-block text-danger">
                                            <?= form_error('blood_group'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Image</label>
                                    <div class="col-sm-8">
                                        <input type="file" onchange="readURL(this)" class="form-control" name="icon">
                                        <div class="invalid-feedback d-block text-danger">
                                            <?php if (isset($_SESSION['upload_error'])) {
                                                echo $_SESSION['upload_error'];
                                                unset($_SESSION['upload_error']);
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-1" style="display:flex;justify-content: center;">
                                        <img id="output" width="60px" src="" alt="">
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-9" style="display: flex;justify-content:center;">
                                        <img src="<?= $data->icon ?>" width="200" height="200" />
                                        <input type="hidden" id="old_img_1" name="old_img" value="<?= $data->icon ?>">
                                    </div>
                                </div>
                                <div class="col-sm-3 control-label col-sm-offset-1">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check"></i> Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        <div class="col-lg-10 col-md-10 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-1">
                            <form role="form" class="form-horizontal form-groups" action="<?= site_url('index.php/patient/update_password'); ?>" method="post">

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">Old Password</label>

                                    <div class="col-sm-9">
                                        <input required autocomplete="off" type="text" name="old_pass" class="form-control" value="<?= isset($_POST['old_pass']) ? $_POST['old_pass'] : ''; ?>" required>

                                        <div class="invalid-feedback text-danger"><?= form_error('old_pass'); ?></div>
                                        <div class="invalid-feedback text-danger"><?php if (isset($_SESSION['pass_error'])) {
                                                                                        echo $_SESSION['pass_error'];
                                                                                    }
                                                                                    unset($_SESSION['pass_error']); ?></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">New Password</label>
                                    <div class="col-sm-9">
                                        <input required autocomplete="off" type="text" name="new_password" class="form-control" value="<?= isset($_POST['new_password']) ? $_POST['new_password'] : ''; ?>" required>

                                        <div class="invalid-feedback text-danger"><?= form_error('new_password'); ?></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">Confirm Password</label>
                                    <div class="col-sm-9">
                                        <input required autocomplete="off" type="text" name="conf_pass" class="form-control" id="field-1" value="<?= isset($_POST['conf_pass']) ? $_POST['conf_pass'] : ''; ?>" required>

                                        <div class="invalid-feedback text-danger"><?= form_error('conf_pass'); ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-3 control-label col-sm-offset-1">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check"></i>Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#output')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection