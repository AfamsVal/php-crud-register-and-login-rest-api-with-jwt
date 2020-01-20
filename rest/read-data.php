<?php
require '../vendor/autoload.php';
use \Firebase\JWT\JWT;

//include headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=utf-8");

// including files
include_once("../config/database.php");
include_once("../classes/Users.php");

//objects
$db = new Database();

$conn = $db->connect();

$user_obj = new Users($conn);

if($_SERVER['REQUEST_METHOD'] === "POST"){

   //$data = json_decode(file_get_contents("php://input"));

   $all_headers = getallheaders();

   if(isset($all_headers["Authorization"])){
     
   $jwt = $all_headers['Authorization'];

   if(!empty($jwt)){

      try{

        $secret_key = "owt125";

        $decoded_data = JWT::decode($jwt, $secret_key, array('HS512'));

        http_response_code(200);

        $user_id = $decoded_data->data->id;

        echo json_encode(array(
          "status" => 1,
          "message" => "We got JWT Token",
          "user_data" => $decoded_data,
          "user_id" => $user_id
        ));
      }catch(Exception $ex){

        http_response_code(500); // server error
        echo json_encode(array(
          "status" => 0,
          "message" =>  $ex->getMessage()
        ));
      }

   }else{

    http_response_code(404); // not found
    echo json_encode(array(
      "status" => 0,
      "message" => "Token not set"
    ));
  }

  }else{

    http_response_code(404); // not found
    echo json_encode(array(
      "status" => 0,
      "message" => "Token not set"
    ));
  }

}
 ?>
