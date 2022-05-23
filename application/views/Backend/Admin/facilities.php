@extends(Backend/Admin/MainTemplate)
@section(title)Department Facilities | <small><?= $dept_facility;?></small>@endsection
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
<section>
    <div class="container-fluid d-flex justify-content-end mb-3">
        <?php if(isset($records[0])): ?>
        <a href="<?= site_url('index.php/admin/addfacilities?dept_id='.$records[0]->department_id); ?>">
        <?php endif; ?>

        <?php if(isset($department_id)): ?>
        <a href="<?= site_url('index.php/admin/addfacilities?dept_id='.$department_id); ?>">
        <?php endif; ?>
        
        <button type="button" class="btn btn-sm btn-info">
            Add Department Facility
        </button>
        </a>
    </div>
</section>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Nurse List</h3>
        
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th:>               
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($records as $record): ?>
                <tr>
                                <td><?= $record->title;?></td>
                                <td style="max-width: 530px;"><?= $record->description;?></td>
                    <td>
                                <a href="<?= base_url('index.php/admin/edit_facility/').$record->id; ?>" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit"></i>&nbsp;Edit
                                </a>

                    </td>

                    <td>
                                <a href="<?= base_url('index.php/admin/delete_facility/').$record->id; ?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-edit"></i>&nbsp;Delete
                                </a>
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