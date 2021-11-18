<?php

  require_once("require/database.php");
  $database = new Database();


  if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update_status') {

    extract($_REQUEST);
    if ($database->change_status($id, $status, $table)) {
      echo 'Status Has Been Updated Successfully ..!';
    } else {
      echo 'Status Not Updated';
    }
  }

  if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'get_bookings') {
    $result = $database->getBookings($_REQUEST['id']);
    ?>
      <div class="form-group">
        <label for="route">Select Booking</label>
        <select name="booking_id" class="form-control" id="route">
          <option>Select Route</option>
          <?php
          while ($booking = mysqli_fetch_assoc($result)) {
          ?>
            <option value="<?php echo $booking['booking_id']; ?>"><?php echo $booking['Vehicle']." - ".$booking['Captain']." - ".$booking['TotalSeats']." - ".$booking['AvailableSeats']." - ".$booking['Route']; ?></option>
          <?php
          }
          ?>
        </select>
      </div>
    <?php
  }

?>