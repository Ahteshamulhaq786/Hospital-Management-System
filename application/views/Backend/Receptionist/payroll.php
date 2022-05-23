@extends(Backend/Receptionist/MainTemplate)
@section(payrollselected)
active
@endsection
@section(pagetitle)
Payoll List
@endsection
@section(stylelinks)
<link href="<?= base_url('doctor_assets/css/plugins/summernote/summernote.css') ?>" rel="stylesheet">
<link href="<?= base_url('doctor_assets/css/plugins/summernote/summernote-bs3.css') ?>" rel="stylesheet">
@endsection

@section(content)


<div class="wrapper wrapper-content animated fadeInRight">


    <div class="col-lg-12">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1">Payroll List</a></li>
                <li class=""><a data-toggle="tab" href="#tab-2">View Payroll Details</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        <div>#</div>
                                    </th>
                                    <th>
                                        <div>ID</div>
                                    </th>
                                    <th>
                                        <div>Receptionis</div>
                                    </th>
                                    <th>
                                        <div>Summary</div>
                                    </th>
                                    <th>
                                        <div>Date</div>
                                    </th>
                                    <th>
                                        <div>Status</div>
                                    </th>
                                    <th>
                                        <div>Option</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>c44c3ab</td>
                                    <td>
                                        Micheal Pewd </td>
                                    <td>
                                        <div>
                                            <table style="width: 100%;">
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: right;">Basic Salary</td>
                                                        <td style="width: 15%; text-align: right;"> : </td>
                                                        <td style="text-align: right;">750</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: right;">Total Allowance</td>
                                                        <td style="width: 15%; text-align: right;"> : </td>
                                                        <td style="text-align: right;">150</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: right;">Total Deduction</td>
                                                        <td style="width: 15%; text-align: right;"> : </td>
                                                        <td style="text-align: right;">30</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <hr style="margin: 5px 0px;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: right;">Net Salary</td>
                                                        <td style="width: 15%; text-align: right;"> : </td>
                                                        <td style="text-align: right;">870</td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                    <td>
                                        March, 2017 </td>
                                    <td>
                                        <div class="label label-danger">Unpaid</div>
                                    </td>
                                    <td>
                                    <a class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil"></i>&nbsp;
                                        Edit </a>
                                    <a class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i>&nbsp;
                                        Delete </a>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        <div id="payroll_print">
                            <table width="100%" border="0">
                                <tbody>
                                    <tr>
                                        <td align="right">
                                            <h4>Payroll Code : c44c3ab</h4>
                                            <h5>Employee : Micheal Pewd</h5>
                                            <h5>Account Type : Doctor</h5>
                                            <h5>Date : March, 2017</h5>
                                            <h5>
                                                Status :
                                                Unpaid </h5>
                                        </td>
                                        
                                    </tr>
                                </tbody>
                            </table>

                            <hr><br>
                            <h4 style="text-align: center;">Allowance Summary</h4>
                            <div>
                            </div>
                            <table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th width="60%">Type</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>
                                            allowance 1 </td>
                                        <td class="text-right">
                                            100 </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td>
                                            allowance2 </td>
                                        <td class="text-right">
                                            50 </td>
                                    </tr>

                                </tbody>
                            </table>

                            <br>
                            <h4 style="text-align: center;">Deduction Summary</h4>
                            <div>
                            </div>
                            <table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th width="60%">Type</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>
                                            deduction1 </td>
                                        <td class="text-right">
                                            10 </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td>
                                            deduction2 </td>
                                        <td class="text-right">
                                            20 </td>
                                    </tr>

                                </tbody>
                            </table>

                            <br>
                            <h3 style="text-align: center; margin-bottom: 0px;">Payroll Summary</h3>
                            <center>
                                <hr style="margin: 5px 0px 5px 0px; width: 50%;">
                            </center>
                            <center>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="font-weight: 600; font-size: 15px; color: #000;">
                                                Basic Salary</td>
                                            <td style="font-weight: 600; font-size: 15px; color: #000; width: 15%;
                        text-align: center;"> : </td>
                                            <td style="font-weight: 600; font-size: 15px; color: #000;
                        text-align: right;">750</td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: 600; font-size: 15px; color: #000;">
                                                Total Allowance</td>
                                            <td style="font-weight: 600; font-size: 15px; color: #000;
                        width: 15%; text-align: center;"> : </td>
                                            <td style="font-weight: 600; font-size: 15px; color: #000;
                        text-align: right;">150</td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: 600; font-size: 15px; color: #000;">
                                                Total Deduction</td>
                                            <td style="font-weight: 600; font-size: 15px; color: #000;
                        width: 15%; text-align: center;"> : </td>
                                            <td style="font-weight: 600; font-size: 15px; color: #000;
                        text-align: right;">30</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <hr style="margin: 5px 0px;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: 600; font-size: 15px; color: #000;">
                                                Net Salary</td>
                                            <td style="font-weight: 600; font-size: 15px; color: #000;
                        width: 15%; text-align: center;"> : </td>
                                            <td style="font-weight: 600; font-size: 15px; color: #000;
                        text-align: right;">
                                                870 </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </center>
                            <br>
                        </div>
                        <a onclick="PrintElem('#payroll_print')" class="btn btn-primary hidden-print">
        <i class="fa fa-print"></i>&nbsp;
        Print Payroll Details    </a>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
</div>
@endsection

@section(scriptlinks)
<!-- SUMMERNOTE -->
<script src="<?= base_url('doctor_assets/js/plugins/summernote/summernote.min.js') ?>"></script>

<script>
    $(document).ready(function() {

        $('.summernote').summernote();

    });
</script>
@endsection