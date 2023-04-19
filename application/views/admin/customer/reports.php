<!-- JQuery DataTable Css -->
<link href="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Reports</h2>
                <a href="<?= base_url('admin/customer/add_reports'); ?>" class="btn bg-deep-orange waves-effect pull-right"><i class="material-icons">person_add</i> Add New</a>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>S#</th>
                                <th>Customer Id</th>
                                <th>Customer Name</th>
                                <th>Customer Instrument</th>
                                <th>Model Number</th>
                                <!-- <th>Contact Number</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach ($reports as $row) :
                            ?>
                                <tr>
                                    <td><?= ++$i; ?></td>
                                    <td><?= $row['cust_id']; ?></td>
                                    <td><?= $this->db->get_where('customer', array('cust_id =' => $row['cust_id']))->row()->cust_name; ?></td>
                                    <td><?= $row['instrument']; ?></td>
                                    <td><?= $row['model_no']; ?></td>
                                    <!-- <td><?= $row['contact_no']; ?></td> -->
                                    <td class="c">
                                        <a href="<?= (base_url('admin/customer/add_reports/' . $row['id'])) ?>">Edit</a> | <a href="">Delete</a>
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
<!-- #END# Exportable Table -->


<!-- <script src="<?= base_url() ?>public/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<script src="<?= base_url() ?>public/js/pages/tables/jquery-datatable.js"></script> -->