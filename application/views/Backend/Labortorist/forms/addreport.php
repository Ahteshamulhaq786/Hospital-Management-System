@extends(Backend/Labortorist/MainTemplate)
@section(links)

@endsection
@section(blooddonorselected)
active
@endsection
@section(content)
<div class="container-fluid">
    <h4 class="page-title">Add Blood Donor</h4>
    <div class="row">
        <div class="col-12 mb-3">
            <a href="<?= base_url('index.php/lab/pathology_report'); ?>"><button class="btn btn-primary">Back</button></a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-10">
            <form role="form" class="form-horizontal form-groups" action="<?php echo base_url() ?>index.php/lab/manage_report" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="squareInput">Time</label>
                    <input required autocomplete="off" name="time" value="<?php if (isset($_POST['time'])) {
                                                                                echo $_POST['time'];
                                                                            } else {
                                                                                echo isset($data->time) ? $data->time : '';
                                                                            } ?>" type="time" class="form-control form-control-sm" id="squareInput" placeholder="Enter Donor Name">
                    <span class="text-danger"><?php echo form_error("time"); ?></span>
                </div>

                <div class="form-group">
                    <label for="squareInput">Date</label>
                    <input required autocomplete="off" name="date" value="<?php if (isset($_POST['date'])) {
                                                                                echo $_POST['date'];
                                                                            } else {
                                                                                echo isset($data->date) ? $data->date : '';
                                                                            } ?>" type="date" class="form-control form-control-sm" id="squareInput" placeholder="Enter Donor Name">
                    <span class="text-danger"><?php echo form_error("date"); ?></span>
                </div>

                <div class="form-group">
                    <label for="squareInput">Patients</label>
                    <select name="patient_id" class="form-control form-control-sm" required data-placeholder="Choose a Country..." class="chosen-select" tabindex="2">
                    <option value="">Please Select a Patient</option>
                        <?php foreach ($patients as $patient) : ?>
                            
                            <option value="<?= $patient->id; ?>" <?php if (isset($_POST['patient_id'])) {
                                                                        echo $_POST['patient_id'] == $patient->id ? "selected" : '';
                                                                    } else if (isset($data->patient_id)) {
                                                                        echo $data->patient_id == $patient->id ? "selected" : '';
                                                                    } ?>><?= $patient->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="squareInput">Report Type</label>
                    <select name="report_type" class="form-control form-control-sm" required data-placeholder="Choose a Country..." class="chosen-select" tabindex="2">
                        <option value="">Select Report Type</option>

                        <option value="xray" <?php if (isset($_POST['report_type'])) {
                                                    echo $_POST['report_type'] == 'xray' ? 'selected' : '';
                                                } else if (isset($data->report_type)) {
                                                    echo $data->report_type == "xray" ? "selected" : "";
                                                }
                                                ?>>Xray</option>

                        <option value="blood_test" <?php if (isset($_POST['report_type'])) {
                                                        echo $_POST['report_type'] == 'blood_test' ? 'selected' : '';
                                                    } else if (isset($data->report_type)) {
                                                        echo $data->report_type == "blood_test" ? "selected" : "";
                                                    }
                                                    ?>>Blood Test</option>

                        <option value="urine_test" <?php if (isset($_POST['report_type'])) {
                                                        echo $_POST['report_type'] == 'urine_test' ? 'selected' : '';
                                                    } else if (isset($data->report_type)) {
                                                        echo $data->report_type == "urine_test" ? "selected" : "";
                                                    } ?>>Urine Test</option>

                        <option value="sperm_test" <?php if (isset($_POST['report_type'])) {
                                                        echo $_POST['report_type'] == 'sperm_test' ? 'selected' : '';
                                                    } else if (isset($data->report_type)) {
                                                        echo $data->report_type == "sperm_test" ? "selected" : "";
                                                    } ?>>Sperm Test</option>
                        <option value="other" <?php if (isset($_POST['report_type'])) {
                                                    echo $_POST['report_type'] == 'other' ? 'selected' : '';
                                                } else if (isset($data->report_type)) {
                                                    echo $data->report_type == "other" ? "selected" : "";
                                                } ?>>Other</option>

                    </select>
                    <span class="text-danger"><?php echo form_error("report_type"); ?></span>
                </div>

                <div class="form-group">
                    <label for="squareInput">Document</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="report_file" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <span class="text-danger"><?= isset($_SESSION['upload_error']) ? $_SESSION['upload_error'] : '';
                                                unset($_SESSION['upload_error']); ?></span>
                </div>

                <?php if (isset($data->id)) : ?>
                    <input type="hidden" name="hidden_id" value="<?= $data->id; ?>">
                    <input type="hidden" name="hidden_path" value="<?= $data->report_file; ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label for="squareInput">Document Type</label>
                    <select name="report_file_type" required data-placeholder="Choose a Country..." class="chosen-select form-control form-control-sm" tabindex="2">
                        <option value="">Select Document Type</option>
                        <option value="image" <?php if (isset($_POST['report_file_type'])) {
                                                    echo $_POST['report_file_type'] == 'image' ? 'selected' : '';
                                                } else if (isset($data->report_file_type)) {
                                                    echo $data->report_file_type == "image" ? "selected" : "";
                                                } ?>>Image</option>

                        <option value="doc" <?php if (isset($_POST['report_file_type'])) {
                                                echo $_POST['report_file_type'] == 'doc' ? 'selected' : '';
                                            } else if (isset($data->report_file_type)) {
                                                echo $data->report_file_type == "doc" ? "selected" : "";
                                            } ?>>Doc</option>

                        <option value="pdf" <?php if (isset($_POST['report_file_type'])) {
                                                echo $_POST['report_file_type'] == 'pdf' ? 'selected' : '';
                                            } else if (isset($data->report_file_type)) {
                                                echo $data->report_file_type == "pdf" ? "selected" : "";
                                            } ?>>Pdf</option>

                        <option value="word" <?php if (isset($_POST['report_file_type'])) {
                                                    echo $_POST['report_file_type'] == 'word' ? 'selected' : '';
                                                } else if (isset($data->report_file_type)) {
                                                    echo $data->report_file_type == "word" ? "selected" : "";
                                                } ?>>Word</option>

                        <option value="excel" <?php if (isset($_POST['report_file_type'])) {
                                                    echo $_POST['report_file_type'] == 'excel' ? 'selected' : '';
                                                } else if (isset($data->report_file_type)) {
                                                    echo $data->report_file_type == "excel" ? "selected" : "";
                                                } ?>>Excel</option>

                        <option value="ppt" <?php if (isset($_POST['report_file_type'])) {
                                                echo $_POST['report_file_type'] == 'ppt' ? 'selected' : '';
                                            } else if (isset($data->report_file_type)) {
                                                echo $data->report_file_type == "ppt" ? "selected" : "";
                                            } ?>>Powerpoint</option>


                    </select>
                    <span class="text-danger"><?php echo form_error("report_file_type"); ?></span>
                </div>

                <div class="form-group">
                    <label for="squareInput">Description</label>
                    <textarea name="description" class="" id="" cols="30" rows="3"><?php if (isset($_POST['description'])) {
                                                                                                                    echo $_POST['description'];
                                                                                                                } else {
                                                                                                                    echo isset($data->description) ? $data->description : '';
                                                                                                                } ?></textarea>
                    <span class="text-danger"><?php echo form_error("description"); ?></span>
                </div>



                <?php if (isset($data->id)) { ?>
                    <button type="submit" class="btn btn-warning">Update Report</button>
                <?php } else {
                ?>

                    <button type="submit" class="btn btn-success">Add Report</button>
                <?php
                } ?>



            </form>
        </div>
    </div>
</div><br><br><br>
@endsection

@section(scripts)
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
<script src="https://cdn.tiny.cloud/1/p9ry0giet3a3ydxl6lnrtxva9izsmxcw59k6y6o7cw5sj879/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name'
    });
</script>
@endsection