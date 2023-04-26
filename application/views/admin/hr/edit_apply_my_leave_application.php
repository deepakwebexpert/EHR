<!-- Bootstrap Material Datetime Picker Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

<!-- Wait Me Css -->
<!-- <link href="<?= base_url() ?>public/plugins/waitme/waitMe.css" rel="stylesheet" /> -->

<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<style>
    #na_datatable1_filter {
        float: right;
    }

    #na_datatable1_paginate {

        margin-left: 69%;

    }
</style>
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Leaves Application</h2>
            </div>


            <div class="body">

                <?php echo form_open(base_url('admin/hr/update_leave/' . $id), 'class="form-horizontal"');  ?>

                <?php
                //    print_r($leave_data); die;
                ?>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="username">From</label>
                    </div>
                    <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" name="start_date" class="form-control" value="<?= ($leave_data['start_date']) ?>" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="username">To</label>
                    </div>
                    <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" name="end_date" class="form-control" value="<?= ($leave_data['end_date']) ?>" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="group">Leave Type</label>
                    </div>
                    <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <select class="form-control show-tick" name="leave_type" required>


                                    <option value="CI" <?= ($leave_data['leave_type'] == 'CI' ? 'selected' : '') ?>>CI</option>
                                    <option value="EI" <?= ($leave_data['leave_type'] == 'EI' ? 'selected' : '') ?>>EI</option>
                                    <option value="SI" <?= ($leave_data['leave_type'] == 'SI' ? 'selected' : '') ?>>SI</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="username">Reason</label>
                    </div>
                    <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="10" cols="112" name="reason" required><?= $leave_data['reason'] ?></textarea>
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


<script src="<?= base_url() ?>public/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<!-- Autosize Plugin Js -->
<script src="<?= base_url() ?>public/plugins/autosize/autosize.js"></script>
<!-- Custom Js -->
<script src="<?= base_url() ?>public/js/pages/tables/jquery-datatable.js"></script>

<script>
    $('#new_table').DataTable();
</script>