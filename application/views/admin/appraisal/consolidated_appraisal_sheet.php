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
                <h2>Appraisee List</h2>
            </div>


            <div class="body">

                <?php
                if ($this->session->userdata('group_id') == '6') {
                ?>

                    <select class="" onChange="window.location='<?= base_url('admin/appraisal/consolidated_appraisal_sheet') ?>/'+this.value">
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
                                <th>Employee Name</th>
                                <th>Department</th>
                                <th>Employee Status</th>
                                <th>1st Status</th>
                                <th>2nd Status</th>
                                <th>Final Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($emp_detail as $sql_employee_detail) {
                                if ($i % 2 == 0) {
                                    $list = 'even';
                                } else {
                                    $list = 'odd';
                                }
                                $i++;


                                // $get_status = mysql_fetch_array(mysql_query("SELECT * FROM `jeol_apprasial_member` WHERE `app_employee`='" . $sql_employee_detail['id'] . "' and sess_year='$sess_year'"))
                                $this->db->select('*');
                                $this->db->from('jeol_apprasial_member');
                                $this->db->where('app_employee', $sql_employee_detail['id']);
                                $this->db->where('sess_year', $year);

                                $query = $this->db->get();

                                if ($query->num_rows() > 0) {
                                    $get_status = $query->row_array();
                                }

                                // print_r($get_status); die;

                            ?>
                                <tr class="gradeA <?= $list ?>">
                                    <td class="c"><?php echo $i; ?></td>
                                    <td class="l"><?php echo $sql_employee_detail['emp_name']; ?></td>
                                    <td class="c"><?php echo $sql_employee_detail['emp_position']; ?></td>
                                    <td class="c"><?php echo $get_status['app_employee_status']; ?></td>
                                    <td class="c"><?php echo $get_status['app_teamleader_status']; ?></td>

                                    <td class="c"><?php
                                                    if ($get_status['app_member'] == '0') {
                                                        print "NA";
                                                    } else {
                                                        echo $get_status['app_member_status'];
                                                    } ?></td>
                                    <td class="c"><?php if ($get_status['app_final'] == '0') {
                                                        print "NA";
                                                    } else {
                                                        echo $get_status['app_final_status'];
                                                    } //echo $get_status['app_final_status'];
                                                    ?></td>
                                    <!--<td class="c"><a href="<?php echo base_url(); ?>assign/edit/<?= $sql_check_data['member_id'] ?>">Set Appraiser 1 & 2</a></td>	-->
                                    <!-- <td class="c"><?php echo $row->status; ?></td>-->
                                    <td class="c" align="center">
                                        <?php
                                        //if($sql_appri_detail==0)
                                        if ($sql_check_rows == 0) {
                                        ?>


                                            <a href="<?php echo base_url(); ?>kra/krasystem_admin/<?= $sql_employee_detail['id'] ?>/<?php echo $sql_employee_detail['app_teamleader'] ?>/<?= $sql_employee_detail['sess_year'] ?>" class="i_document icon btn small fr" target="_blank">Appraisal Sheet</a>(<?php echo $sql_employee_detail['id']; ?>)



                                        <?php


                                        } else {
                                        ?>



                                            <a href="<?php echo base_url(); ?>kra/krasystem_admin/<?= $sql_employee_detail['id'] ?>/<?php echo $get_status['app_teamleader'] ?>/<?= $get_status['sess_year'] ?>" class="i_document icon btn small fr" target="_blank">Appraisal Sheet</a>



                                    </td>

                            <?php
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