<!-- JQuery DataTable Css -->
<link href="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Timesheet Schedule
                </h2>
                <a href="<?= base_url('user/schedule/add_schedule'); ?>" class="btn bg-deep-orange waves-effect pull-right"><i class="material-icons">person_add</i> Add New</a>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
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
                            <?php $i = 0;
                            foreach ($schedule as $row) :
                            ?>
                                <tr>
                                    <td><?= ++$i; ?></td>
                                    <td><?= $this->db->get_where('jeol_employee_tbl', array('id =' => $row['user_id']))->row()->emp_name; ?></td>

                                    <td><?= $this->db->get_where('customer', array('cust_id =' => $row['company']))->row()->cust_name ?></td>
                                    
                                    <td><?= $row['product_segment']; ?></td>
                                    <td><?= $row['service_type']; ?></td>


                                    <td><?= $row['start_date'] . '  ' . $row['end_date']; ?></td>
                                    <td><?= $row['start_time_appm'] . ' To ' . $row['end_time_appm']; ?></td>
                                    
                                    <td><a target="_blank" href="<?= base_url('uploads/' . $row['document']); ?>">Download</a></td>
                                    <td class="c">
                                        <!-- <a title="Edit" class="update btn btn-sm btn-primary m-r-10" href="<?= (base_url('user/schedule/add_schedule/' . $row['id'])) ?>">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a title="Delete" class="delete btn btn-sm btn-danger ' . $disabled . '" data-href="<?= base_url('user/schedule/del_schedule/' . $row['id']) ?>" data-toggle="modal" data-target="#confirm-delete">
                                            <i class="material-icons">delete</i>
                                        </a> -->
                                        <!-- <a href="<?= (base_url('admin/customer/add_customer/' . $row['id'])) ?>">Edit</a> | <a href="">Delete</a> -->
                                        #
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
