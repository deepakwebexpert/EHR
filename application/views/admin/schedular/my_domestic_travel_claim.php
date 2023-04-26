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
                <h2>
                    My Domestic Travel Claim

                </h2>
                <a href="<?= base_url('admin/users/add_my_domestic_travel_claim'); ?>" class="btn bg-deep-orange waves-effect pull-right"><i class="material-icons">person_add</i> Create New</a>
            </div>

            <div class="body">

                <div class="table-responsive">
                    <?php echo form_open(base_url('admin/users/domestic_travel_claim'), 'class="form-horizontal"');  ?>
                    <table id="na_datatable1" class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>S#</th>
                                <th>Employee</th>
                                <th>Period</th>
                                <th>Total Amount(INR)</th>
                                <th>Status</th>
                                <th>View</th>
                                <th>Month</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $i = 0;


                            // while ($sql_mon_data = mysql_fetch_array($sql_mon_filter)) { //print"<pre>"; print_r($sql_mon_data);
                            foreach ($sql_mon_filter as $key => $sql_mon_data) {


                                // $sql_main_table = mysql_query("SELECT SUM(Amount) as total_amount,status FROM `jeol_travelexp_tbl` WHERE sheet_id='$sql_mon_data[sheet_id]'  and sheet_type='0' and acc_code!='Paid By Company'");
                                // $sql_main_result = mysql_fetch_array($sql_main_table);

                                $sql_main_result = my_domestic_travel_claim($sql_mon_data['sheet_id'], 0, 'Paid By Company');

                                $i++;
                                if ($i % 2 == 0) {
                                    $list = 'odd';
                                } else {
                                    $list = 'even';
                                }


                                if ($sql_mon_data['status'] == 'Approved') {
                                    $color = '#fff';
                                } else if ($sql_mon_data['status'] == 'Rejected') {
                                    $color = '#FF0000';
                                } else {
                                    $color = '#99CC00';
                                }
                            ?>
                                <tr style="background-color:<?= $color ?>">
                                    <?php if ($sql_mon_data['status'] == "Approved") {
                                        $class = "disabled";
                                    } else {
                                        $class = "";
                                    }
                                    ?>
                                    <td class="c"><?php echo $i; ?>
                                        <?php if ($sql_mon_data['status'] != 'Submitted' && $sql_mon_data['status'] != 'Approved') { ?>
                                            <input type="checkbox" name="sheet_iddd[]" id="sheet_iddd" value="<?php echo $sql_mon_data['sheet_id']; ?>">
                                        <?php } ?>
                                    </td>
                                    <td class=""><?= $sql_mon_data['emp_name'] ?></td>
                                    <td class=""><?php echo date("d-m-Y", strtotime($sql_mon_data['start_date'])); ?> <?php echo $sql_mon_data['start_time'] ?> <?php echo $sql_mon_data['start_time_type']; ?> To <?php echo date("d-m-Y", strtotime($sql_mon_data['end_date'])); ?> <?php echo $sql_mon_data['end_time']; ?> <?php echo $sql_mon_data['end_time_type']; ?></td>
                                    <td class=""><?= number_format($sql_main_result['total_amount']) ?></td>
                                    <td class="l"><?= $sql_mon_data['status'] ?></td>
                                    <td class="c">
                                        <?php
                                        if ($sql_mon_data['status'] != 'Approved' && $sql_mon_data['status'] != 'Submitted') {
                                        ?>
                                            <a href="<?php echo base_url() ?>travel/expense_list/<?= $sql_mon_data['sheet_id'] ?>" class="btn i_pencil" title="Edit"></a>
                                            <a href="<?php echo base_url() ?>travel/searchOne/<?= $sql_mon_data['sheet_id'] ?>/0" title="View"> View
                                            </a>
                                            <a href="<?php echo base_url() ?>travel/domestic_travel_list_delete/<?= $sql_mon_data['sheet_id'] ?>" onclick="return confirm('Are you sure you want to delete My domestic travel sheet?');" class="btn i_trashcan">
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?php echo base_url() ?>travel/searchOne/<?= $sql_mon_data['sheet_id'] ?>/0" title="View">View</a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php echo date("d-m-Y", strtotime($sql_mon_data['claim_date'])); ?>
                                    </td>

                                </tr>
                            <?php
                            } ?>


                        </tbody>

                        <?php echo form_close(); ?>

                    </table>
                </div>

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