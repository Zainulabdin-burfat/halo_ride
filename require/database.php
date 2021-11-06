<?php

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
          echo "Error While Connecting to the Database";
        }
    }

    public function getCaptains(){
      $this->query = "SELECT * FROM users WHERE role_id=2";

      $this->result = mysqli_query($this->connection,$this->query);

      if ($this->result->num_rows) {
        return $this->result;
      }else{
        return false;
      }
    }

    public function addCaptain($data,$image = null){

      $FileName = null;
      $msg      = '';

      if (!is_dir('images')) {
        mkdir('images');
      }

      if (isset($image['image']['name'])) {
                  
        $FileName = "images/".$image['image']['name'];
        $TmpName = $image['image']['tmp_name'];
        
        if (move_uploaded_file($TmpName,$FileName)) {
          $msg .= 'Image Uploaded</br>';
        }else{
          $msg .= 'Image Not Uploaded</br>';
        }
      }

      $this->query = "INSERT INTO `users`(`role_id`,`full_name`,`email`,`phone_number`,`cnic`,`password`,`image`,`added_on`) VALUES('2','".$data['full_name']."','".$data['email']."','".$data['phone_number']."','".$data['cnic']."','".$data['password']."','".$FileName."','".date('Y-m-d h:i:s')."') ";
      
      $this->result = mysqli_query($this->connection,$this->query);

      if ($this->result) {
        $msg .= 'Captain Added Successfully ..!</br>';
        return true;
      }else{
        $msg .= 'Captain Not Added</br>';
        return false;
      }

    }
  }
