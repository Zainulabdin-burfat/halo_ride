<?php

  require_once 'require/database.php';
  $database = new Database();

  include_once 'include/header.php';
?>
<script src="include/script.js"></script>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Vehicle</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Vehicle</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">

          <div class="row">
            <div class="col-12">

              <?php
              if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'show') {
                ?>
                <div class="card">
                  <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap table-striped">
                      <thead>
                        <tr>
                          <th>Photo</th>
                          <th>Registration#</th>
                          <th>Type</th>
                          <th>Wheels</th>
                          <th>Seats</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        $result = $database->getVehicles();

                        if ($result != false) {

                          while ($vehicle = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                              <td> <img src="<?php echo $vehicle['image']; ?>" width="30" alt="Photo"></td>
                              <td><?php echo $vehicle['registration_number']; ?></td>
                              <td><?php echo $vehicle['type']; ?></td>
                              <td><?php echo $vehicle['wheels']; ?></td>
                              <td><?php echo $vehicle['seats']; ?></td>
                              <td>
                                <select class="form-control" name="status" id="status" onchange="change_status(<?php echo $vehicle['vehicle_id'];?>,this.value,'vehicles')">
                                  <?php
                                    if ($vehicle['status'] == 0) {
                                      ?>
                                      <option selected value="0">Inactice</option>
                                      <option value="1">Actice</option>
                                      <?php
                                    }
                                    if ($vehicle['status'] == 1) {
                                      ?>
                                      <option value="0">Inactice</option>
                                      <option selected value="1">Actice</option>
                                      <?php
                                    }
                                  ?>
                                </select>
                              </td>

                              <td><a href="<?php echo $vehicle['vehicle_id']; ?>">Edit</a></td>
                            </tr>
                        <?php
                          }
                        }

                        ?>

                      </tbody>
                    </table>
                  </div>
                </div>

                <?php
              }
              if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add') {
              ?>
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Add Vehicle</h3>
                  </div>
                  <form action="vehicle.php?action=addVehicle" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="registration_number">Registration Number</label>
                        <input type="text" class="form-control" name="registration_number" id="registration_number" placeholder="Registration Number">
                      </div>
                      <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" class="form-control" name="type" id="type" placeholder="Type">
                      </div>
                      <div class="form-group">
                        <label for="wheels">Wheels</label>
                        <input type="number" class="form-control" name="wheels" id="wheels" placeholder="Wheels">
                      </div>
                      <div class="form-group">
                        <label for="seats">Seats</label>
                        <input type="number" class="form-control" name="seats" id="seats" placeholder="Seats">
                      </div>
                      <div class="form-group">
                        <label for="image">Image</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="image" id="image" class="custom-file-input">
                            <label class="custom-file-label" for="image">Choose file</label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card-footer">
                      <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </div>

                  </form>
                </div>


              <?php
              }

              if (isset($_GET['action']) && $_GET['action'] == 'addVehicle')
              {
                $result = $database->addVehicle($_POST,$_FILES);

                if ($result) {
                  echo "vehicle Added Successfully ..!";
                }else{
                  echo "vehicle Not Added Try Again Later.";
                }
              }
              ?>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>


</div>

<?php
include_once 'include/footer.php';
?>