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
                <h2>View Leaves Application</h2>
            </div>


            <div class="body">

                <?php
                if ($this->session->userdata('group_id') == '6') {
                ?>

                    <select class="" onChange="window.location='<?= base_url('admin/hr/leave_application') ?>/'+this.value">
                        <option value=''>--Select Year--</option>
                        <option value='2019' <?php if ($year == '2019') { ?> selected <?php } ?>>2019</option>
                        <option value='2020' <?php if ($year == '2020') { ?> selected <?php } ?>>2020</option>
                        <option value='2021' <?php if ($year == '2021') { ?> selected <?php } ?>>2021</option>
                        <option value='2022' <?php if ($year == '2022') { ?> selected <?php } ?>>2022</option>
                        <option value='2023' <?php if ($year == '2023') { ?> selected <?php } ?>>2023</option>

                    </select>
                <?php
                }
                ?>


                <div class="table-responsive">
                    <table id="na_datatable1" class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>S#</th>
                                <th>Employee</th>
                                <th>Duration</th>
                                <th>Type</th>
                                <th>Reason</th>
                                <th>Application Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            // while ($sql_leave_request_checkdata = mysql_fetch_array($sql_leave_request)) {
                            // print_r($sql_leave_request_checkdata);
                            // die;
                            // print_r($report_person); 
                            foreach ($sql_leave_request_checkdata as $key => $value) {
                                // echo $value['member_id'];
                                @$i++;


                                if (in_array($value['member_id'], $report_person)) {
                                    @$j++;
                                    $id = $value['id'];
                                    if ($i % 2 == 0) {
                                        $list = 'odd';
                                    } else {
                                        $list = 'even';
                                    }


                                    // $sql_employeename = get_employe_leave_desc($sql_leave_request_checkdata['member_id']);
                                    $sql_employeename = $this->db->get_where('jeol_employee_tbl', array('id' => $value['member_id']))->row_array();


                                    if ($value['leave_status'] == 'Approved') {
                                        $color = '#fff';
                                    } else if ($value['leave_status'] == 'Rejected') {
                                        $color = '#FF0000';
                                    } else {
                                        $color = '#99CC00';
                                    }
                            ?>
                                    <tr style="background-color:<?= $color ?>">
                                        <td class="c"><?php echo $j; ?></td>
                                        <td class=""><?php echo $sql_employeename['emp_name']; ?><br /></td>
                                        <td class="c"><?php echo date("d-m-Y", strtotime($value['start_date'])); ?> To <?php echo date("d-m-Y", strtotime($value['end_date'])); ?></td>
                                        <td class="">
                                            <center><?php echo $value['leave_type']; ?></center>
                                        </td>
                                        <td class="l"><?php echo $value['reason']; ?></td>
                                        <td class="c">
                                            <center><?php echo date("d-m-Y", strtotime($value['submit_date'])); ?></center>
                                        </td>
                                        <td class="c"><?= $value['leave_status'] ?></td>
                                        <td class="c">
                                            <a onclick="popupCenter('http://www.jeolindia-ehr.com/display-leave.php?id=<?= $value['member_id'] ?>', 'myPop1',650,150);" href="javascript:void(0);">View</a>
                                            <?php if (($this->session->userdata('group_id') == '6') && ($this->session->userdata('user_id') == '51')) {
                                                $reportid  = explode(',', $sql_employeename['report_to']);
                                                $in_exist = in_array('51', $reportid);
                                                if ($in_exist) {
                                            ?>
                                                    <center><a href="<?php echo base_url() ?>employeeleave/approve_employeeleave/<?= $value['id'] ?>/<?= $value['member_id'] ?>" onclick="return confirm('Are you sure you want to Approve leave application?')">Approve</a> | <a onclick="return confirm('Are you sure you want to Reject leave application?')" href="<?php echo base_url() ?>employeeleave/reject_employeeleave/<?= $value['id'] ?>/<?= $value['member_id'] ?>">Reject</a></center>

                                                <?php }
                                            } else {
                                                $tl_id = $this->session->userdata('user_id');
                                                // $tl_email = get_team_leader_email($tl_id); // for team leader email id...

                                                $emp_id = $sql_employeename['id']; // emp email id...
                                                $table = "jeol_leave_mails";

                                                // $team_subordinate = get_reporting_person_access($emp_id, $tl_email->emp_email, $table);
                                                //dump($team_subordinate);
                                                if ($team_subordinate) {

                                                ?> <center><a href="<?php echo base_url() ?>employeeleave/approve_employeeleave/<?= $value['id'] ?>/<?= $value['member_id'] ?>" onclick="return confirm('Are you sure you want to Approve leave application?')">Approve</a> | <a onclick="return confirm('Are you sure you want to Reject leave application?')" href="<?php echo base_url() ?>employeeleave/reject_employeeleave/<?= $value['id'] ?>/<?= $value['member_id'] ?>">Reject</a></center>
                                            <?php }
                                            } ?>
                                        </td>
                                    </tr>
                            <?php $i++;
                                }
                            }
                            ?>
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