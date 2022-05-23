@extends(Backend/Admin/MainTemplate)
@section(title)Manage Profile@endsection
@section(content)
<div class="card pb-5 my-2 mx-3 shadow">
    <div class="card-header">
        <h6>Edit Account</h6>
    </div>
    <div class="card-body">
        <form method="post" action="<?= site_url('index.php/admin/edit_account_details');?>">
            <div class="row d-flex justify-content-center">
                <div class="col-8">
                    <div class="form-group">
                        <label for="email">Name:</label>
                        <input type="text" value="<?php
                            if(isset($record->name))
                            {
                                $d=str_replace("'", "",$record->name);
                            }
                            else
                            {
                                $d=set_value('username');
                            }
                        echo $d; ?>" name="username" class="form-control form-control-sm" autocomplete="off" placeholder="" id="email">
                        <div class="invalid-feedback text-danger d-block text-bold">
                               <?= form_error('username'); ?>
                           </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" name="email" class="form-control form-control-sm" placeholder="" value="
                        <?php
                          if(isset($record->email))
                            {
                                $d=str_replace("'", "",$record->email);
                            }
                            else
                            {
                                $d=set_value('email');
                            }
                        echo $d; ?>" autocomplete="off" id="email">
                        <div class="invalid-feedback text-danger d-block text-bold">
                               <?= form_error('email'); ?>
                           </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success">
                        <i class="fa fa-check"></i>&nbsp;
                        Update Profile</button>
                </div>
            </div>

        </form>
    </div>

</div>
<div class="card pb-5 my-2 mx-3 shadow">
    <div class="card-header">
        <h6>Change Password</h6>
    </div>
    <div class="card-body">
        <form method="post" action="<?= site_url('index.php/admin/edit_password');?>">
            <div class="row d-flex justify-content-center">
                <div class="col-8">
                    <div class="form-group">
                        <label for="email">Current Password:</label>
                        <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="" value="<?= set_value('current_pass');?>" name="current_pass" id="email">
                        <?php if(isset($_SESSION['form_err_msg'])): ?>
                        <div class="invalid-feedback text-danger d-block text-bold">
                               <?= $_SESSION['form_err_msg']; ?>
                           </div>
                       <?php endif; unset($_SESSION['form_err_msg']); ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">New Password:</label>
                        <input type="password" name="new_pass" class="form-control form-control-sm" autocomplete="off" value="<?= set_value('new_pass');?>" placeholder="" id="email">
                        <div class="invalid-feedback text-danger d-block text-bold">
                               <?= form_error('new_pass'); ?>
                           </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Confirm New Password:</label>
                        <input type="password" name="conf_pass" class="form-control form-control-sm" autocomplete="off" value="<?= set_value('conf_pass');?>" placeholder="" id="email">
                        <div class="invalid-feedback text-danger d-block text-bold">
                               <?= form_error('conf_pass'); ?>
                           </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success">
                        <i class="fa fa-check"></i>&nbsp;
                        Update Password</button>
                </div>
            </div>

        </form>
    </div>

</div>

@endsection