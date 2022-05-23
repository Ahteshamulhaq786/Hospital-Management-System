@extends(Backend/Admin/MainTemplate)
@section(title)System Settings@endsection
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
        <h3 class="card-title">General Settings</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <form method="post" action="<?= site_url('index.php/admin/update_sys_settings');?>" enctype="multipart/form-data">
            <div class="form-group row">
                    <label class="col-sm-3 control-label text-center">System Name</label>
                    <div class="col-sm-7">
                        <input required autocomplete="off" type="text" value="<?php
                            if(isset($record->system_name))
                            {
                                $d=$record->system_name;
                            }
                            else
                            {
                                $d=set_value('system_name');
                            }
                        echo $d; ?>"
                        class="form-control" name="system_name">
                        <div class="invalid-feedback text-danger d-block text-bold">
                               <?= form_error('system_name'); ?>
                           </div>
                    </div>

            </div>
            <div class="form-group row">
                    <label class="col-sm-3 control-label text-center">System Title</label>
                    <div class="col-sm-7">
                        <input required autocomplete="off" type="text" value="<?php
                            if(isset($record->system_title))
                            {
                                $d=$record->system_title;
                            }
                            else
                            {
                                $d=set_value('system_title');
                            }
                        echo $d; ?>"
                        class="form-control" name="system_title">
                         <div class="invalid-feedback text-danger d-block text-bold">
                               <?= form_error('system_title'); ?>
                           </div>
                    </div>
            </div>
            <div class="form-group row">
                    <label class="col-sm-3 control-label text-center">Address</label>
                    <div class="col-sm-7">
                        <input  required autocomplete="off" type="text" value="<?php
                            if(isset($record->system_address))
                            {
                                $d=$record->system_address;
                            }
                            else
                            {
                                $d=set_value('system_address');
                            }
                        echo $d; ?>"
                        class="form-control" name="system_address">
                        <div class="invalid-feedback text-danger d-block text-bold">
                               <?= form_error('system_address'); ?>
                           </div>
                    </div>
            </div>
            <div class="form-group row">
                    <label class="col-sm-3 control-label text-center">Phone</label>
                    <div class="col-sm-7">
                        <input required autocomplete="off" type="text" value="<?php
                            if(isset($record->phone))
                            {
                                $d=$record->phone;
                            }
                            else
                            {
                                $d=set_value('phone');
                            }
                        echo $d; ?>" class="form-control" name="phone">
                        <div class="invalid-feedback text-danger d-block text-bold">
                               <?= form_error('phone'); ?>
                        </div>
                    </div>
            </div>
            <div class="form-group row">
                    <label class="col-sm-3 control-label text-center">Currency</label>
                    <div class="col-sm-7">
                        <input required autocomplete="off" type="text" value="<?php
                            if(isset($record->system_currency))
                            {
                                $d=$record->system_currency;
                            }
                            else
                            {
                                $d=set_value('system_currency');
                            }
                        echo $d; ?>" class="form-control" name="system_currency">
                        <div class="invalid-feedback text-danger d-block text-bold">
                               <?= form_error('system_currency'); ?>
                        </div>
                    </div>
            </div>
            <div class="form-group row">
                    <label class="col-sm-3 control-label text-center">System Email</label>
                    <div class="col-sm-7">
                        <input required autocomplete="off" type="text" value="<?php
                            if(isset($record->system_email))
                            {
                                $d=$record->system_email;
                            }
                            else
                            {
                                $d=set_value('system_email');
                            }
                        echo $d; ?>" class="form-control" name="system_email">
                        <div class="invalid-feedback text-danger d-block text-bold">
                               <?= form_error('system_email'); ?>
                        </div>
                    </div>
            </div>
            <div class="form-group row">
                    <label class="col-sm-3 control-label text-center">New Logo</label>
                    <div class="col-sm-7">
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput">
                                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                <span class="fileinput-filename"></span>
                                            </div>
                                            <span class="input-group-addon btn btn-default btn-file">
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" class="custom-file-input" accept="image/*" name="logo" id="file" onchange="loadFile(event)">
                                            </span>
                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" onclick="rmimg()" data-dismiss="fileinput">Remove</a>
                                        </div>
                                                    <?php if(isset($_GET['upload_error'])): ?>
            <div class="invalid-feedback text-danger d-block text-bold">
            <?= $_GET['upload_error']; ?>
                        </div>
<?php endif; ?>
                                    </div>

                                        <?php 
                                            if(isset($record->image_path))
                                            {
                                                $d=$record->image_path;
                                            }
                                            else
                                            {
                                                $d=set_value('old_img');
                                            }
                                        ?>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-center">Previous Logo</label>
                                    <div class="col-sm-7" style="display: flex;justify-content:center;">
                                        <img id="output" src="<?= $d;?>" width="200" height="200" />
                                    </div>
                                </div>
            </div>
            <input type="hidden" id="old_img_1" name="old_img" value="<?= $d; ?>">
            <div class="form-group row">
                    <label class="col-sm-3 control-label text-center"></label>
                    <div class="col-sm-7">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Update</button>
                    </div>
            </div>
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