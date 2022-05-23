@extends(Backend/Pharmacist/MainTemplate)
<!-- @section(dashboardselected)
active
@endsection -->
@section(title)
Pharmacist | Manage Medicine
@endsection
@section(stylelinks)
<link rel="stylesheet" href="<?= base_url('bootstrap_assets/bootstrap.min.css') ?>">
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
            <?php endif; unset($_SESSION['success']); ?>
@endsection
@section(content)
<div class="mdc-card">
    <div class="row animated fadeInDown">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Medicine List</h5>
                    <div class="ibox-tools">
                        <div style="margin:10px;">
                            
                            <section>
                                <div class="container-fluid d-flex justify-content-end mb-3">
                                    <a href="<?= site_url('index.php/Pharmacist/addmedicine'); ?>">
                                        <button type="button" class="btn btn-w-m btn-primary">
                                            + Add Medicine
                                        </button>
                                    </a>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Medicine Category</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Total Quantity</th>
                                    <th>Sold Quantity</th>
                                    <th style="text-align: center;">Edit</th>
                                    <th style="text-align: center;">Delete</th>
                                    <th>status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($medicines as $medicine): ?>
                                <tr>
                                    <td style="text-align: center;"><?= $medicine->name; ?></td>
                                    <td style="text-align: center;"><?= $this->Pharmacist_model->getcategoryby_id($medicine->category_id)->medicine_category_name; ?></td>
                                    <td style="text-align: center;"><?= $medicine->description; ?></td>
                                    <td style="text-align: center;"><?= $medicine->price; ?></td>
                                    <td style="text-align: center;"><?= $medicine->qty; ?></td>
                                    <td style="text-align: center;"><?= $medicine->sold_qty; ?></td>
                                    <td style="text-align: center;"><a href="<?= base_url('index.php/pharmacist/addmedicine/update/'.$medicine->id); ?>"><button class="btn btn-warning">Edit</button></a></td>
                                    <td style="text-align: center;"><a href="<?= base_url('index.php/pharmacist/del_medicine/'.$medicine->id); ?>"><button class="btn btn-danger">Delete</button></a></td>
                                    <td style="text-align: center;"><span class="badge badge-info"><?= $medicine->status==1 ? 'available' : 'unavailable' ;?></span></td>
                                </tr>

                                <?php endforeach; ?>
                            </tbody>
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
<script src="<?= base_url('bootstrap_assets/jquery.min.js') ?>"></script>

<!-- Popper JS -->
<script src="<?= base_url('bootstrap_assets/popper.min.js') ?>"></script>

<!-- Latest compiled JavaScript -->
<script src="<?= base_url('bootstrap_assets/bootstrap.min.js') ?>"></script>

<script type="text/javascript" src="<?= base_url('pharmacist_assets/abc/datatables.min.js') ?>"></script>

<script>
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            pageLength: 10,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'copy'
                },
                {
                    extend: 'csv'
                },
                {
                    extend: 'excel',
                    title: 'ExampleFile'
                },
                {
                    extend: 'pdf',
                    title: 'ExampleFile'
                },

                {
                    extend: 'print',
                    customize: function(win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });

    });
</script>
@endsection