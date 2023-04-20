<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Add Assign Bonus
                </h2>
                <!-- <a href="<?= base_url('admin/users/'); ?>" class="btn bg-deep-orange waves-effect pull-right">Users List</a> -->
            </div>
            <div class="body">

                <div class="row clearfix">


                    <div class="col-md-12">
                        <?php if (isset($msg) || validation_errors() !== '') : ?>
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                <?= validation_errors(); ?>
                                <?= isset($msg) ? $msg : ''; ?>
                            </div>
                        <?php endif; ?>
                    </div>


                    <?php echo form_open(base_url('admin/appraisal/add_assign_bonus/' . $id), 'class="form-horizontal"');  ?>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="username">Select Emplyoee</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick live_search department_change" data-live-search="true" name="app_employee" required>
                                        <?php foreach ($employee as $group) : ?>
                                            <option value="<?= $group['id']; ?>" <?= ($department['app_employee'] == $group['id'] ? 'selected' : '') ?>><?= $group['emp_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="username">Select 1st Appraiser</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick live_search department_change" data-live-search="true" name="app_teamleader" required>
                                        <!-- <option value="">-- Please select --</option> -->
                                        <?php foreach ($employee as $group) : ?>
                                            <option value="<?= $group['id']; ?>" <?= ($department['app_teamleader'] == $group['id'] ? 'selected' : '') ?>><?= $group['emp_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="username">Select 2nd Appraiser</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick live_search department_change" data-live-search="true" name="app_member" required>
                                        <!-- <option value="">-- Please select --</option> -->
                                        <?php foreach ($employee as $group) : ?>
                                            <option value="<?= $group['id']; ?>" <?= ($department['app_member'] == $group['id'] ? 'selected' : '') ?>><?= $group['emp_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="username">Choose Sheet</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick live_search department_change" data-live-search="true" name="sheet_id" required>
                                        <!-- <option value="">-- Please select --</option> -->
                                        <?php foreach ($attribute as $group) : ?>
                                            <option value="<?= $group['id']; ?>" <?= ($department['sheet_id'] == $group['id'] ? 'selected' : '') ?>><?= $group['attribute_title']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="group">Last Increment</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" name="last_increment" class="form-control" value="<?= ($department['last_increment']) ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="username">Choose Year</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick live_search department_change" data-live-search="true" name="sess_year" required>
                                        <option value="2019" <?= ($department['sess_year'] == '2019' ? 'selected' : '') ?>>2019</option>
                                        <option value="2020" <?= ($department['sess_year'] == '2020' ? 'selected' : '') ?>>2020</option>
                                        <option value="2021" <?= ($department['sess_year'] == '2021' ? 'selected' : '') ?>>2021</option>
                                        <option value="2022" <?= ($department['sess_year'] == '2022' ? 'selected' : '') ?>>2022</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <input type="submit" name="submit" value="ADD" class="btn btn-primary m-t-15 waves-effect">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>