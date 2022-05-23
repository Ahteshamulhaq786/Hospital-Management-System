@extends(Backend/Admin/MainTemplate)
@section(title)Doctors@endsection
@section(links)
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url('admin_assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')?>">
@endsection
@section(content)
<?php if($this->session->has_userdata('success')): ?>
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-info text-bold text-white"></i> <?= $this->session->flashdata('success');?></h5>
</div>
<?php endif; ?>
<section>
    <div class="container-fluid d-flex justify-content-end mb-3">
        <a href="<?= site_url('index.php/admin/adddoctors');?>">
        <button type="button" class="btn btn-sm btn-info">
            Add Doctor
        </button>
        </a>
    </div>
</section>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Doctor List</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Department</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($records as $record): ?>
                            <tr>
                                <td class="d-flex justify-content-center">
                        <img src="<?= $record->icon; ?>" style="width:60px;height: 60px;">
                    </td>
                                <td><?= $record->name;?></td>
                                <td><?= $this->Admin_model->get_login_details($record->id,'doctor')->email; ?></td>
                                <td><?= $record->phone;?></td>
                                <td><?= $this->Admin_model->getdeptby_id($record->department_id)->name;?>
                                </td>
                                <td class="">
                                    <div class="btn-group d-block">
                                        <div class="container">
                                             <a href="<?= base_url('index.php/admin/edit_doctor/').$record->id; ?>" class="btn btn-success btn-sm">
                                                <i class="fas fa-edit"></i>&nbsp;Edit
                                            </a>
                                            <a href="<?= base_url('index.php/admin/delete_doctor/').$record->id; ?>" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>&nbsp;Delete
                                            </a>
                                        </div>

                                    </div>
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
<script src="<?= base_url('admin_assets/plugins/sweetalert2/sweetalert2.min.js')?>"></script>
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