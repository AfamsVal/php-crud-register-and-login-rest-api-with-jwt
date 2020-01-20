<?php

class Database{

  // variable declaration
  private $host;
  private $databasename;
  private $user;
  private $password;
  private $conn;

  public function connect(){
     //  initialization of variable
     $this->host = "localhost";
     $this->databasename = "afams_val_php_api";
     $this->user = "root";
     $this->password = "";

     $this->conn = new mysqli($this->host, $this->user,  $this->password, $this->databasename);
     if($this->conn->connect_errno){
       // this means that their was error during connection process
       print_r($this->conn->connect_error);
       exit;
     }else{
       // this means that no error was found during connection process
       return $this->conn;
     }
  }
}


 ?>
