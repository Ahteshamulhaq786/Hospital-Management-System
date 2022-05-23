@extends(Backend/Admin/MainTemplate)
@section(title)Manage Department@endsection
@section(links)
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url('admin_assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')?>">
@endsection
@section(content)
<?php if($this->session->has_userdata('success')): ?>
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-info"></i> <?= $this->session->flashdata('success');?></h5>
</div>
<?php endif; ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Manage Department</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form method="post" action="<?= site_url('index.php/admin/manage_depts');?>" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-sm-3 control-label text-center">Name</label>
                <div class="col-sm-7">
                    <input required autocomplete="off" type="text" value="<?php
                    if(isset($record->name))
                    {
                        $d=$record->name;
                    }
                    else
                    {
                        $d=set_value('name');
                    }
                    echo $d; ?>"
                    class="form-control" name="name">
                    <div class="invalid-feedback text-danger d-block text-bold">
                        <?= form_error('name'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label text-center">Description</label>

                <div class="col-sm-7">
                    <?php
                            if(isset($record->description))
                            {
                                $d=$record->description;
                            }
                            else
                            {
                                $d=set_value('description');
                            }
                   ?>
                    <textarea class="form-control" name="description" rows="3"><?=$d;?></textarea>

                    <div class="invalid-feedback text-danger d-block text-bold">
                        <?= form_error('description'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label text-center">Icon</label>
                <div class="col-sm-7">
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                            <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                            <span class="fileinput-exists">Change</span>
                            <input type="file" class="custom-file-input" accept="image/*" name="icon" id="file" onchange="loadFile(event)">
                        </span>
                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" onclick="rmimg()" data-dismiss="fileinput">Remove</a>
                    </div>
                    <?php if(isset($upload_errors)): ?>
                    <div class="invalid-feedback text-danger d-block text-bold">
                        <?= $upload_errors; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php
                if(isset($record->icon))
                {
                    $d=$record->icon;
                }
                else
                {
                    $d=set_value('old_img')=='' ? '' : set_value('old_img');
                }
                ?>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label text-center"></label>
                <div class="col-sm-7" style="display: flex;justify-content:center;">
                    <img id="output" src="<?= $d;?>" width="200" height="200" />
                </div>
            </div>
        </div>
        <input type="hidden" id="old_img_1" name="old_img" value="<?= $d; ?>">
        <div class="form-group row">
            <label class="col-sm-3 control-label text-center"></label>
            <div class="col-sm-7">
                <?php if(isset($record->id) || isset($hidden_id)){ ?>
                <button type="submit" class="btn btn-warning text-white">

                <i class="fa fa-check"></i>&nbsp;&nbsp;Update</button>

            <?php } else { ?>

<button type="submit" class="btn btn-success">

                <i class="fa fa-plus"></i>&nbsp;&nbsp;Add</button>
            <?php } ?>
            </div>
        </div>
        <?php if(isset($record->id)): ?>
        <input type="hidden" name="hidden_id" value="<?= $record->id; ?>">
    <?php endif; ?>

    <?php if(isset($hidden_id)): ?>
        <input type="hidden" name="hidden_id" value="<?= $hidden_id; ?>">
    <?php endif; ?>
    </form>
</div>
</div>
</div>
<!-- /.card-body -->
</div>
@endsection
@section(scripts)
<script src="<?= base_url('admin_assets/plugins/sweetalert2/sweetalert2.min.js')?>"></script>
<script>
function loadFile(event) {
var image = document.getElementById('output');
image.src = URL.createObjectURL(event.target.files[0]);
};
function rmimg(){
var image = document.getElementById('output');
image.src = "";
$("#old_img_1").val('');
}
</script>
<?php if($this->session->has_userdata('success')): ?>
<script type="text/javascript">
$(document).ready(function(){
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000
});
Toast.fire({
icon: 'success',
title: '<?= $this->session->flashdata('success');?>'
});
});
</script>
<?php endif; unset($_SESSION['success']); ?>
@endsection