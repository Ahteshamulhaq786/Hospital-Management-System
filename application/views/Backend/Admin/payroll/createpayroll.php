@extends(Backend/Admin/MainTemplate)
@section(links)
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('admin_assets/plugins/select2/css/select2.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('admin_assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">
@endsection
@section(title)Create Payroll@endsection
@section(content)
<form action="" method="">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-2 col-md-offset-2 col-12">
            <p>Select an employee</p>
            <select class="form-control select2" required">
                <option value="">Select An Employee</option>
                <optgroup label="Doctor">

                    <option value="doctor-1">
                        - Micheal Pewd</option>


                    <option value="doctor-2">
                        - Erich Mcbride</option>

                </optgroup>
                <optgroup label="Nurse">

                    <option value="nurse-1">
                        - Jenelia Cruise</option>

                </optgroup>
                <optgroup label="Pharmacist">

                    <option value="pharmacist-1">
                        - Jennifer Lopez</option>

                </optgroup>
                <optgroup label="Laboratorist">

                    <option value="laboratorist-1">
                        - Jonny Ive</option>

                </optgroup>
                <optgroup label="Receptionist">

                    <option value="receptionist-1">
                        - Jane Doe</option>

                </optgroup>
                <optgroup label="Accountant">

                    <option value="accountant-1">
                        - John Doe</option>

                </optgroup>

            </select>
        </div>
        <div class="col-md-2 col-md-offset-2 col-12">
            <p>Select month</p>
            <select name="month" class="form-control select2" required>
                <option value="">Select A Month</option>
                <option value="1">
                    January </option>
                <option value="2">
                    February </option>
                <option value="3">
                    March </option>
                <option value="4">
                    April </option>
                <option value="5">
                    May </option>
                <option value="6">
                    June </option>
                <option value="7">
                    July </option>
                <option value="8">
                    August </option>
                <option value="9">
                    September </option>
                <option value="10">
                    October </option>
                <option value="11">
                    November </option>
                <option value="12">
                    December </option>
            </select>
        </div>
        <div class="col-md-2 col-md-offset-2 col-12">
            <p>Select year</p>
            <select name="year" class="form-control select2" required>
                <option value="">Select A Year</option>
                <option value="2017">
                    2017 </option>
                <option value="2018">
                    2018 </option>
                <option value="2019">
                    2019 </option>
                <option value="2020">
                    2020 </option>
                <option value="2021">
                    2021 </option>
                <option value="2022">
                    2022 </option>
                <option value="2023">
                    2023 </option>
                <option value="2024">
                    2024 </option>
                <option value="2025">
                    2025 </option>
                <option value="2026">
                    2026 </option>
            </select>
        </div>
        <div class="col-md-2 col-md-offset-2 col-12">
            <div class="container-fluid " style="margin-top: 32px;">
                <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">
                    Generate Payslip
                </button>
            </div>

        </div>
    </div>
</form>
<hr class="my-5">
<section>
    <div class="row px-1 mt-3 pb-2 justify-content-center">
        <div class="col-md-5 col-md-offset-1 col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Allowances</h4>
                </div>
                <div class="card-body">
                    <form class="form-inline">
                        <input type="text" class="form-control" placeholder="Type">
                        <input type="text" class="form-control ml-5" placeholder="Amount">
                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-sm btn-primary">Add Allowances</button>
                    <button type="button" class="btn btn-sm btn-secondary">Calculate Total Allowance</button>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-md-offset-1 col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Deductions</h4>
                </div>
                <div class="card-body">
                    <form class="form-inline">
                        <input type="text" class="form-control" placeholder="Type">
                        <input type="text" class="form-control ml-5" placeholder="Amount">
                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-sm btn-primary">Add Deductions</button>
                    <button type="button" class="btn btn-sm btn-secondary">Calculate Total Deductions</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Payroll Summary</h4>
                </div>
                <div class="card-body">
                    <form action="" class="form-inline">

                        <label class="col-md-3 col-12 pr-3 mb-4" for="email" style="justify-content: flex-end;">Basic</label>
                        <input type="text" value="0" class="form-control col-md-7 col-12 mb-4" placeholder="" id="email">

                        <label class="col-md-3 col-12 pr-3 mb-4" for="email" style="justify-content: flex-end;">Total Allowance</label>
                        <input type="text" value="0" disabled class="form-control col-md-7 col-12 mb-4" placeholder="" id="email">

                        <label class="col-md-3 col-12 pr-3 mb-4" for="email" style="justify-content: flex-end;">Total Deduction</label>
                        <input type="text" value="0" disabled class="form-control col-md-7 col-12 mb-4" placeholder="" id="email">

                        <label class="col-md-3 col-12 pr-3 mb-4" for="email" style="justify-content: flex-end;">Net Salary</label>
                        <input type="text" value="0" disabled class="form-control col-md-7 col-12 mb-4" placeholder="" id="email">


                        <label class="col-md-3 col-12 pr-3 mb-4" for="email" style="justify-content: flex-end;">Status</label>
                        <select class="form-control col-md-7 col-12 mb-4" id="sel1">
                            <option>Paid</option>
                            <option>Unpaid</option>

                        </select>


                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-sm btn-primary">Add Allowances</button>
                    <button type="button" class="btn btn-sm btn-secondary">Calculate Total Allowance</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section(scripts)
<!-- Select2 -->
<script src="<?= base_url('assets/plugins/select2/js/select2.full.min.js'); ?>"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2();

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    })
</script>
@endsection