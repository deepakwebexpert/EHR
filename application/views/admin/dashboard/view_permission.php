<!-- JQuery DataTable Css -->
<link href="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Manage Permissions
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>S#</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach ($module as $key => $row) :
                            ?>
                                <tr>
                                    <td><?= ++$i; ?></td>
                                    <td><?= $row['name']; ?></td>
                                    <td>
                                        <input type="checkbox" data-menu_id="<?= ($row['id']) ?>" class="form-control save_menu" style="opacity:1;position:inherit">
                                    </td>
                                    <td>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Permission</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $subMenus = $this->db->get_where('jeol_modules_tbl', array('par_id =' => $row['id'], 'status' => 1))->result_array();
                                                foreach ($subMenus as $key1 => $value1) {


                                                ?>
                                                    <tr>
                                                        <td><?= ($value1['name']) ?></td>
                                                        <td> <input type="checkbox" data-menu_id="<?= ($row['id']) ?>" data-sub_menu_id="<?= ($value1['id']) ?>" class="save_menu form-control" style="opacity:1;position:inherit"></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
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
<script>
    $(".save_menu").change(function() {
        var group_id = "<?= $id ?>";
        var menu_id = $(this).data("menu_id");
        var sub_menu_id = $(this).data("sub_menu_id");
        var url = '<?= base_url('/admin/dashboard/ajax_data') ?>';

        if ($(this).is(":checked")) {


            $.get(url, {
                    group_id: group_id,
                    menu_id: menu_id,
                    sub_menu_id: sub_menu_id,
                    status: 1
                })
                .done(function(data) {});
        } else {

            $.get(url, {
                    group_id: group_id,
                    menu_id: menu_id,
                    sub_menu_id: sub_menu_id,
                    status: 0
                })
                .done(function(data) {});

        }
    });
</script>