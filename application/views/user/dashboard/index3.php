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
<!-- ======================= Scripts for this page ============================== -->



<script>
	$(document).ready(function()


		{

			$('#calendar').fullCalendar({

				defaultDate: '<?= date('Y-m-d') ?>',


				// editable: true,


				eventLimit: true, // allow "more" link when too many events



				events: [

					<?php




					$query = $this->db->query("SELECT * FROM `schedule` ");


					if ($query->num_rows() > 0) {

						static $i = 1;
						foreach ($query->result() as $sql_check_data) {



					?>

							{

								title: '<?php echo $sql_check_data->company . '   ' . $sql_check_data->meeting_agenda; ?>',
								start: '<?php echo $sql_check_data->start_date; ?>',

								end: '<?php echo $sql_check_data->end_date; ?>'



							},

							<?php $i++;
						}
					} else { ?><?php } ?>

						]



			});


		});
</script>