<?php

  require_once("require/database.php");
  $database = new Database();


  if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update_status') {
    
    extract($_REQUEST);
    if ($database->change_status($id,$status)) {
      echo 'Status Has Been Updated Successfully ..!';
    }else{
      echo 'Status Not Updated';
    }

  }

?>