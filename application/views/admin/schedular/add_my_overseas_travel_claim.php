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

                <?php echo form_open_multipart(base_url('admin/users/add_my_overseas_travel_claim/' . $id), 'class="form-horizontal"');  ?>


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
                                <input type="date" name="claim_date" class="form-control" value="" required>
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
                                <input type="text" name="country" class="form-control" value="" required>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="address">Service Report</label>
                    </div>
                    <div class="col-lg-5 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="file" accept="application/pdf" name="upload_file" class="form-control" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <select name="services_report" class="form-control" required>

                            <option value="Yes">Yes</option>

                            <option value="No">No</option>

                        </select>
                    </div>
                </div>


                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="address">Period</label>
                    </div>
                    <div class="col-lg-2 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" name="start_date" value="" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" placeholder="HH:MM" name="start_time" class="form-control" value="" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <select name="start_time_type">
                                    <option value="A.M">A.M</option>
                                    <option value="P.M">P.M</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="address">To</label>
                    </div>

                    <div class="col-lg-2 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" name="end_date" class="form-control" value="" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="time" name="end_time" value="" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <select name="end_time_type">
                                    <option value="A.M">A.M</option>
                                    <option value="P.M">P.M</option>
                                </select>
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
                                <input type="text" name="ttl_duration" value="" class="form-control" required>
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
                                <input type="text" name="purpose" value="" class="form-control" required>
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
                                <th>Amount</th>
                                <th>Currency/Rate</th>
                                <th>Amount(INR)</th>
                                <th>Reference No</th>
                                <th>Ref Document</th>
                            </tr>
                        </thead>



                        <?php
                        for ($j = 1; $j <= 10; $j++) { ?>
                            <tr>
                                <td>
                                    <?= $j ?>
                                </td>
                                <td>
                                    <input type="date" class="form-control" value="" name="travel_date[]" <?php if ($j == 1) echo "required" ?>>
                                </td>
                                <td>
                                    <input type="text" class="form-control" value="" name="model_no[]" <?php if ($j == 1) echo "required" ?>>
                                </td>

                                <td>

                                    <select class="form-control show-tick live_search department_change" name="Company[]" required>
                                        <?php foreach ($customers as $group) : ?>
                                            <option value="<?= $group['id']; ?>" <?= ($department['app_teamleader'] == $group['id'] ? 'selected' : '') ?>><?= $group['cust_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </td>

                                <td>
                                    <input type="text" class="form-control" value="" name="Description[]" <?php if ($j == 1) echo "required" ?>>
                                </td>

                                <td>

                                    <select id="py_<?= $j ?>" class="form-control show-tick live_search department_change" name="acc_code[]" onchange="document.getElementById('d'+this.id).value=this.value" required>
                                        <option value="Purchase">45150</option>
                                        <option value="Staff Welfare">55030</option>
                                        <option value="Supply Exp">55032</option>
                                        <option value="Maintenance">550332</option>
                                        <option value="Vehicle Exp">550333</option>
                                        <option value="Travel Exp">55034</option>
                                        <option value="Communication">55036</option>
                                        <option value="Entertainment">55041</option>
                                        <option value="Paid By Self">5503411</option>
                                        <option value="Paid By Company">5503410</option>

                                    </select>

                                </td>

                                <td>
                                    <input type="text" class="form-control" value="" id="dpy_<?= $j ?>" name="paymnet_by[]" <?php if ($j == 1) echo "required" ?>>
                                </td>


                                <td>
                                    <input type="text" class="form-control" value="" name="Amount_two[]" <?php if ($j == 1) echo "required" ?>>
                                </td>

                                <td>
                                    <!-- <div class="col-lg-6"> -->
                                        <select name="currency_travel[]" <?php if ($j == 1) echo "required" ?> class="form-control">
                                            <option value="">Select</option>
                                            <option value="JPY">JPY</option>
                                            <option value="INR">INR</option>
                                            <option value="USD">USD</option>
                                            <option value="SGD">SGD</option>
                                        </select>

                                    <!-- </div> -->
                                    <!-- <div class="col-lg-6"> -->
                                        <input type="text" maxlength="5" class="form-control" value="" name="curr_rate[]" <?php if ($j == 1) echo "required" ?>>

                                    <!-- </div> -->
                                </td>

                                <td>
                                    <input type="text" class="form-control" value="" name="Amount[]" <?php if ($j == 1) echo "required" ?>>
                                </td>

                                <td>
                                    <input type="text" class="form-control" value="" name="reference[]" <?php if ($j == 1) echo "required" ?>>
                                </td>

                                <td>
                                    <input type="file" accept="application/pdf" class="form-control" value="" name="docs[]" <?php if ($j == 1) echo "required" ?>>
                                </td>
                            </tr>

                        <?php }
                        ?>

                    </table>

                    <table>

                        <tbody class="input_fields_wrap ">

                            <a onclick="addMoreRows(this.form);" href="javascript:void(0)" class="button"> Add More +</a>

                        </tbody>

                    </table>
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

    var rowCount = <?= $j - 1 ?>;

    function addMoreRows(frm) {


        rowCount++;



        var recRow = '<tr id="rowCount' + rowCount + '" class="gradeA "><td width="1%">' + rowCount + '</td><td width="8%"><input class="form-control" type="date" value="" id="date<?= $j ?>"  name="travel_date[]" placeholder="yyyy-mm-dd" class="g10"  required ></td><td width="9%"><input type="text" class="form-control" size="10" name="model_no[]"  style="width:100px" /></td><td width="11%"> <select class="form-control show-tick live_search department_change" name="app_teamleader" required><?php foreach ($customers as $group) : ?><option value="<?= $group['id']; ?>" <?= ($department['app_teamleader'] == $group['id'] ? 'selected' : '') ?>><?= $group['cust_name']; ?></option><?php endforeach; ?></select></td><td width="18%"><input class="form-control" type="text"  id="required_field" class="g12"  name="Description[]"  value="" ></td><td width ="8%" class="c"><select name="acc_code[]" id="py_' + rowCount + '" onChange="document.getElementById(\'d\'+this.id).value=this.value"><option value="">Select</option><option value="Purchase">45150</option><option value="Staff Welfare" >55030</option><option value="Supply Exp">55032</option><option value="Maintenance">550332</option><option value="Vehicle Exp">550333</option><option value="Travel Exp">55034</option><option value="Communication">55036</option><option value="Entertainment">55041</option><option value="Paid By Self">5503411</option><option value="Paid By Company">5503410</option></select></td><td width="12%" class="c"><input class="form-control" type="text" class="g10" name="paymnet_by[]" id="dpy_' + rowCount + '" value="" ></td><td><input type="text" class="form-control" value="" name="Amount_two[]" <?php if ($j == 1) echo "required" ?>></td><td><select name="currency_travel[]" required="" class="form-control"><option value="">Select</option><option value="JPY">JPY</option><option value="INR">INR</option><option value="USD">USD</option><option value="SGD">SGD</option></select><input type="text" maxlength="5" class="form-control" value="" name="curr_rate[]" required=""></td><td class="c"><input class="form-control" id="date" name="Amount[]" value="" type="text" onKeyPress="return isNumberKey(event)" ></td><td width="6%" class="c"><input class="form-control" id="date" name="reference[]" value="" class="g10" type="text"></td><td width="8%" class="c"><input type="file" class="form-control" name="category_image[]" /><a href="javascript:void(0);" class="button" onclick="removeRow(' + rowCount + ');"><b>X</b></a></td></tr>';
        jQuery('#addedRows').append(recRow);



    }

    function removeRow(removeNum) {
        jQuery('#rowCount' + removeNum).remove();
    }
</script>