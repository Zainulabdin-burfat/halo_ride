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

			<!-- <div class="container">
				<div class="row">
					<div class="col-12">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th scope="col">Day</th>
									<th scope="col">Article Name</th>
									<th scope="col">Author</th>
									<th scope="col">Shares</th>
									<th scope="col">Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th scope="row">1</th>
									<td>Bootstrap 4 CDN and Starter Template</td>
									<td>Cristina</td>
									<td>2.846</td>
									<td>
										<button type="button" class="btn btn-primary"><i class="far fa-eye"></i></button>
										<button type="button" class="btn btn-success"><i class="fas fa-edit"></i></button>
										<button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
									</td>
								</tr>
								<tr>
									<th scope="row">2</th>
									<td>Bootstrap Grid 4 Tutorial and Examples</td>
									<td>Cristina</td>
									<td>3.417</td>
									<td>
										<button type="button" class="btn btn-primary"><i class="far fa-eye"></i></button>
										<button type="button" class="btn btn-success"><i class="fas fa-edit"></i></button>
										<button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
									</td>
								</tr>
								<tr>
									<th scope="row">3</th>
									<td>Bootstrap Flexbox Tutorial and Examples</td>
									<td>Cristina</td>
									<td>1.234</td>
									<td>
										<button type="button" class="btn btn-primary"><i class="far fa-eye"></i></button>
										<button type="button" class="btn btn-success"><i class="fas fa-edit"></i></button>
										<button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div> -->
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

	if ($database->addBooking($_REQUEST['booking_id'])) {
	?>
		<script>
			alert("Booking Added Successfully ..!");
			// swal("Success", "Booking Added Successfully ..!", "success");
			window.location.href = window.location.origin + "/halo_ride/booking.php?action=show";
		</script>
	<?php

	} else {
	?>
		<script>
			alert("Booking Not Added Please Try Again Later");
			window.location.href = window.location.origin + "/halo_ride/booking.php?action=show";
		</script>
<?php
	}
}
?>

<?php
include_once 'include/footer.php';
?>