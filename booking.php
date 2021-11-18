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
											<!-- <div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<span class="form-label">Name</span>
													<input class="form-control" type="text" placeholder="Enter your name">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<span class="form-label">Email</span>
													<input class="form-control" type="email" placeholder="Enter your email">
												</div>
											</div>
										</div>
										<div class="form-group">
											<span class="form-label">Phone</span>
											<input class="form-control" type="tel" placeholder="Enter your phone number">
										</div> -->


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

											<!-- <div class="row">
											<div class="col-sm-5">
												<div class="form-group">
													<span class="form-label">Pickup Date</span>
													<input class="form-control" type="date" required>
												</div>
											</div>
											<div class="col-sm-7">
												<div class="row">
													<div class="col-sm-4">
														<div class="form-group">
															<span class="form-label">Hour</span>
															<select class="form-control">
																<option>1</option>
																<option>2</option>
																<option>3</option>
																<option>4</option>
																<option>5</option>
																<option>6</option>
																<option>7</option>
																<option>8</option>
																<option>9</option>
																<option>10</option>
																<option>11</option>
																<option>12</option>
															</select>
															<span class="select-arrow"></span>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<span class="form-label">Min</span>
															<select class="form-control">
																<option>05</option>
																<option>10</option>
																<option>15</option>
																<option>20</option>
																<option>25</option>
																<option>30</option>
																<option>35</option>
																<option>40</option>
																<option>45</option>
																<option>50</option>
																<option>55</option>
															</select>
															<span class="select-arrow"></span>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<span class="form-label">AM/PM</span>
															<select class="form-control">
																<option>AM</option>
																<option>PM</option>
															</select>
															<span class="select-arrow"></span>
														</div>
													</div>
												</div>
											</div>
										</div> -->
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
					</script>
			<?php
			
		}
		else
		{
			?>
				<script>
					alert("Booking Not Added Please Try Again Later");
				</script>
			<?php
		}
	}
?>

<?php
include_once 'include/footer.php';
?>