<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

<link href="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Timesheet Schedule
                </h2>
                <!-- <a href="<?= base_url('user/schedule/add_schedule'); ?>" class="btn bg-deep-orange waves-effect pull-right"><i class="material-icons">person_add</i> Add New</a> -->
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="new_table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>S#</th>
                                <th>Employee</th>
                                <th>Company</th>
                                <th>Product Code</th>
                                <th>Service Type</th>
                                <th>Schedule Date</th>
                                <th>Time</th>
                                <th>Ref Document</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($group_id == 6) :
                                foreach ($sql_timesheet as $key => $value) {

                                    $timesheet_id = $value['id'];
                                    if ($i % 2 == 0) {
                                        $list = 'odd';
                                    } else {
                                        $list = 'even';
                                    }


                                    $this->db->select('*');
                                    $this->db->from('customer');
                                    $this->db->where('id', $value['company']);
                                    $query = $this->db->get()->row_array();

                                    $this->db->select('*');
                                    $this->db->from('jeol_employee_tbl');
                                    $this->db->where('id', $value['emp_id']);

                                    $query_get_name = $this->db->get()->row_array();



                                    $j++; ?>
                                    <tr class="gradeA <?php echo $list ?>">
                                        <td class=""><?php echo $j; ?></td>
                                        <td class=""><?php echo $query_get_name['emp_name']; ?></td>
                                        <td><?php echo ucfirst(strtolower($query['cust_name'])); ?></td>
                                        <td class=""><?php echo $value['project_code']; ?></td>
                                        <td class="c"><?php echo $value['company_services']; ?></td>
                                        <td class="c"><strong></strong> <?php echo date('d-m-Y', strtotime($value['date'])); ?> - <?php echo date('d-m-Y', strtotime($value['final_date'])); ?>
                                        </td>
                                        <td class="c"><?php echo $value['start_date']; ?> <?php echo $value['start_date_ampm']; ?> To <?php echo $value['end_date']; ?> <?php echo $value['end_date_ampm']; ?>
                                        </td>
                                        <td class="c"><?php if ($value['upload'] == '' || $value['upload'] == '0') { ?>N/A <?php } else { ?>
                                            <a href="<?php echo base_url() . "uploads/" . $value['upload']; ?>" target="_blank" title="Download">Download</a><?php } ?>
                                        </td>

                                        <td class="c">
                                            <a class="btn" href="<?php echo base_url() . "index.php/timesheet/add_view/" . $value['id']; ?>">Details</a>
                                        </td>
                                    </tr>
                                    <?php $i++;
                                }
                            else : {
                                    // while ($query_get_name = mysql_fetch_array($sql_report_person)) {
                                    foreach ($query_get_name as $key => $value) {

                                        $this->db->select('*');
                                        $this->db->from('jeol_timesheet_tbl');
                                        $this->db->where('emp_id', $value['id']);
                                        $query = $this->db->get();


                                        if ($query->num_rows() == 0) {
                                            echo "";
                                        } else {
                                            // $serach_id = $this->uri->segment(3);
                                            if ($group_id != '6') {
                                                // if ($serach_id == '' && $this->session->userdata('group_id') != '6') {

                                                // $timesheet_data = mysql_query("SELECT * FROM `jeol_timesheet_tbl` WHERE emp_id='$value[id]'");
                                                $this->db->select('*');
                                                $this->db->from('jeol_timesheet_tbl');
                                                $this->db->where('emp_id', $value['id']);

                                                $timesheet_data = $this->db->get()->result_array();
                                            }
                                            //  else {

                                            //     $timesheet_data = mysql_query("SELECT * FROM `jeol_timesheet_tbl` WHERE emp_id='$serach_id'");
                                            // }


                                            foreach ($timesheet_data as $key1 => $value1) { {
                                                    // while ($timesheet = mysql_fetch_array($timesheet_data)) {
                                                    $i++;
                                                    // $query = mysql_fetch_array(mysql_query("SELECT * FROM `jeol_customers_tbl` WHERE id='" . $value1['company'] . "'"));
                                                    $this->db->select('*');
                                                    $this->db->from('customer');
                                                    $this->db->where('id', $value1['company']);

                                                    $query = $this->db->get()->row_array();


                                                    if ($i % 2 == 0) {
                                                        $list = 'odd';
                                                    } else {
                                                        $list = 'even';
                                                    } ?>
                                                    <tr class="gradeA <?php echo $list ?>">
                                                        <td class=""><?php echo $i; ?></td>
                                                        <td class=""><?php echo $value['emp_name']; ?></td>
                                                        <td class=""><?php echo $query['cust_name']; ?><BR /><BR /><strong><?php echo $value1['meeting_time']; ?><BR /></strong><?php echo $value1['description']; ?></td>

                                                        <td><?php echo $value1['project_code']; ?></td>
                                                        <td class=""><?php echo $value1['company_services']; ?></td>
                                                        <td class=""><strong>Date:</strong> <?php echo date('d-m-Y', strtotime($value1['date'])); ?> <br /> <strong>Time:</strong> <?php echo $value1['start_date']; ?> <?php echo $value1['start_date_ampm']; ?> To <?php echo $value1['end_date']; ?> <?php echo $value1['end_date_ampm']; ?>
                                                            <br />
                                                            <strong>Service Type:</strong> <?php echo $value1['company_services']; ?>
                                                        </td>
                                                        <td>
                                                            <div><?php echo $value1['meeting_time']; ?></div>
                                                        </td>
                                                        <td class="c"><?php if ($value1['upload'] == '' || $value1['upload'] == '0') { ?>N/A <?php } else { ?>
                                                            <a href="<?php echo base_url() . "uploads/" . $value1['upload']; ?>" target="_blank" title="Download">Download<? //=$timesheet['upload'] 
                                                                                                                                                                            ?></a><?php } ?>
                                                        </td>
                                                        <td class="c">
                                                            <a class="btn" href="<?php echo base_url() . "index.php/timesheet/add_view/" . $value1['id']; ?>">Details</a>
                                                        </td>

                                                    </tr>
                            <?php
                                                }
                                            }
                                        }
                                    }
                                }
                            endif; ?>
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