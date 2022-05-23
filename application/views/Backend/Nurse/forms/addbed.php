@extends(Backend/Nurse/MainTemplate)
<!-- @section(dashboardselected)
active
@endsection -->
@section(title)
+ ADD Bed
@endsection
@section(stylelinks)

<link rel="stylesheet" href="<?= base_url('bootstrap_assets/bootstrap.min.css')?>">


@endsection


@section(content)

<div class="mdc-card">
    <div>
        <a href="<?= base_url('index.php/Nurse/managebed') ?>">
            <button type="button" class="btn btn-w-m btn-primary">Back</button>
        </a>
    </div>
    <br>
    <form>
        <div class="form-group" style="margin-right: 25px;">
            <label for="exampleFormControlInput1">Bed Number:</label>
            <input required autocomplete="off" type="text" class="form-control" id="exampleFormControlInput1">
        </div><br>
        <div class="form-group" style="margin-right: 25px;">
        <label for="exampleFormControlInput1">Type:</label>
            <select required autocomplete="off" class="form-control" id="exampleFormControlSelect1">
                <option></option>
                <option>Ward</option>
                <option>Cabin</option>
                <option>ICU</option>
            </select>
        </div><br>
        <div class="form-group" style="margin-right: 25px;">
            <label for="exampleFormControlTextarea1">Description:</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div><br>
        
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" class="btn btn-primary">
                     Save </button>
            </div>
        </div>
    </form>
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

@endsection