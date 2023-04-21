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
                    Domestic Travel Claim

                </h2>
            </div>


            <div class="body">

                <?php
                if ($this->session->userdata('group_id') == '6') {
                ?>

                    <select class="" onChange="window.location='<?= base_url('admin/users/domestic_travel_claim') ?>/'+this.value">
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
                                <th>Period</th>
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
                                //     $curr_year = date('Y');
                                // } else {

                                //     $con = '';
                                //     $curr_year = $this->uri->segment(3);
                                // }


                                foreach ($emp_data as $key => $value) :

                                    static $j = 1;

                                    $this->db->select('SUM(Amount) as total_amount, status, acc_code');
                                    $this->db->from('jeol_travelexp_tbl');
                                    $this->db->where('sheet_id', $value['sheet_id']);
                                    $this->db->where('acc_code !=', 'Paid By Company');
                                    $this->db->where('sheet_type', '0');
                                    $query = $this->db->get();
                                    $sql_main_result = $query->row_array();



                                    if ($value['status'] == 'Approved') {
                                        $color = '#fff';
                                    } else if ($value['status'] == 'Rejected') {
                                        $color = '#FF0000';
                                    } else {
                                        $color = '#99CC00';
                                    }
                            ?>

                                    <tr style="background-color:<?= $color ?>">
                                        <td class="c">
                                            <input type="checkbox" name="sub_admin_list[]" value="<?= $value['sheet_id'] ?>">
                                        </td>
                                        <td class=""><?= $value['emp_name'] ?></td>
                                        <td class=""> <?php echo date("d-m-Y", strtotime($value['start_date'])); ?> <?php echo $value['start_time']; ?> <?php echo $value['start_time_type']; ?>To <?php echo date("d-m-Y", strtotime($value['end_date'])); ?> <?php echo $value['end_time']; ?> <?php echo $value['end_time_type']; ?></td>
                                        <td class=""><?= number_format($sql_main_result['total_amount']) ?></td>
                                        <td class="l"><?= $value['status'] ?></td>
                                        <td class="c">
                                            <!-- <a href="<?php echo base_url() ?>travel/searchOne/<?= $value['sheet_id'] ?>">View</a> -->
                                            #
                                        </td>
                                    </tr>
                            <?php
                                    $j++;
                                endforeach;
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