<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Add Leaves
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


                    <?php echo form_open(base_url('admin/hr/add_leaves/' . $id), 'class="form-horizontal"');  ?>


                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="username">Employee</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick live_search department_change" data-live-search="true" name="employee_name" required>
                                        <option value="">-- Please select --</option>
                                        <?php foreach ($employees as $group) : ?>
                                            <option value="<?= $group['id']; ?>" <?= ($department['employee_name'] == $group['id'] ? 'selected' : '') ?>><?= $group['emp_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="group">Year</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="leave_year" required>
                                        <option value="">-- Please select --</option>
                                        <option value="2018" <?= ($department['leave_year'] == '2018' ? 'selected' : '') ?>>2018</option>
                                        <option value="2019" <?= ($department['leave_year'] == '2019' ? 'selected' : '') ?>>2019</option>
                                        <option value="2020" <?= ($department['leave_year'] == '2020' ? 'selected' : '') ?>>2020</option>
                                        <option value="2021" <?= ($department['leave_year'] == '2021' ? 'selected' : '') ?>>2021</option>
                                        <option value="2022" <?= ($department['leave_year'] == '2022' ? 'selected' : '') ?>>2022</option>
                                        <option value="2023" <?= ($department['leave_year'] == '2023' ? 'selected' : '') ?>>2023</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="username">Leave (CI)</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" name="cl" class="form-control" value="<?= ($department['cl']) ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="username">Leave (EI)</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" name="al" class="form-control" value="<?= ($department['al']) ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="username">Leave (SL)</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" name="cc" class="form-control" value="<?= ($department['cc']) ?>" required>
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