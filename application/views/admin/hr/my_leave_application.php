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
                <h2>Leaves Details</h2>
            </div>


            <div class="body">




                <div class="table-responsive">
                    <table id="na_datatable1" class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>S#</th>
                                <th>Name</th>
                                <th>CI</th>
                                <th>EI</th>
                                <th>SI</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $i = 0;

                            $j = 0;

                            foreach ($departments as $department) {

                                $i++;

                                $j++;
                                $id = $department['id'];
                                $leave_year = 2023;

                                if ($i % 2 == 0) {
                                    $list = 'odd';
                                } else {
                                    $list = 'even';
                                }


                                $this->db->where('id', $department['employee_name']);
                                $sql_employeename = $this->db->get('jeol_employee_tbl')->row_array();

                            ?>
                                <tr class="gradeA <?= $list ?>">
                                    <td class="c"><?php echo $j; ?></td>
                                    <td class=""><?php echo $sql_employeename['emp_name']; ?></td>
                                    <td class="c"><strong>Used:</strong>
                                        <?php


                                        $sql_taken_cl = $this->db->query("SELECT SUM(no_days) FROM `jeol_apply_leave` WHERE member_id='" . $this->session->userdata('user_id') . "' and leave_type='CI' AND leave_status='Approved' and submit_date > '2023-03-31' and YEAR (`submit_date`)='$leave_year'")->row_array();


                                        if ($sql_taken_cl['SUM(no_days)'] != '') {
                                            echo $sql_taken_cl['SUM(no_days)'];
                                        } else {
                                            print "0";
                                        } ?> <strong>|</strong> <?php if ($sql_taken_cl['SUM(no_days)'] > $department['cl']) {
                                                                } else { ?><strong>Remaining:</strong> <?php echo $left_leave = $department['cl'] - $sql_taken_cl['SUM(no_days)']; ?><?php } ?></td>

                                    <td class="">
                                        <center>

                                            <strong>Used:</strong>
                                            <?php


                                            $sql_taken_al = $this->db->query("SELECT SUM(no_days) FROM `jeol_apply_leave` WHERE member_id='" . $this->session->userdata('user_id') . "' and leave_type='EI' AND leave_status='Approved' and submit_date > '2023-03-31' and YEAR (`submit_date`)='$leave_year'")->row_array();


                                            if ($sql_taken_al['SUM(no_days)'] != '') {
                                                echo $sql_taken_al['SUM(no_days)'];
                                            } else {
                                                print "0";
                                            }
                                            ?>
                                            <strong>|</strong>
                                            <?php if ($sql_taken_al['SUM(no_days)'] >= $department['al']) {
                                            } else { ?><strong>Remaining:</strong> <?php echo $left_leave = $department['al'] - $sql_taken_al['SUM(no_days)']; ?><?php } ?>





                                        </center>
                                    </td>

                                    <td class="">
                                        <center>

                                            <strong>Used:</strong>
                                            <?php

                                            $sql_taken_cc = $this->db->query("SELECT SUM(no_days) FROM `jeol_apply_leave` WHERE member_id='" . $this->session->userdata('user_id') . "' and leave_type='SI' AND leave_status='Approved' and submit_date > '2023-03-31' and YEAR (`submit_date`)='$leave_year'")->row_array();


                                            if ($sql_taken_cc['SUM(no_days)'] != '') {
                                                echo $sql_taken_cc['SUM(no_days)'];
                                            } else {
                                                print "0";
                                            } ?>
                                            <strong>|</strong>
                                            <?php if ($sql_taken_cc['SUM(no_days)'] >= $department['cc']) {
                                            } else { ?><strong>Remaining:</strong> <?php echo $left_leave = $department['cc'] - $sql_taken_cc['SUM(no_days)']; ?><?php } ?>
                                        </center>
                                    </td>

                                    <td class="c">

                                        <!-- <a href="<?php echo base_url("admin/hr/apply_my_leave_application/"); ?>">Apply For Leave</a> -->
                                        <a class="btn btn-primary" href="<?php echo base_url("admin/hr/apply_my_leave_application/") . $id; ?>">Apply For Leave</a>

                                    </td>

                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Leaves Applications</h2>
            </div>


            <div class="body">




                <div class="table-responsive">
                    <table id="na_datatable1" class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>S#</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Leave Type</th>
                                <th>Reason</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // while ($sql_leave_request_checkdata = mysql_fetch_array($sql_leave_request)) {
                            foreach ($sql_leave_request as $key => $sql_leave_request_checkdata) {

                                @$i++;

                                @$j++;

                                $id = $sql_leave_request_checkdata['id'];

                                if ($i % 2 == 0) {

                                    $list = 'odd';
                                } else {

                                    $list = 'even';
                                }

                                // $sql_employeename = mysql_fetch_array(mysql_query("SELECT * FROM `jeol_employee_tbl` WHERE id='" . $sql_leave_request_checkdata['member_id'] . "'"));

                                $this->db->where('id', $sql_leave_request_checkdata['member_id']);
                                $sql_employeename = $this->db->get('jeol_employee_tbl')->row_array();

                            ?>

                                <tr class="gradeA <?= $list ?>">

                                    <td class="c"><?php echo $j; ?></td>



                                    <td class=""><?php echo date('d-m-Y', strtotime($sql_leave_request_checkdata['start_date'])); ?></td>

                                    <td class="c"><?php echo date('d-m-Y', strtotime($sql_leave_request_checkdata['end_date'])); ?> </td>

                                    <td class="">
                                        <center><?php echo $sql_leave_request_checkdata['leave_type']; ?> (<?php echo $sql_leave_request_checkdata['no_days']; ?>) </center>
                                    </td>

                                    <td class="l"><?php echo $sql_leave_request_checkdata['reason']; ?></td>
                                    <td class="c">
                                        <center><?php echo date('d-m-Y', strtotime($sql_leave_request_checkdata['submit_date'])); ?></center>
                                    </td>
                                    <td class="c">
                                        <?php echo $sql_leave_request_checkdata['leave_status']; ?>
                                    </td>

                                    <td class="c"><?php if ($sql_leave_request_checkdata['leave_status'] == 'Approved') {
                                                    } else { ?>
                                            <a class="update btn btn-sm btn-primary m-r-10" href="<?php echo base_url('/admin/hr/edit_apply_my_leave_application/') . $id; ?>"><i class="material-icons">edit</i>
                                            </a>
                                            <a class="delete btn btn-sm btn-danger" href="<?php echo base_url('/admin/hr/delete_leave/') . $id; ?>" onclick="return confirm('Would like to cancel this leave application?');"><i class="material-icons">delete</i>
                                            </a><?php } ?>
                                    </td>

                                </tr>

                            <?php $i++;
                            } ?>
                        </tbody>
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