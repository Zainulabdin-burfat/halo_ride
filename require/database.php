<?php
  session_start();
  class Database{
    
    public $hostname    = 'localhost';
    public $username    = 'root';
    public $password    = '';
    public $database    = 'halo_ride';

    public $connection  = NULL;
    public $query       = NULL;
    public $result      = NULL;

    public function __construct()
    {
        $this->connection = mysqli_connect(
          $this->hostname,
          $this->username,
          $this->password,
          $this->database
        );
        if (mysqli_connect_errno()) {
          die("Error While Connecting to the Database");
        }
    }

    public function change_status($id, $status,$table)
    {
      $this->query = "UPDATE $table SET `status`=$status WHERE ".substr($table,0,-1)."_id=$id";
      return $this->result = mysqli_query($this->connection,$this->query);
    }

    public function login($request)
    {
      $this->query = "SELECT * FROM users WHERE `email`='".$request['email']."' AND `password`='".$request['password']."' LIMIT 1 ";
      $this->result = mysqli_query($this->connection,$this->query);
      
      if ($this->result->num_rows) {
        $_SESSION['user'] = mysqli_fetch_assoc($this->result);
        
        if ($_SESSION['user']['role_id'] == 1) {
          header("location:home.php?msg=Logged In Successfully ..!");
          exit;
        }elseif($_SESSION['user']['role_id'] == 2){
          header("location:home.php?msg=Logged In Successfully ..!");
          exit;
        }
      }else{
        header("location:index.php?msg=Invalid Email/Password");
        exit;
      }
    }

    public function getCaptains()
    {
      $this->query = "SELECT * FROM users WHERE role_id=2";
      $this->result = mysqli_query($this->connection,$this->query);

      if ($this->result->num_rows) {
        return $this->result;
      }else{
        return false;
      }
    }

    public function getRoutes()
    {
      $this->query = "SELECT F.from 'From',T.to 'To' FROM routes AS R";
      $this->result = mysqli_query($this->connection,$this->query);

      if ($this->result->num_rows) {
        return $this->result;
      }else{
        return false;
      }
    }
    
    public function getVehicles()
    {
      $this->query = "SELECT * FROM vehicles";
      $this->result = mysqli_query($this->connection,$this->query);

      if ($this->result->num_rows) {
        return $this->result;
      }else{
        return false;
      }
    }

    public function addVehicle($data,$image = null)
    {
      $FileName = null;
      $msg      = '';

      if (!is_dir('images')) {
        mkdir('images');
      }

      if (isset($image['image']['name'])) {
                  
        $FileName = "images/".$image['image']['name'];
        $TmpName  = $image['image']['tmp_name'];
        
        if (move_uploaded_file($TmpName,$FileName)) {
          $msg .= 'Image Uploaded</br>';
        }else{
          $msg .= 'Image Not Uploaded</br>';
        }
      }

      $this->query = "INSERT INTO `vehicles`(registration_number,`type`,wheels,seats,`image`,`added_on`) 
      VALUES('".$data['registration_number']."','".$data['type']."','".$data['wheels']."','".$data['seats']."','".$FileName."','".date('Y-m-d h:i:s')."') ";
      
      $this->result = mysqli_query($this->connection,$this->query);

      if ($this->result) {
        $msg .= 'Vehicle Added Successfully ..!</br>';
        return true;
      }else{
        $msg .= 'Vehicle Not Added</br>';
        return false;
      }

    }
    public function addCaptain($data,$image = null)
    {
      $FileName = null;
      $msg      = '';

      if (!is_dir('images')) {
        mkdir('images');
      }

      if (isset($image['image']['name'])) {
                  
        $FileName = "images/".$image['image']['name'];
        $TmpName  = $image['image']['tmp_name'];
        
        if (move_uploaded_file($TmpName,$FileName)) {
          $msg .= 'Image Uploaded</br>';
        }else{
          $msg .= 'Image Not Uploaded</br>';
        }
      }

      $this->query = "INSERT INTO `users`(`role_id`,`full_name`,`email`,`phone_number`,`cnic`,`password`,`image`,`added_on`) 
      VALUES('2','".$data['full_name']."','".$data['email']."','".$data['phone_number']."','".$data['cnic']."','".hash("md5",$data['password'])."','".$FileName."','".date('Y-m-d h:i:s')."') ";
      
      $this->result = mysqli_query($this->connection,$this->query);

      if ($this->result) {
        $msg .= 'Captain Added Successfully ..!</br>';
        return true;
      }else{
        $msg .= 'Captain Not Added</br>';
        return false;
      }

    }

    public function __destruct()
    {
      mysqli_close($this->connection);
    }
  }
