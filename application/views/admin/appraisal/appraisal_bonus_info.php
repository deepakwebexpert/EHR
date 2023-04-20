<!-- JQuery DataTable Css -->
<link href="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Increment Chart

                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Variable</th>
                                <th>Range</th>
                                <th>A+</th>
                                <th>A</th>
                                <th>B</th>
                                <th>C</th>
                                <th>D</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($increment as $row) :
                            ?>
                                <tr>
                                    <td><?= $row['rating']; ?></td>
                                    <td><?= $row['range_from'] . ' - ' . $row['range_to']; ?></td>
                                    <td><?= $row['yan_a_plus']; ?></td>
                                    <td><?= $row['yan_a']; ?></td>
                                    <td><?= $row['yan_b']; ?></td>
                                    <td><?= $row['yan_c']; ?></td>
                                    <td><?= $row['yan_d']; ?></td>


                                    <td class="c">
                                        <a title="Edit" class="update btn btn-sm btn-primary m-r-10" href=<?= base_url('admin/appraisal/edit_appraisal_bonus_info/' . $row['id']) ?>>
                                            <i class="material-icons">edit</i>
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



<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Appraisal Rating

                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>A+</th>
                                <th>A</th>
                                <th>B</th>
                                <th>C</th>
                                <th>D</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // print_r($jeol_score_card); die;
                            ?>
                            <tr>
                                <td><?= $jeol_score_card[0]['score_from'] . ' - ' . $jeol_score_card[0]['score_to']; ?></td>

                                <td><?= $jeol_score_card[1]['score_from'] . ' - ' . $jeol_score_card[1]['score_to']; ?></td>
                                <td><?= $jeol_score_card[2]['score_from'] . ' - ' . $jeol_score_card[2]['score_to']; ?></td>
                                <td><?= $jeol_score_card[3]['score_from'] . ' - ' . $jeol_score_card[3]['score_to']; ?></td>
                                <td><?= $jeol_score_card[4]['score_from'] . ' - ' . $jeol_score_card[4]['score_to']; ?></td>


                                <td class="c">
                                    <a title="Edit" class="update btn btn-sm btn-primary m-r-10" href=<?= base_url('admin/appraisal/edit_appraisal_rating/') ?>>
                                        <i class="material-icons">edit</i>
                                    </a>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Bonus Rating

                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>A+</th>
                                <th>A</th>
                                <th>B+</th>
                                <th>B</th>
                                <th>C+</th>
                                <th>C</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // print_r($jeol_score_card); die;
                            ?>
                            <tr>
                                <td><?= $jeol_score_card_bonus[0]['score_from'] . ' - ' . $jeol_score_card_bonus[0]['score_to']; ?></td>

                                <td><?= $jeol_score_card_bonus[1]['score_from'] . ' - ' . $jeol_score_card_bonus[1]['score_to']; ?></td>
                                <td><?= $jeol_score_card_bonus[2]['score_from'] . ' - ' . $jeol_score_card_bonus[2]['score_to']; ?></td>
                                <td><?= $jeol_score_card_bonus[3]['score_from'] . ' - ' . $jeol_score_card_bonus[3]['score_to']; ?></td>
                                <td><?= $jeol_score_card_bonus[4]['score_from'] . ' - ' . $jeol_score_card_bonus[4]['score_to']; ?></td>
                                <td><?= $jeol_score_card_bonus[5]['score_from'] . ' - ' . $jeol_score_card_bonus[5]['score_to']; ?></td>


                                <td class="c">
                                    <a title="Edit" class="update btn btn-sm btn-primary m-r-10" href=<?= base_url('admin/appraisal/edit_bonus_rating/') ?>>
                                        <i class="material-icons">edit</i>
                                    </a>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>