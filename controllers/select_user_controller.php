<?php
session_start();
include ROOT.DS.'models'.DS."publicModels.php";
/*note to dev:  this is for overwriting browser CORS ROLE*/
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
/*end of overwriting browser CORS ROLE*/
 
// $db = new squeedPDO(DB);  
$user = new User_Model(); 

if(isset($_POST['login_user'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = [
        'email' => $_POST['email'],
        'password' => $_POST['password']
      ];

    if($user->user_login($data)){ 
        echo json_encode(array( 
            "success" => true
        ));
        return false;
    } else {
        echo json_encode(array(
            "success" => false
        ));
        return false;
    }
}

    // echo json_encode($db);

?> 