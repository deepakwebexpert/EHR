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
                        <div class="text">NEW USERS</div>
                        <div class="number count-to" data-from="0" data-to="<?= $all_users; ?>" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">people</i>
                    </div>
                    <div class="content">
                        <div class="text">ACTIVE USERS</div>
                        <div class="number count-to" data-from="0" data-to="<?= $active_users; ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">block</i>
                    </div>
                    <div class="content">
                        <div class="text">INACTIVE USERS</div>
                        <div class="number count-to" data-from="0" data-to="<?= $deactive_users; ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">equalizer</i>
                    </div>
                    <div class="content">
                        <div class="text">NEW VISITORS</div>
                        <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->
        <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2>CPU USAGE (%)</h2>
                            </div>
                            <div class="col-xs-12 col-sm-6 align-right">
                                <div class="switch panel-switch-btn">
                                    <span class="m-r-10 font-12">REAL TIME</span>
                                    <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                                </div>
                            </div>
                        </div>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div id="real_time_chart" class="dashboard-flot-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# CPU Usage -->
        <div class="row clearfix">
            <!-- Visitors -->
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="body bg-pink">
                        <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff" data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)" data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)" data-fill-Color="rgba(0, 188, 212, 0)">
                            12,10,9,6,5,6,10,5,7,5,12,13,7,12,11
                        </div>
                        <ul class="dashboard-stat-list">
                            <li>
                                TODAY
                                <span class="pull-right"><b>1 200</b> <small>USERS</small></span>
                            </li>
                            <li>
                                YESTERDAY
                                <span class="pull-right"><b>3 872</b> <small>USERS</small></span>
                            </li>
                            <li>
                                LAST WEEK
                                <span class="pull-right"><b>26 582</b> <small>USERS</small></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #END# Visitors -->
            <!-- Latest Social Trends -->
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="body bg-cyan">
                        <div class="m-b--35 font-bold">LATEST SOCIAL TRENDS</div>
                        <ul class="dashboard-stat-list">
                            <li>
                                #socialtrends
                                <span class="pull-right">
                                    <i class="material-icons">trending_up</i>
                                </span>
                            </li>
                            <li>
                                #materialdesign
                                <span class="pull-right">
                                    <i class="material-icons">trending_up</i>
                                </span>
                            </li>
                            <li>#adminbsb</li>
                            <li>#freeadmintemplate</li>
                            <li>#bootstraptemplate</li>
                            <li>
                                #freehtmltemplate
                                <span class="pull-right">
                                    <i class="material-icons">trending_up</i>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #END# Latest Social Trends -->
            <!-- Answered Tickets -->
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="body bg-teal">
                        <div class="font-bold m-b--35">ANSWERED TICKETS</div>
                        <ul class="dashboard-stat-list">
                            <li>
                                TODAY
                                <span class="pull-right"><b>12</b> <small>TICKETS</small></span>
                            </li>
                            <li>
                                YESTERDAY
                                <span class="pull-right"><b>15</b> <small>TICKETS</small></span>
                            </li>
                            <li>
                                LAST WEEK
                                <span class="pull-right"><b>90</b> <small>TICKETS</small></span>
                            </li>
                            <li>
                                LAST MONTH
                                <span class="pull-right"><b>342</b> <small>TICKETS</small></span>
                            </li>
                            <li>
                                LAST YEAR
                                <span class="pull-right"><b>4 225</b> <small>TICKETS</small></span>
                            </li>
                            <li>
                                ALL
                                <span class="pull-right"><b>8 752</b> <small>TICKETS</small></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #END# Answered Tickets -->
        </div>

        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="header">
                        <h2>TASK INFOS</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Task</th>
                                        <th>Status</th>
                                        <th>Manager</th>
                                        <th>Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Task A</td>
                                        <td><span class="label bg-green">Doing</span></td>
                                        <td>John Doe</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Task B</td>
                                        <td><span class="label bg-blue">To Do</span></td>
                                        <td>John Doe</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Task C</td>
                                        <td><span class="label bg-light-blue">On Hold</span></td>
                                        <td>John Doe</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-light-blue" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Task D</td>
                                        <td><span class="label bg-orange">Wait Approvel</span></td>
                                        <td>John Doe</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Task E</td>
                                        <td>
                                            <span class="label bg-red">Suspended</span>
                                        </td>
                                        <td>John Doe</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-red" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
            <!-- Browser Usage -->
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="header">
                        <h2>BROWSER USAGE</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div id="donut_chart" class="dashboard-donut-chart"></div>
                    </div>
                </div>
            </div>
            <!-- #END# Browser Usage -->
        </div>
    </div>

    <script src="<?= base_url() ?>public/plugins/jquery-countto/jquery.countTo.js"></script>

    <script src="<?= base_url() ?>public/plugins/raphael/raphael.min.js"></script>
    <script src="<?= base_url() ?>public/plugins/morrisjs/morris.js"></script>

    <script src="<?= base_url() ?>public/plugins/chartjs/Chart.bundle.js"></script>

    <script src="<?= base_url() ?>public/plugins/flot-charts/jquery.flot.js"></script>
    <script src="<?= base_url() ?>public/plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="<?= base_url() ?>public/plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="<?= base_url() ?>public/plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="<?= base_url() ?>public/plugins/flot-charts/jquery.flot.time.js"></script>

    <script src="<?= base_url() ?>public/plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <script src="<?= base_url() ?>public/js/pages/index.js"></script>
<?php
elseif ($group_id == 28) : ?>
    <link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

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
                <?php echo form_open(base_url('admin/dashboard'), 'class="form-horizontal"');  ?>


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
                                        <input type="date" name="start_date" class="form-control" value="<?= ($schedule['start_date']) ?>" required>
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
                                        <input type="time" name="start_time_appm" class="form-control" value="<?= ($schedule['start_time_appm']) ?>" required>
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
                                        <input type="date" name="end_date" class="form-control" value="<?= ($schedule['end_date']) ?>" required>
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
                                        <input type="time" name="end_time_appm" class="form-control" value="<?= ($schedule['end_time_appm']) ?>" required>
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
                                                <option value="<?= $group['cust_id']; ?>" <?= ($schedule['company'] == $group['cust_id'] ? 'selected' : '') ?>><?= $group['cust_name'] . '--' . ($group['status'] == 0 ? "Not Approved" : "Approved"); ?></option>
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
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="username">Meeting Agenda</label>
                            </div>
                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="meeting_agenda" class="form-control" value="<?= ($schedule['meeting_agenda']) ?>" required>
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
                                        <textarea rows="5" cols="45" name="description"><?= ($schedule['description']) ?></textarea>
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
                                        <select class="form-control show-tick" name="service_type" required>
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
                                        <input type="text" name="visit_count" class="form-control" value="<?= ($schedule['visit_count']) ?>" required>
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
                                        <input type="file" name="document" class="form-control" required>
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

                                title: '<?php echo $sql_check_data->company . '   ' . $sql_check_data->meeting_agenda; ?>',
                                start: '<?php echo $sql_check_data->start_date; ?>',

                                end: '<?php echo $sql_check_data->end_date; ?>'



                            },

                        <?php $i++;
                        }  ?>

                    ]


                });


            });
    </script>
<?php elseif ($group_id == 26) : ?>
    
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