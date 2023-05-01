<!-- JQuery DataTable Css -->
<link href="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Department Listing
                </h2>
                <a href="<?= base_url('admin/customer/add_department'); ?>" class="btn bg-deep-orange waves-effect pull-right"><i class="material-icons">person_add</i> Add New</a>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>S#</th>
                                <th>Customer Id</th>
                                <th>Customer Name</th>
                                <th>Customer Department</th>
                                <th>End User Name</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Customer Location</th>
                                <th>Customer Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach ($department as $row) :
                            ?>
                                <tr>
                                    <td><?= ++$i; ?></td>
                                    <td><?= $row['cust_id']; ?></td>
                                    <td><?= $this->db->get_where('customer', array('cust_id =' => $row['cust_id']))->row()->cust_name; ?></td>
                                    <td><?= $row['cust_depart']; ?></td>
                                    <td><?= $row['end_user_name']; ?></td>
                                    <td><?= $row['contact_no']; ?></td>
                                    <td><?= $row['email_id']; ?></td>
                                    <td><?= $row['cust_location']; ?></td>
                                    <td><?= $row['cust_address']; ?></td>
                                    <td class="c">
                                        <!-- <a href="<?= (base_url('admin/customer/add_department/' . $row['id'])) ?>">Edit</a> | <a href="">Delete</a> -->

                                        <a title="Edit" class="update btn btn-sm btn-primary m-r-10" href="<?= (base_url('admin/customer/add_department/' . $row['id'])) ?>">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a title="Delete" class="delete btn btn-sm btn-danger ' . $disabled . '" data-href=<?= base_url('admin/customer/department_del/' . $row['id']) ?> data-toggle="modal" data-target="#confirm-delete">
                                            <i class="material-icons">delete</i>
                                        </a>
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


<!-- Modal -->
<div id="confirm-delete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete</h4>
            </div>
            <div class="modal-body">
                <p>As you sure you want to delete.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>
<script>
    //Delete Dialogue
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>



 <!-- Jquery DataTable Plugin Js -->
 <script src="<?= base_url()?>public/plugins/jquery-datatable/jquery.dataTables.js"></script>
  <script src="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
  <script src="<?= base_url()?>public/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
  <script src="<?= base_url()?>public/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
  <script src="<?= base_url()?>public/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
  <script src="<?= base_url()?>public/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
  <script src="<?= base_url()?>public/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
  <script src="<?= base_url()?>public/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
  <script src="<?= base_url()?>public/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
  <!-- Custom Js -->
  <script src="<?= base_url()?>public/js/pages/tables/jquery-datatable.js"></script>