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
                    Log Sheet
                </h2>
            </div>


            <div class="body">

                <?php
                if ($this->session->userdata('group_id') == '6') {
                ?>


                    <select class="" onChange="window.location='<?= base_url('admin/users/local_travel_log_sheet') ?>/'+this.value">
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
                    <?php echo form_open(base_url('admin/users/local_travel_log_sheet'), 'class="form-horizontal"');  ?>
                    <table id="na_datatable1" class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>S#</th>
                                <th>Employee</th>
                                <th>Date Of Claim</th>
                                <th>Total Amount(INR)</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($this->session->userdata('group_id') == '6') {
                                // if ($this->uri->segment(3) == '') {
                                //     $con = '';
                                //     $curr_year = date(Y);
                                // } else {

                                //     $con = '';
                                //     $curr_year = $this->uri->segment(3);
                                // }


                                foreach ($emp_data as $key => $value) :

                                    static $j = 1;

                                    $this->db->select('SUM(paymnet_by) as total_amount, status');
                                    $this->db->where('sheet_id', $value['sheet_id']);
                                    $query = $this->db->get('jeol_travelexp_log_tbl');
                                    $sql_main_result = $query->row_array();


                                    if ($value['status'] == 'Approved') {
                                        $color = '#fff';
                                    } else if ($value['status'] == 'Rejected') {
                                        $color = '#FF0000';
                                    } else {
                                        $color = '#99CC00';
                                    }
                            ?>
                                    <tr class="" style="background-color:<?= $color ?>">
                                        <td class="c">
                                            <input type="checkbox" name="sub_admin_list[]" value="<?= $value['sheet_id'] ?>" id="<?= $value['sheet_id'] ?>">
                                            <label for="<?= $value['sheet_id'] ?>"></label>
                                        </td>
                                        <td class=""><?= $value['emp_name'] ?></td>
                                        <td class=""> <?php echo date("d-m-Y", strtotime($value['claim_date'])); ?> </td>
                                        <td class=""><?= number_format($sql_main_result['total_amount']) ?></td>
                                        <td class="l"><?= $value['status'] ?></td>
                                        <td class="c">
                                            <!-- <a href="<?php echo base_url() ?>travel/searchOnelog/<?= $value['sheet_id'] ?>">View</a> -->
                                            #
                                        </td>
                                    </tr>
                                    <?php
                                    $j++;
                                endforeach;
                            } else {
                                // while ($sql_report_persondata = mysql_fetch_array($sql_report_person)) {
                                foreach ($sql_report_person as $key => $sql_report_persondata) {
                                    //echo "SELECT * FROM `jeol_travelsheet_log_tbl` WHERE member_id='$sql_report_persondata[id]'";
                                    // $sql_member = mysql_query("SELECT * FROM `jeol_travelsheet_log_tbl` WHERE member_id='$sql_report_persondata[id]'");
                                    $table = 'jeol_travelsheet_log_tbl';
                                    $this->db->select('*');
                                    $this->db->where('member_id', $sql_report_persondata['id']);
                                    $sql_member = $this->db->get($table)->result_array();


                                    // while ($sql_travel_table = mysql_fetch_array($sql_member)) {
                                    foreach ($sql_member as $key => $sql_travel_table) {


                                        // $sql_main_table = mysql_query("SELECT SUM(paymnet_by) as total_amount,status FROM `jeol_travelexp_log_tbl` WHERE sheet_id='$sql_travel_table[sheet_id]' ");
                                        // $sql_main_result = mysql_fetch_array($sql_main_table);

                                        $this->db->select_sum('paymnet_by', 'total_amount');
                                        $this->db->select('status');
                                        $this->db->where('sheet_id', $sql_travel_table['sheet_id']);
                                        $query = $this->db->get('jeol_travelexp_log_tbl');
                                        $sql_main_result = $query->row_array();


                                        $i++;
                                        if ($i % 2 == 0) {
                                            $list = 'odd';
                                        } else {
                                            $list = 'even';
                                        }
                                        if ($sql_travel_table['status'] == 'Approved') {
                                            $color = '#fff';
                                        } else if ($sql_travel_table['status'] == 'Rejected') {
                                            $color = '#FF0000';
                                        } else {
                                            $color = '#99CC00';
                                        }
                                    ?>
                                        <tr class="" style="background-color:<?= $color ?>">
                                            <td class="c"><?php echo $i; ?>
                                                <?php //if($sql_travel_table['status'] == 'Submitted'){
                                                $tl_id = $this->session->userdata('user_id');
                                                // $tl_email = get_team_leader_email($tl_id); // for team leader email id...
                                                $tl_email = $this->db->select('emp_email')->where('id', $tl_id)->get('jeol_employee_tbl')->row();
                                                $emp_id = $sql_report_persondata['id']; // emp email id...
                                                $table = "jeol_travel_mails";

                                                // $team_subordinate = get_reporting_person_access($emp_id, $tl_email->emp_email, $table);
                                                $team_subordinate = $this->db->select('*')->where('emp_id', $emp_id)->where('emp_to', $tl_email->emp_email)->get($table)->row();

                                                if ($team_subordinate) {
                                                    //dump($team_subordinate);
                                                ?>
                                                    <input type="checkbox" name="sub_admin_list[]" value="<?= $sql_travel_table['sheet_id'] ?>_<?= $emp_id ?>" id="<?=  $sql_travel_table['sheet_id'] ?>">
                                                    <label for="<?= $sql_travel_table['sheet_id'] ?>"></label>
                                                    <?php } ?>
                                                    
                                            </td>
                                            <td class=""><?= $sql_report_persondata['emp_name'] ?>
                                                <input type="hidden" name="sheet_idd[]" value="<?= $sql_travel_table['sheet_id'] ?>" />
                                                <input type="hidden" name="emp_id" value="<?= $sql_travel_table['member_id'] ?>" />

                                            </td>
                                            <td class=""><?php if ($sql_travel_table['status'] == '') {
                                                                echo "-";
                                                            } else {
                                                                echo date("d-m-Y", strtotime($sql_travel_table['claim_date']));
                                                            } ?></td>
                                            <td class=""><?php if ($sql_travel_table['status'] == '') {
                                                                echo "-";
                                                            } else { ?><?= number_format($sql_main_result['total_amount']);
                                                                    } ?></td>
                                            <td class="l"><?php if ($sql_travel_table['status'] == '') {
                                                                echo "-";
                                                            } else { ?><?= $sql_travel_table['status'];
                                                                    } ?></td>
                                            <td class="c"><?php if ($sql_travel_table['status'] == '') {
                                                                echo "-";
                                                            } else { ?><a href="<?php echo base_url() ?>travel/searchOnelog/<?= $sql_travel_table['sheet_id'] ?>">View</a> <?php } ?></td>
                                        </tr>

                            <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                        <div flot="right">
                            <center>
                                <button type="submit" class="submit" name="submitbuttonname" value="Approved">Approve</button> &nbsp;
                                <button type="submit" class="submit" name="submitbuttonname" value="Rejected">Reject</button> <br>
                            </center>
                        </div>
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