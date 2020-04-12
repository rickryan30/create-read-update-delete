<?php 
    include ROOT.DS.'models'.DS."publicModels.php";
    /*note to dev:  this is for overwriting browser CORS ROLE*/
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    /*end of overwriting browser CORS ROLE*/

    date_default_timezone_set('Asia/Manila');
    $user = new User_Model();
    $handledUser = new Handle_Name_Model();

	error_reporting( ~E_NOTICE );
	if (isset($_POST['add_user'])) {

        $email = $_POST['email'];
		    $option = ['cost' => 11];
        $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT, $option);
        $created_on = date("Y-m-d H:i:s"); 
        $status = 'Member';

	    $data = [
        'fullname' => $_POST['fullname'],
        'email' => $_POST['email'],
        'username' => $_POST['username'],
        'password' => $password_hash,
        'status' => $status,
        'created_on' => $created_on
      ]; 

      $where = array(
          "email" => $_POST['email'],
      );

      $usrEml = $user->getBy($where);
      
      if ($usrEml[0]->email == $email) {
        echo json_encode(array(
                "success" => false
            ));
            return false;
            
      } else {
        $user->insert($data);
        $lstID = $user->last_id();

        $data = [
          'user_id' => $lstID,
          'password' => $_POST['password'],
        ]; 

        $handledUser->insert($data);
        echo json_encode(array(
                "success" => true,
                "last-id" => $lstID
            ));
            return false;
      }
      
	}
?>
