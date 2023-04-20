<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Timesheet Schedule
                </h2>
                <!-- <a href="<?= base_url('admin/users/'); ?>" class="btn bg-deep-orange waves-effect pull-right">Users List</a> -->
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

                    <?php echo form_open_multipart(base_url('user/schedule/add_schedule/' . $id), 'class="form-horizontal"');  ?>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="username">Start Date</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" name="start_date" class="form-control" value="<?= ($schedule['start_date']) ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="username">Start Time</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="time" name="start_time_appm" class="form-control" value="<?= ($schedule['start_time_appm']) ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="username">End Date</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" name="end_date" class="form-control" value="<?= ($schedule['end_date']) ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="username">Approx End Time</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="time" name="end_time_appm" class="form-control" value="<?= ($schedule['end_time_appm']) ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="group">Company</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick live_search company_change" data-live-search="true" name="company" required>
                                        <option value="">-- Please select --</option>
                                        <?php foreach ($customer_data as $group) : ?>
                                            <option value="<?= $group['cust_id']; ?>" <?= ($schedule['company'] == $group['cust_id'] ? 'selected' : '') ?>><?= $group['cust_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="group">Department</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick live_search department_change" data-live-search="true" name="department" required>
                                        <option value="">-- Please select --</option>
                                        <?php foreach ($department as $group) : ?>
                                            <option value="<?= $group['id']; ?>" <?= ($schedule['department'] == $group['id'] ? 'selected' : '') ?>><?= $group['cust_depart']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="group">Project</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick live_search project_change" data-live-search="true" name="project" required>
                                        <option value="">-- Please select --</option>
                                        <?php foreach ($project as $group) : ?>
                                            <option value="<?= $group['id']; ?>" <?= ($schedule['project'] == $group['id'] ? 'selected' : '') ?>><?= $group['instrument']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="group">Product Segment</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="product_segment">
                                        <option value="">-- Please select --</option>
                                        <option value="ESR" <?= ($schedule['product_segment'] == "ESR" ? "selected" : '') ?>>ESR</option>
                                        <option value="NMR" <?= ($schedule['product_segment'] == "NMR" ? "selected" : '') ?>>NMR</option>
                                        <option value="SEM" <?= ($schedule['product_segment'] == "SEM" ? "selected" : '') ?>>SEM</option>
                                        <option value="TEM" <?= ($schedule['product_segment'] == "TEM" ? "selected" : '') ?>>TEM</option>
                                        <option value="FFSEM" <?= ($schedule['product_segment'] == "FFSEM" ? "selected" : '') ?>>FFSEM</option>
                                        <option value="EPMA" <?= ($schedule['product_segment'] == "EPMA" ? "selected" : '') ?>>EPMA</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="username">Meeting Agenda</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="meeting_agenda" class="form-control" value="<?= ($schedule['meeting_agenda']) ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="username">Description</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea rows="5" cols="120" name="description"><?= ($schedule['description']) ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="group">Service Type</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="service_type">
                                        <option value="Sales/Installation/Trainee">Sales/Installation/Trainee</option>
                                        <option value="AMC/CMC" <?= ($schedule['service_type'] == "AMC/CMC" ? "selected" : '') ?>>>AMC/CMC</option>
                                        <option value="Warranty/Demand" <?= ($schedule['service_type'] == "Warranty/Demand" ? "selected" : '') ?>>Warranty/Demand</option>
                                        <option value="Enquiry/Other" <?= ($schedule['service_type'] == "Enquiry/Other" ? "selected" : '') ?>>Enquiry/Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="username">No of Visit</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="visit_count" class="form-control" value="<?= ($schedule['visit_count']) ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="username">Supporting Document</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="file" name="document" class="form-control">
                                </div>
                            </div>
                        </div>
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
<script>
    $(".company_change").change(function() {
        var cust_id = $(this).val();

        var url = '<?= base_url('/user/schedule/ajax_data') ?>';
        $.get(url, {
                cust_id: cust_id
            })
            .done(function(data) {

                $('.department_change:last').empty();
                $('.project_change:last').empty();
                // $('.department_change:last').append('<option value=0>Select Department</option>');
                $.each(JSON.parse(data), function(key, value) {
                    $('.department_change:last').append('<option value="' + value.id + '">' + value.name + '</option>');
                });


                $('.department_change').selectpicker('refresh');
                $('.project_change:last').selectpicker('refresh');


            });

    });

    $(".department_change").change(function() {
        var cust_dept = $(this).val();

        var url = '<?= base_url('/user/schedule/ajax_data') ?>';
        $.get(url, {
                cust_dept: cust_dept,
                company_id: $('.company_change').find(":selected").val()
            })
            .done(function(data) {

                $('.project_change:last').empty();
                // $('.project_change:last').append('<option value=0>Select Project</option>');


                $.each(JSON.parse(data), function(key, value) {
                    $('.project_change:last').append('<option value="' + value.id + '">' + value.name + '</option>');
                });

                $('.project_change').selectpicker('refresh');

            });

    });
</script>