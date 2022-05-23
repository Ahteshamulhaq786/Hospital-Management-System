@extends(Backend/Admin/MainTemplate)
@section(title)Manage Facility@endsection
@section(links)
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url('admin_assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
@endsection
@section(content)
<?php if ($this->session->has_userdata('success')) : ?>
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> <?= $this->session->flashdata('success'); ?></h5>
    </div>
<?php endif; ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Manage Facilities</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form role="form" action="<?= site_url('index.php/admin/manage_facilities');?>" method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="" class="col-12 col-md-3 text-center control-label">Title</label>

                <div class="col-12 col-md-7">
                    <input required autocomplete="off" type="text" value="<?php echo isset($record->title) ? $record->title : set_value('title');?>" name="title" class="form-control" id="name" required>
                    <div class="invalid-feedback text-danger d-block text-bold">
                        <?= form_error('title'); ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="" class="col-12 col-md-3 text-center control-label">Description</label>

                <div class="col-12 col-md-7">
                    <textarea name="description" class="form-control" id="address" rows="5"><?php echo isset($record->description) ? $record->description : set_value('description');?></textarea>
                    <div class="invalid-feedback text-danger d-block text-bold">
                        <?= form_error('description'); ?>
                    </div>
                </div>
            </div>

            <?php if(isset($_GET['dept_id'])): ?>
            <div class="form-group row">
                <label for="" class="col-12 col-md-3 text-center control-label">Department</label>

                <div class="col-12 col-md-7">
                    <input type="text" value="<?php echo $this->Admin_model->getdeptby_id($_GET['dept_id'])->name; ?>" class="form-control" id="name" disabled>
                </div>
            </div>

        <?php endif; ?>


            <div class="form-group row">
                <label class="col-sm-3 control-label text-center"></label>
                <div class="col-sm-7">

                    <?php if(isset($record->id) || isset($record->hidden_id)){ ?>
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

        <?php if(isset($record->hidden_id)): ?>
            <input type="hidden" name="hidden_id" value="<?= $record->hidden_id; ?>">
        <?php endif; ?>

        <?php if(isset($_GET['dept_id'])): ?>

        <input type="hidden" name="department_id" value="<?php echo isset($_GET['dept_id']) ? $_GET['dept_id'] : set_value('department_id');?>">

    <?php endif; ?>

        </form>

    </div>
</div>
</div>
<!-- /.card-body -->
</div>
@endsection
@section(scripts)
<script src="<?= base_url('admin_assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<script>
    function loadFile(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };

    function rmimg() {
        var image = document.getElementById('output');
        image.src = "";
        $("#old_img_1").val('');
    }
</script>
<?php if ($this->session->has_userdata('success')) : ?>
    <script type="text/javascript">
        $(document).ready(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'success',
                title: '<?= $this->session->flashdata('success'); ?>'
            });
        });
    </script>
<?php endif;
unset($_SESSION['success']); ?>
@endsection