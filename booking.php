<?php

require_once 'require/database.php';
$database = new Database();

$result = $database->getRoutes();
include_once 'include/header.php';

?>
<script src="include/script.js"></script>
<link type="text/css" rel="stylesheet" href="css/style.css" />

<?php
	if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'show') {
		?>
			<div class="row">
				<div class="col-sm-12">

					<div id="booking" class="section">
						<div class="section-center">
							<div class="container">
								<div class="row">
									<div class="booking-form">
										<div class="form-header">
											<h1>Book a Ride</h1>
										</div>
										<form action="booking.php?action=add" method="POST">

											<div class="form-group">
												<label for="route">Select Route</label>
												<select class="form-control" id="route" onchange="getBookings(this.value)">
													<option>Select Route</option>
													<?php
													while ($route = mysqli_fetch_assoc($result)) {
													?>
														<option value="<?php echo $route['route_id']; ?>"><?php echo $route['Route']; ?></option>
													<?php
													}
													?>
												</select>
											</div>

											<div id="bookings"></div>

											
											<div class="form-btn">
												<button class="submit-btn">Book Now</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

		<?php

	}
	if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add') {
		
		if($database->addBooking($_REQUEST['booking_id']))
		{
			?>
				<script>
					alert("Booking Added Successfully ..!");
					window.location.href = window.location.origin+"/halo_ride/booking.php?action=show";
				</script>
			<?php
			
		}
		else
		{
			?>
				<script>
					alert("Booking Not Added Please Try Again Later");
					window.location.href = window.location.origin+"/halo_ride/booking.php?action=show";
				</script>
			<?php
		}
	}
?>

<?php
include_once 'include/footer.php';
?>