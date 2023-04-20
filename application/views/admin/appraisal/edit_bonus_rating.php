<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Update Bonus Card
                </h2>

            </div>
            <div class="body">

                <div class="row clearfix">


                    <div class="col-md-12">
                        <?php if (isset($msg) || validation_errors() !== '') : ?>
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                <?= validation_errors(); ?>
                                <?= isset($msg) ? $msg : ''; ?>
                            </div>
                        <?php endif; ?>
                    </div>


                    <?php echo form_open(base_url('admin/appraisal/edit_bonus_rating/'), 'class="form-horizontal"');  ?>


                    <div class="row clearfix">
                        <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="group">Grade</label>
                        </div>

                        <?php
                        foreach ($jeol_score_card_bonus as $key => $value) {  ?>

                            <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php
                                        $name = $value['id'];
                                        ?>
                                        <input type="text" name="<?= "grade_score[$name]" ?>" class="form-control" value="<?= ($value['grade_score']) ?>" required>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>


                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="group">Score From</label>
                        </div>

                        <?php
                        foreach ($jeol_score_card_bonus as $key => $value) {  ?>

                            <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php
                                        $name = $value['id'];
                                        ?>
                                        <input type="text" name="<?= "score_from[$name]" ?>" class="form-control" value="<?= ($value['score_from']) ?>" required>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="group">Score To</label>
                        </div>
                        <?php
                        foreach ($jeol_score_card_bonus as $key => $value) {  ?>

                            <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php
                                        $name = $value['id'];
                                        ?>
                                        <input type="text" name="<?= "score_to[$name]" ?>" class="form-control" value="<?= ($value['score_to']) ?>" required>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>


                    </div>


                    <div class="row clearfix">
                        <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="group">Month</label>
                        </div>

                        <?php
                        foreach ($jeol_score_card_bonus as $key => $value) {  ?>

                            <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php
                                        $name = $value['id'];
                                        ?>
                                        <input type="text" name="<?= "bonus_month[$name]" ?>" class="form-control" value="<?= ($value['bonus_month']) ?>" required>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>


                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <input type="submit" name="submit" value="ADD" class="btn btn-primary m-t-15 waves-effect">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>