<?php
if ($group_id == 6) :
?>
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">face</i>
                    </div>
                    <div class="content">
                        <div class="text">New Projects</div>
                        <div class="number count-to"><?= $all_projects ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">people</i>
                    </div>
                    <div class="content">
                        <div class="text">Expired Projects</div>
                        <div class="number count-to"><?= $expired_projects ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">block</i>
                    </div>
                    <div class="content">
                        <div class="text">Expired Projects In 1 Month</div>
                        <div class="number count-to"><?= $exp_1_month ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">equalizer</i>
                    </div>
                    <div class="content">
                        <div class="text">No. Of Employees</div>
                        <div class="number count-to"><?= $employees ?></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->


        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>New Scheduled Clients</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i;
                                    foreach ($scheduled_clients as $key => $value) : ?>
                                        <tr>
                                            <td><?= ++$i ?></td>
                                            <td><?= $value['cust_name'] ?></td>
                                            <td><?= $value['cust_location'] ?></td>
                                            <td><?= $value['cust_address'] ?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Last 10 Days Order Received</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i;
                                    foreach ($scheduled_clients as $key => $value) : ?>
                                        <tr>
                                            <td><?= ++$i ?></td>
                                            <td><?= $value['cust_name'] ?></td>
                                            <td><?= $value['cust_location'] ?></td>
                                            <td><?= $value['cust_address'] ?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Projects Expiring in 10 Days</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>Sl. No.</th>
                                        <th>SG</th>
                                        <th>Model</th>
                                        <th>Shipping</th>
                                        <th>Inst Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($project_expired_in_10_days as $key => $row) : ?>
                                        <tr>
                                            <td><?= ++$i ?></td>
                                            <td><?= $this->db->get_where('customer', array('cust_id =' => $row['cust_id']))->row()->cust_name; ?></td>
                                            <td><?= $row['po_no']; ?></td>
                                            <td><?= $row['model_no']; ?></td>
                                            <td><?= $row['serial_no']; ?></td>
                                            <td><?= $row['shipment_date']; ?></td>
                                            <td><?= $row['installation_date']; ?></td>

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
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>AMC Expiring in 10 Days</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>AMC Amount</th>
                                        <th>AMC Start Date</th>
                                        <th>AMC End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($amc_expired_in_10_days as $key => $row) : ?>
                                        <tr>
                                            <td><?= ++$i ?></td>
                                            <td><?= $this->db->get_where('customer', array('cust_id =' => $row['cust_id']))->row()->cust_name; ?></td>
                                            <td><?= $row['amc_amount']; ?></td>
                                            <td><?= $row['amc_start_date']; ?></td>
                                            <td><?= $row['amc_end_date']; ?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="<?= base_url() ?>public/plugins/jquery-countto/jquery.countTo.js"></script>

    <script src="<?= base_url() ?>public/plugins/raphael/raphael.min.js"></script>
    <script src="<?= base_url() ?>public/plugins/morrisjs/morris.js"></script>

    <script src="<?= base_url() ?>public/plugins/chartjs/Chart.bundle.js"></script>

    <script src="<?= base_url() ?>public/plugins/flot-charts/jquery.flot.js"></script>
    <script src="<?= base_url() ?>public/plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="<?= base_url() ?>public/plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="<?= base_url() ?>public/plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="<?= base_url() ?>public/plugins/flot-charts/jquery.flot.time.js"></script>

    <script src="<?= base_url() ?>public/plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <script src="<?= base_url() ?>public/js/pages/index.js"></script> -->
