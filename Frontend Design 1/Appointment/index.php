<?php include('header.php') ?>

<section class="slice--offset parallax-section parallax-section-xl b-xs-bottom custom-page-head"
    style="background-image: url('https://creativeitem.com/demo/bayanno/assets/frontend/default/images/img-15.jpg');">
    <div class="container">
        <div class="row py-3">
            <div class="col-lg-12">
                <h1 class="heading text-uppercase c-white">
                    Appointment                </h1>

                <span class="clearfix"></span>

                <div class="">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="https://creativeitem.com/demo/bayanno/index.php/home">
                            Home                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                        Appointment                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="slice sct-color-2 b-xs-bottom">
    <div class="container">
        <div class="section-title section-title--style-1 text-center mb-3">
            <h3 class="heading heading-2 strong-400">
                Make An Appointment            </h3>
            <span class="section-title-delimiter clearfix d-none"></span>
        </div>
    </div>
</section>
<section class="slice sct-color-2">
    <div class="container container-xs">
        <div class="row">
            <div class="col">
                <form class="form-default" role="form"
                    action="https://creativeitem.com/demo/bayanno/index.php/home/make_an_appointment"
                        method="post"
                            enctype="multipart/form-data">

                    <div class="form-group">
                        <div class="checkbox checkbox-inline">
                            <input type="radio" name="patient_type" id="radioExample_4a"
                                   checked="checked" value="new">
                            <label for="radioExample_4a">
                                New Patient                            </label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input type="radio" name="patient_type" id="radioExample_4b"
                                value="old">
                            <label for="radioExample_4b">
                                Old Patient                            </label>
                        </div>
                    </div>

                    <div id="old_patient">
                        <div class="form-group">
                            <label for="" class="text-uppercase  c-gray-light">
                                Patient Code                            </label>
                            <span id="code_error" style="font-size: 12px; color: #d50000;
                                margin-left: 15px;">
                                Invalid Patient Code                            </span>
                            <input type="text" class="form-control input-lg" name="code"
                                onblur="check_code(this.value)" value="">
                            <span style="font-size: 12px;">
                            <a href="https://creativeitem.com/demo/bayanno/index.php/login" target="_blank">
                                Log In To Patient Account To See Your Code                            </a>
                        </span>
                        </div>
                    </div>

                    <div id="new_patient">
                        <div class="form-group">
                            <label for="" class="text-uppercase  c-gray-light">
                                Name                            </label>
                            <input type="text" class="form-control input-lg" placeholder=""
                                   name="name">
                        </div>

                        <div class="form-group">
                            <label for="" class="text-uppercase c-gray-light">
                                Email                            </label>
                            <input type="email" class="form-control input-lg" placeholder=""
                                   name="email">
                        </div>

                        <div class="form-group">
                            <label for="" class="text-uppercase c-gray-light">
                                Phone                            </label>
                            <input type="text" class="form-control input-lg" placeholder=""
                                   name="phone">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="text-uppercase c-gray-light">
                            Date                        </label>
                        <input type="text" class="form-control input-lg datepicker" placeholder=""
                            name="timestamp">
                    </div>

                    <div class="form-group">
                        <label for="" class="text-uppercase c-gray-light">
                            Department                        </label>
                        <select class="form-control" name="department_id" id="dept_select"
                            onchange="get_doctors(this.value)">
                            <option value="0">Select A Department</option>
                                                            <option value="1"
                                                                    >
                                    Anesthetics                                </option>
                                                            <option value="2"
                                                                    >
                                    Cardiology                                </option>
                                                            <option value="3"
                                                                    >
                                    Gastroenterology                                </option>
                                                    </select>
                    </div>

                    <div class="form-group">
                        <label for="" class="text-uppercase c-gray-light">
                            Doctor                        </label>
                        <div id="doctor_list">
                                                            <input type="text" class="form-control input-lg"
                                value="Select A Department First" disabled>
                                                    </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="text-uppercase c-gray-light">
                            Message                        </label>
                        <textarea class="form-control no-resize" rows="5" name="message"
                                  placeholder="Your Message To The Doctor"></textarea>
                    </div>

                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LePbzgUAAAAAPoKsV10vpTe74Jv67R2ETggFiVC"></div>
                    </div>
                    <button type="submit" class="btn btn-styled btn-base-1"
                            style="cursor: pointer;">
                        <i class="fa fa-calendar mr-1"></i> Book Now                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>

    $(document).ready(function () {
       $('#old_patient').hide();
        $('#code_error').hide();

       $('input[type=radio][name=patient_type]').change(function () {
           if (this.value == 'new') {
               $('#old_patient').hide();
               $('#new_patient').fadeIn();
           } else if (this.value == 'old') {
               $('#new_patient').hide();
               $('#old_patient').fadeIn();
           }
       });

    });

    function get_doctors(department_id) {

        $.ajax({
            url: 'https://creativeitem.com/demo/bayanno/index.php/home/get_doctors_of_department/' + department_id,
            success: function (response) {
                jQuery('#doctor_list').html(response);
            }
        });
    }

    function check_code(code) {
        $.ajax({
            url: 'https://creativeitem.com/demo/bayanno/index.php/home/check_patient_code/' + code
        }).done(function (response) {
            if (response == 1) {
                $('#code_error').hide();
            } else if (response == 0) {
                $('#code_error').fadeIn();
            }
        });
    }

</script>

<?php include('footer.php') ?>