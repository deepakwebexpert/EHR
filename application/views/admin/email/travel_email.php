<!-- JQuery DataTable Css -->
<link href="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Leave Mail Listing
                </h2>
                <a href="<?= base_url('admin/email/add_travel_emails'); ?>" class="btn bg-deep-orange waves-effect pull-right"><i class="material-icons">person_add</i> Add New</a>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>S#</th>
                                <th>Employee</th>
                                <th>Reporting Person (To)</th>
                                <th>CC To</th>
                                <th>2nd CC To</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach ($department as $row) :
                            ?>
                                <tr>
                                    <td><?= ++$i; ?></td>
                                    <td><?= $this->db->get_where('jeol_employee_tbl', array('id =' => $row['emp_id']))->row()->emp_name; ?></td>
                                    <td><?= $row['emp_to']; ?></td>
                                    <td><?= $row['emp_cc']; ?></td>
                                    <td><?= $row['emp_cc_two']; ?></td>
                                    <td class="c">
                                        <a class="btn btn-primary" href="<?= (base_url('admin/email/add_travel_emails/' . $row['id'])) ?>"><i class="material-icons">edit</i></a> <a  class="delete btn btn-sm btn-danger" href=""><i class="material-icons">delete</i></a>
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