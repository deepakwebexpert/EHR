<!-- JQuery DataTable Css -->
<link href="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Projects</h2>

            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th colspan="7">Project Details</th>
                                <th colspan="2">Warranty</th>
                                <th colspan="2">AMC/CMS</th>
                                
                            </tr>
                            <tr>
                                <th>S#</th>
                                <th>Customer</th>
                                <th>Sl.No</th>
                                <th>SG</th>
                                <th>Model</th>
                                <th>Shipping</th>
                                <th>Inst Date</th>
                                <th>Warranty</th>
                                <th>Status</th>
                                <th>AMC/CMS</th>
                                <th>Status</th>
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

                                    <td><a title="Warranty" class="view_warranty btn btn-sm btn-danger " data-report_id="<?= $row['id'] ?>" data-toggle="modal" data-target="#warranty_details">
                                            <i class="material-icons">visibility</i>
                                        </a></td>
                                    <td><?= $row['warranty_status'] . "<br>" . $row['warranty_end_date']; ?></td>


                                    <td><a title="AMC" class="view_amc btn btn-sm btn-danger " data-report_id="<?= $row['id'] ?>" data-toggle="modal" data-target="#view_amc">
                                            <i class="material-icons">visibility</i>
                                        </a></td>
                                    <td><?= $row['amc_status'] . "<br>" . $row['amc_end_date']; ?></td>
                                    
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
<div id="warranty_details" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View Warranty Details</h4>
            </div>
            <div class="modal-body">
                <table id="warranty_details" class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">Warranty Details</th>
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
<div id="view_amc" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View AMC/CMS</h4>
            </div>
            <div class="modal-body">
                <table id="view_amc" class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">AMC/CMC Details</th>
                        </tr>
                    </thead>
                    <tbody id="amc_body">

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

    $(".view_amc").click(function() {
        var report_id = $(this).data("report_id");

        var url = '<?= base_url('/admin/customer/view_report_amc') ?>';
        $.get(url, {
                report_id: report_id
            })
            .done(function(data) {
                $("#amc_body").empty();
                $("#amc_body").append(data)
            });
    });

    
    $(".view_warranty").click(function() {
        var report_id = $(this).data("report_id");

        var url = '<?= base_url('/admin/customer/view_report') ?>';
        $.get(url, {
                report_id: report_id
            })
            .done(function(data) {
                $("#warranty_body").empty();
                $("#warranty_body").append(data)
            });
    });
</script>