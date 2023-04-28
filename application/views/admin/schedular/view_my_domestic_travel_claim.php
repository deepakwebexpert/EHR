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

    .bootstrap-select {
        width: 100px !important;
    }
</style>
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
            </div>

            <div class="body">

                <?php echo form_open_multipart(base_url('admin/users/add_my_domestic_travel_claim/' . $id), 'class="form-horizontal"');  ?>


                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="address">Name</label>
                    </div>
                    <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" value="<?= $this->session->all_userdata()['name'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="address">Date Of Claim</label>
                    </div>
                    <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <!-- <input type="date" name="claim_date" class="form-control" value="<?= $view_data['claim_date'] ?>" required> -->
                                <?= $view_data['claim_date'] ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="address">Customer Name</label>
                    </div>
                    <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <!-- <input type="text" name="country" class="form-control" value="<?= $view_data['country'] ?>" required> -->
                                <?= $view_data['country'] ?>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="address">Service Report</label>
                    </div>
                        <!-- <div class="col-lg-5 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="file" name="upload_file" class="form-control" value="" required>
                                </div>
                            </div>
                        </div> -->
                    <div class="col-lg-3">
                        <!-- <select name="services_report" class="form-control" required>

                            <option value="Yes" <?= $view_data['service_report'] == "Yes" ? "selected" : "" ?>>Yes</option>

                            <option value="No" <?= $view_data['service_report'] == "No" ? "selected" : "" ?>>No</option>

                        </select> -->
                        <?= $view_data['services_report'] ?>
                    </div>
                </div>


                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="address">Period</label>
                    </div>
                    <div class="col-lg-2 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <!-- <input type="date" name="start_date" value="<?= $view_data['start_date'] ?>" class="form-control" required> -->
                                <?= $view_data['start_date'] ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <!-- <input type="text" placeholder="HH:MM" name="start_time" class="form-control" value="<?= $view_data['start_time'] ?>" required> -->
                                <?= $view_data['start_time'] ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <!-- <select name="start_time_type">
                                    <option value="A.M" <?= $view_data['start_time_type'] == "A.M" ? "selected" : "" ?>>A.M</option>
                                    <option value="P.M" <?= $view_data['start_time_type'] == "P.M" ? "selected" : "" ?>>P.M</option>
                                </select> -->
                                <?= $view_data['start_time_type'] ?>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="address">To</label>
                    </div>

                    <div class="col-lg-2 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <!-- <input type="date" name="end_date" class="form-control" value="<?= $view_data['end_date'] ?>" required> -->
                                <?= $view_data['end_date'] ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <!-- <input type="time" name="end_time" value="<?= $view_data['end_time'] ?>" class="form-control" required> -->
                                <?= $view_data['end_time'] ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <!-- <select name="end_time_type">
                                    <option value="A.M" <?= $view_data['end_time_type'] == "A.M" ? "selected" : "" ?>>A.M</option>
                                    <option value="P.M" <?= $view_data['end_time_type'] == "P.M" ? "selected" : "" ?>>P.M</option>
                                </select> -->
                                <?= $view_data['end_time_type'] ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="address">TTL Duration</label>
                    </div>
                    <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <?= $view_data['ttl_duration'] ?>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="address">Purpose</label>
                    </div>
                    <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">

                                <?= $view_data['purpose'] ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">

                    <table id="addedRows" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>S#</th>
                                <th>Date</th>
                                <th>Model No</th>
                                <th>Company</th>
                                <th>Particulars</th>
                                <th>Account Code</th>
                                <th>Transaction Type</th>
                                <th>Amount(INR)</th>
                                <th>Reference No</th>
                                <th>Ref Document</th>
                            </tr>
                        </thead>



                        <?php
                        foreach ($view_amount_data as $key => $value) { ?>
                            <tr>
                                <td>
                                    <?= ++$j ?>
                                </td>
                                <td>

                                    <?= $value['travel_date'] ?>
                                </td>
                                <td>
                                    <?= $value['model_no'] ?>
                                </td>

                                <td>

                                    <!-- <select class="form-control show-tick live_search department_change" name="Company[]" required>
                                        <?php foreach ($customers as $group) : ?>
                                            <option value="<?= $group['id']; ?>" <?= ($department['app_teamleader'] == $group['id'] ? 'selected' : '') ?>><?= $group['cust_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select> -->

                                </td>

                                <td>
                                    <?= $value['Description'] ?>
                                </td>

                                <td>
                                    <?= $value['acc_code'] ?>


                                </td>

                                <td>

                                    <?= $value['paymnet_by'] ?>
                                </td>

                                <td>
                                    <?= $value['Amount'] ?>
                                </td>

                                <td>
                                    <?= $value['reference'] ?>
                                </td>

                                <td>
                                    <?= $value['docs'] ?>
                                </td>
                            </tr>

                        <?php }
                        ?>

                    </table>


                </div>

                <button type="button" class="btn btn-primary" onclick="window.print();">Print</button>

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