<?php
elseif ($group_id == 28) : ?>
    <link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Last 10 Orders</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                    <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>Sl. No.</th>
                                        <th>SG</th>
                                        <th>Model</th>
                                        <th>Shipping</th>
                                        <th>Inst Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($emp_last_10_projects as $key => $row) : ?>
                                        <tr>
                                            <td><?= ++$i ?></td>
                                            <td><?= $this->db->get_where('customer', array('cust_id =' => $row['cust_id']))->row()->cust_name; ?></td>
                                            <td><?= $row['po_no']; ?></td>
                                            <td><?= $row['model_no']; ?></td>
                                            <td><?= $row['serial_no']; ?></td>
                                            <td><?= $row['shipment_date']; ?></td>
                                            <td><?= $row['installation_date']; ?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">

        <div class="header">
            <h2>
                Add Schedule
            </h2>
        </div>
        <div class="body">

            <!-- <div class="row clearfix">
                <?php echo form_open(base_url('admin/dashboard'), 'class="form-horizontal"');  ?>


                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="username">Company Name</label>
                    </div>
                    <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <select class="form-control show-tick live_search department_change" data-live-search="true" name="app_employee">
                                    <option>View Customers</option>
                                    <?php foreach ($all_customers as $group) : ?>
                                        <option><?= $group['cust_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="username">Date / Time</label>
                    </div>
                    <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                              <?= date('d-m-Y h:i:s a', time()); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="username">Comment</label>
                    </div>
                    <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="cust_location" class="form-control" value="<?= ($customer['cust_location']) ?>" required>
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

            </div> -->


            <div class="row clearfix">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-5 form-control-label">
                        <?php echo form_open_multipart(base_url('admin/users/add_schedule/' . $id), 'class="form-horizontal"');  ?>


                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="username">Start Date</label>
                            </div>
                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" name="s_date" class="form-control" value="<?= ($schedule['date']) ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="username">Start Time</label>
                            </div>
                            <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="time" name="start_date" class="form-control" value="<?= ($schedule['start_date']) ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control" name="start_date_ampm" required>
                                            <option value="A.M" <?= ($schedule['start_date_ampm'] == "A.M" ? "selected" : '') ?>>A.M</option>
                                            <option value="P.M" <?= ($schedule['start_date_ampm'] == "P.M" ? "selected" : '') ?>>P.M</option>
                                        </select>
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
                                        <input type="date" name="final_date" class="form-control" value="<?= ($schedule['final_date']) ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="username">Approx End Time</label>
                            </div>
                            <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="time" name="end_date" class="form-control" value="<?= ($schedule['end_date']) ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control" name="end_date_ampm" required>
                                            <option value="A.M" <?= ($schedule['end_date_ampm'] == "A.M" ? "selected" : '') ?>>A.M</option>
                                            <option value="P.M" <?= ($schedule['end_date_ampm'] == "P.M" ? "selected" : '') ?>>P.M</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="group">Company</label>
                            </div>
                            <div class="col-lg-7 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick live_search company_change" data-live-search="true" name="company" required>
                                            <option value="">-- Please select --</option>
                                            <?php foreach ($customer_data as $group) : ?>
                                                <option value="<?= $group['id']; ?>" <?= ($schedule['company'] == $group['cust_id'] ? 'selected' : '') ?>><?= $group['cust_name'] . '--' . ($group['status'] == 0 ? "Not Approved" : "Approved"); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 form-control-label" style="text-align: left;">
                                <a href="<?= base_url('admin/customer/add_customer') ?>" class="btn btn-primary">Add</a>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="group">Department</label>
                            </div>
                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick live_search department_change" data-live-search="true" name="department">
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
                                        <select class="form-control show-tick live_search project_change" data-live-search="true" name="project">
                                            <option value="">-- Please select --</option>
                                            <?php foreach ($project as $group) : ?>
                                                <option value="<?= $group['id']; ?>" <?= ($schedule['project'] == $group['id'] ? 'selected' : '') ?>><?= $group['instrument']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="group">Product Segment</label>
                            </div>
                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="product_segment" required>
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
                        </div> -->

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="username">Meeting Agenda</label>
                            </div>
                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="meeting_time" class="form-control" value="<?= ($schedule['meeting_time']) ?>" required>
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
                                        <textarea rows="5" cols="50" name="description"><?= ($schedule['description']) ?></textarea>
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
                                        <select class="form-control show-tick" name="company_services">
                                            <option value="Sales/Installation/Trainee">Sales/Installation/Trainee</option>
                                            <option value="AMC/CMC" <?= ($schedule['company_services'] == "AMC/CMC" ? "selected" : '') ?>>>AMC/CMC</option>
                                            <option value="Warranty/Demand" <?= ($schedule['company_services'] == "Warranty/Demand" ? "selected" : '') ?>>Warranty/Demand</option>
                                            <option value="Enquiry/Other" <?= ($schedule['company_services'] == "Enquiry/Other" ? "selected" : '') ?>>Enquiry/Other</option>
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
                                        <input type="text" name="visit" class="form-control" value="<?= ($schedule['visit']) ?>" required>
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
                    <div class="col-lg-86 col-md-6 col-sm-8 col-xs-7">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>




        </div>

    </div>
    <link href='<?= base_url() ?>public/plugins/calendar/fullcalendar.min.css' rel='stylesheet' />
    <link href='<?= base_url() ?>public/plugins/calendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src="<?= base_url() ?>public/plugins/calendar/moment.min.js"></script>
    <script src="<?= base_url() ?>public/plugins/calendar/fullcalendar.min.js"></script>
    <script>
        $(document).ready(function()


            {

                $('#calendar').fullCalendar({

                    defaultDate: '<?= date('Y-m-d') ?>',

                    eventLimit: true,

                    events: [

                        <?php




                        static $i = 1;
                        foreach ($calendar as $sql_check_data) {


                        ?>

                            {

                                title: '<?php echo $sql_check_data->company_services; ?>',
                                start: '<?php echo $sql_check_data->date; ?>',
                                end: '<?php echo $sql_check_data->final_date; ?>'



                            },

                        <?php $i++;
                        }  ?>

                    ]


                });


            });
    </script>
<?php elseif ($group_id == 26) : ?>

    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">face</i>
                    </div>
                    <div class="content">
                        <div class="text">New Projects</div>
                        <div class="number count-to"><?= $tl_all_projects ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">people</i>
                    </div>
                    <div class="content">
                        <div class="text">Expired Projects</div>
                        <div class="number count-to"><?= $tl_expired_projects ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">block</i>
                    </div>
                    <div class="content">
                        <div class="text">Expired Projects In 1 Month</div>
                        <div class="number count-to"><?= $tl_exp_1_month ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">equalizer</i>
                    </div>
                    <div class="content">
                        <div class="text">No. Of Employees</div>
                        <div class="number count-to"><?= $tl_employees ?></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->


        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>New Scheduled Clients</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i;
                                    foreach ($tl_scheduled_clients as $key => $value) : ?>
                                        <tr>
                                            <td><?= ++$i ?></td>
                                            <td><?= $value['cust_name'] ?></td>
                                            <td><?= $value['cust_location'] ?></td>
                                            <td><?= $value['cust_address'] ?></td>

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
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Projects Expiring in 10 Days</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>Sl. No.</th>
                                        <th>SG</th>
                                        <th>Model</th>
                                        <th>Shipping</th>
                                        <th>Inst Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($tl_project_expired_in_10_days as $key => $row) : ?>
                                        <tr>
                                            <td><?= ++$i ?></td>
                                            <td><?= $this->db->get_where('customer', array('cust_id =' => $row['cust_id']))->row()->cust_name; ?></td>
                                            <td><?= $row['po_no']; ?></td>
                                            <td><?= $row['model_no']; ?></td>
                                            <td><?= $row['serial_no']; ?></td>
                                            <td><?= $row['shipment_date']; ?></td>
                                            <td><?= $row['installation_date']; ?></td>

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
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>AMC Expiring in 10 Days</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>AMC Amount</th>
                                        <th>AMC Start Date</th>
                                        <th>AMC End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($tl_amc_expired_in_10_days as $key => $row) : ?>
                                        <tr>
                                            <td><?= ++$i ?></td>
                                            <td><?= $this->db->get_where('customer', array('cust_id =' => $row['cust_id']))->row()->cust_name; ?></td>
                                            <td><?= $row['amc_amount']; ?></td>
                                            <td><?= $row['amc_start_date']; ?></td>
                                            <td><?= $row['amc_end_date']; ?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="body">
            <div id='calendar'></div>
        </div>
    </div>

    <link href='<?= base_url() ?>public/plugins/calendar/fullcalendar.min.css' rel='stylesheet' />
    <link href='<?= base_url() ?>public/plugins/calendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src="<?= base_url() ?>public/plugins/calendar/moment.min.js"></script>
    <script src="<?= base_url() ?>public/plugins/calendar/fullcalendar.min.js"></script>
    <script>
        $(document).ready(function()


            {

                $('#calendar').fullCalendar({

                    defaultDate: '<?= date('Y-m-d') ?>',

                    eventLimit: true,

                    events: [

                        <?php

                        static $i = 1;
                        foreach ($tl_calendar as $sql_check_data) {


                        ?> {

                                title: '<?php echo $sql_check_data->company_services; ?>',
                                start: '<?php echo $sql_check_data->date; ?>',
                                end: '<?php echo $sql_check_data->final_date; ?>'


                            },

                        <?php $i++;
                        }  ?>

                    ]


                });


            });
    </script>
<?php endif; ?>



<script>
    $(".company_change").change(function() {
        var cust_id = $(this).val();

        var url = '<?= base_url('/admin/users/ajax_data') ?>';
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

        var url = '<?= base_url('/admin/users/ajax_data') ?>';
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