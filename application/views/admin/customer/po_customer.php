<div class="container-fluid">


    <!-- Custom Content -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        PO Documents
                    </h2>
                </div>
                <div class="body">
                    <div class="row">
                        <?php
                        foreach ($images as $key => $value) :

                        ?>
                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <!-- <img src="<?= base_url("uploads/") . $value['file_name'] ?>"> -->
                                    <embed style="width:100%" src="<?= base_url("uploads/") . $value['file_name'] ?>">
                                    <div class="caption">
                                        <h3><?= $value['file_name'] ?></h3>
                                        <p>
                                            <a target="_blank" href="<?= base_url("uploads/") . $value['file_name'] ?>" class="btn btn-primary waves-effect" role="button">View</a>
                                            <a href="<?= base_url("admin/customer/delete_po/") . $value['id'] ?>" class="btn btn-primary waves-effect" role="button">Delete</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Custom Content -->
</div>