@extends(Backend/Pharmacist/MainTemplate)
<!-- @section(dashboardselected)
active
@endsection -->
@section(title)
Medicine Category
@endsection

@section(stylelinks)
<link rel="stylesheet" href="<?= base_url('bootstrap_assets/bootstrap.min.css')?>">
<link href="<?= base_url('pharmacist_assets/abc/jquery.dataTables.min.css') ?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?= base_url('pharmacist_assets/abc/bs4.datatables.min.css') ?>" />
<style type="text/css">
select.custom-select.custom-select-sm.form-control.form-control-sm {
    width: 50% !important;
}

li.paginate_button.page-item {
    background: none !important;
    border: none !important;
    padding: 2px !important;
}
</style>

@endsection
@section(alert)
<?php if ($this->session->has_userdata('success')) : ?>
                                <div class="alert alert-warning alert-dismissible mx-5">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <p class="m-0">
                                        <?= $this->session->flashdata('success'); ?></p>
                                </div>
            <?php endif; unset($_SESSION['success']);  ?>
@endsection

@section(content)

<div class="mdc-card">
    <div class="row animated fadeInDown">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Medicine Category List</h5>
                    <div class="ibox-tools">
                        <div style="margin:10px;">
                            <a href="<?= base_url('index.php/Pharmacist/addmedicinecategory') ?>">
                                <button type="button" class="btn btn-w-m btn-primary">+ Add Medicine Category</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Medicine Category Name</th>
                                    <th style="text-align: center;">Medicine Category Description</th>
                                    <th style="text-align: center;">Option</th>
                                    <th style="text-align: center;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($medicines_category as $medicine): ?>

                                <tr>
                                    <td style="text-align: center;"><?= $medicine->medicine_category_name; ?></td>
                                    <td style="text-align: center;"><?= $medicine->medicine_category_description; ?></td>
                                    <td style="text-align: center;"><a href="<?= base_url('index.php/pharmacist/addmedicinecategory/update/'.$medicine->id); ?>"><button class="btn btn-warning">Edit</button></a>&nbsp;&nbsp;<a href="<?= base_url('index.php/pharmacist/delete_medicine_category/'.$medicine->id); ?>"><button class="btn btn-danger">Delete</button></a></td>
                                    <td style="text-align: center;"><span class="badge badge-info"><?= $medicine->status==1 ? 'available' : 'unavailable' ;?></span></td>
                                </tr>
                                
                                <?php endforeach; ?>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</div>


@endsection

@section(scriptlinks)
<!-- jQuery library -->
<script src="<?= base_url('bootstrap_assets/jquery.min.js')?>"></script>

<!-- Popper JS -->
<script src="<?= base_url('bootstrap_assets/popper.min.js')?>"></script>

<!-- Latest compiled JavaScript -->
<script src="<?= base_url('bootstrap_assets/bootstrap.min.js')?>"></script>

<!-- Yha CSV Vala Script tha jo ab hataya meny  -->

<!-- Delete Button Link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- delete button -->
<script>  
      $(document).ready(function(){  
           $('.delete_data').click(function(){  
                var id = $(this).attr("id");  
                if(confirm("Are you sure you want to delete this?"))  
                {  
                     window.location="<?php echo base_url(); ?>index.php/Pharmacist/delete_medicine_category_data/"+id;  
                }  
                else  
                {  
                     return false;  
                }  
           });  
      });  
      </script>
@endsection