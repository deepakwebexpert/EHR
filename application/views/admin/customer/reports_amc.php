<!-- JQuery DataTable Css -->
<link href="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Projects</h2>

                <?php echo form_open(base_url('admin/customer/reports_amc/'), 'class="form-horizontal"');  ?>

                <div class="row clearfix">
                    <div class="col-lg-5 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="username"></label>
                    </div>
                    <!-- <div class="col-lg-2 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <select class="form-control show-tick live_search department_change" data-live-search="true" name="warranty_status">
                                    <option>Warranty Status</option>
                                    <option value="NotYet" <?= ($warranty_status == "NotYet" ? 'selected' : '') ?>>Not Yet</option>
                                    <option value="Expired" <?= ($warranty_status == "Expired" ? 'selected' : '') ?>>Expired</option>
                                    <option value="Valid" <?= ($warranty_status == "Valid" ? 'selected' : '') ?>>Valid</option>
                                    <option value="TO BE EXPIRED" <?= ($warranty_status == "TO BE EXPIRED" ? 'selected' : '') ?>>To Be Expired</option>
                                </select>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-2 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <select class="form-control show-tick live_search department_change" data-live-search="true" name="amc_status">
                                    <option>AMC Status</option>
                                    <option value="NotYet" <?= ($amc_status == "NotYet" ? 'selected' : '') ?>>Not yet</option>
                                    <option value="Expired" <?= ($amc_status == "Expired" ? 'selected' : '') ?>>Expired</option>
                                    <option value="Valid" <?= ($amc_status == "Valid" ? 'selected' : '') ?>>Valid</option>
                                    <option value="TO BE EXPIRED" <?= ($amc_status == "TO BE EXPIRED" ? 'selected' : '') ?>>To Be Expired</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <input type="submit" value="Search" name="submit" class="btn btn-primary">
                        </div>
                    </div>

                    <?php if ($group_id == 6) : ?>
                        <a href="<?= base_url('admin/customer/add_reports'); ?>" class="col-lg-1 col-md-10 col-sm-8 col-xs-7 btn bg-deep-orange waves-effect pull-right"><i class="material-icons">person_add</i> Add New</a>
                    <?php endif; ?>
                </div>
                <?php echo form_close(); ?>


            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th colspan="7">Project Details</th>
                                <th colspan="2">AMC/CMS</th>
                                <th colspan="2"></th>
                            </tr>
                            <tr>
                                <th>S#</th>
                                <th>Customer</th>
                                <th>Sl.No</th>
                                <th>SG</th>
                                <th>Model</th>
                                <th>Shipping</th>
                                <th>Inst Date</th>
                                <th>AMC/CMS</th>
                                <th>Status</th>
                                <?= ($group_id == 6 ? "<th>Action</th>" : "") ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach ($reports as $row) :
                            ?>
                                <tr>
                                    <td><?= ++$i; ?></td>
                                    <td><?= $this->db->get_where('customer', array('cust_id =' => $row['cust_id']))->row()->cust_name; ?></td>
                                    <td><?= $row['po_no']; ?></td>
                                    <td><?= $row['model_no']; ?></td>
                                    <td><?= $row['serial_no']; ?></td>
                                    <td><?= $row['shipment_date']; ?></td>
                                    <td><?= $row['installation_date']; ?></td>
                                    <td><a title="AMC" class="view_warranty btn btn-sm btn-danger " data-report_id="<?= $row['id'] ?>" data-toggle="modal" data-target="#warranty_details">
                                            <i class="material-icons">visibility</i>
                                        </a></td>
                                    <td><?= $row['amc_status'] . "<br>" . $row['amc_end_date']; ?></td>
                                    <?php
                                    if ($group_id == 6) :
                                    ?>
                                        <td class="c">
                                            <!-- <a href="<?= (base_url('admin/customer/add_reports/' . $row['id'])) ?>">Edit</a> | <a href="">Delete</a> -->

                                            <a title="Edit" class="update btn btn-sm btn-primary m-r-10" href="<?= (base_url('admin/customer/add_reports/' . $row['id']))  ?>">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <a title="Delete" class="delete btn btn-sm btn-danger m-r-10" data-href=<?= base_url('admin/customer/reports_del/' . $row['id']) ?> data-toggle="modal" data-target="#confirm-delete">
                                                <i class="material-icons">delete</i>
                                            </a>

                                            <a title="View Detail" class="view_detail btn btn-sm btn-primary" data-toggle="modal" data-customer_id="<?= $row['cust_id'] ?>" data-target="#view_detail">
                                                <i class="material-icons">visibility</i>
                                            </a>

                                        </td>
                                    <?php endif; ?>
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


<!-- Modal -->
<div id="warranty_details" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View AMC/CMS</h4>
            </div>
            <div class="modal-body">
                <table id="warranty_details" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">AMC/CMC Details</th>
                        </tr>
                    </thead>
                    <tbody id="warranty_body">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<!-- Modal -->
<div id="view_detail" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Project Details</h4>
            </div>
            <div class="modal-body">
                <table id="view_detail" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th colspan="4" class="text-center">Project Details</th>
                        </tr>
                        <tr>
                            <th>S#</th>
                            <th>Employee</th>
                            <th>Date</th>
                            <th>Cost</th>
                        </tr>
                    </thead>
                    <tbody id="detail_body">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<script>
    //Delete Dialogue
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $(".view_warranty").click(function() {
        var report_id = $(this).data("report_id");

        var url = '<?= base_url('/admin/customer/view_report_amc') ?>';
        $.get(url, {
                report_id: report_id
            })
            .done(function(data) {
                $("#warranty_body").empty();
                $("#warranty_body").append(data)
            });
    });


    $(".view_detail").click(function() {
        var customer_id = $(this).data("customer_id");

        var url = '<?= base_url('/admin/customer/view_detail') ?>';
        $.get(url, {
                customer_id: customer_id
            })
            .done(function(data) {
                $("#detail_body").empty();
                $("#detail_body").append(data)
            });
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