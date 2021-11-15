<?php

  require_once 'require/database.php';
  $database = new Database();

  include_once 'include/header.php';
?>
<script>
  function change_status(id,status) {

    var ajax;
    if (window.XMLHttpRequest) {
      ajax = new XMLHttpRequest();
    }else{
      ajax = new ActiveXObject("Microsot.XMLHTTP");
    }

    ajax.onreadystatechange = function(){

      if (ajax.status == 200 && ajax.readyState == 4) {
        alert(ajax.responseText);
        location.reload();
      }
    }
    ajax.open("GET","ajax_process.php?action=update_status&id="+id+"&status="+status);
    ajax.send();
  }
</script>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Captain</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Captain</li>
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
                          <th>Captain Name</th>
                          <th>Email</th>
                          <th>Phone Number</th>
                          <th>CNIC Number</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        $result = $database->getCaptains();

                        if ($result != false) {

                          while ($captain = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                              <td> <img src="<?php echo $captain['image']; ?>" width="30" alt="Photo"></td>
                              <td><?php echo $captain['full_name']; ?></td>
                              <td><?php echo $captain['email']; ?></td>
                              <td><?php echo $captain['phone_number']; ?></td>
                              <td><?php echo $captain['cnic']; ?></td>
                              <td>
                                <select name="status" id="status" onchange="change_status(<?php echo $captain['user_id'];?>,this.value)">
                                  <?php
                                    if ($captain['status'] == 0) {
                                      ?>
                                      <option selected value="0">Inactice</option>
                                      <option value="1">Actice</option>
                                      <?php
                                    }
                                    if ($captain['status'] == 1) {
                                      ?>
                                      <option value="0">Inactice</option>
                                      <option selected value="1">Actice</option>
                                      <?php
                                    }
                                  ?>
                                </select>
                              </td>

                              <td><a href="<?php echo $captain['user_id']; ?>">Edit</a></td>
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
                    <h3 class="card-title">Add Captain</h3>
                  </div>
                  <form action="captain.php?action=addcaptain" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" class="form-control" name="full_name" id="fullname" placeholder="Full Name">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email">
                      </div>
                      <div class="form-group">
                        <label for="phonenumber">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" id="phonenumber" placeholder="Phone Number">
                      </div>
                      <div class="form-group">
                        <label for="CNICnumber">CNIC Number</label>
                        <input type="text" name="cnic" class="form-control" id="CNICnumber" placeholder="CNIC Number">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
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

              if (isset($_GET['action']) && $_GET['action'] == 'addcaptain') {

                $result = $database->addCaptain($_POST,$_FILES);

                if ($result) {
                  echo "Captain Added Successfully ..!";
                }else{
                  echo "Captain Not Added Try Again Later.";
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