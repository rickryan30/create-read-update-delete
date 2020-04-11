<?php
	include ROOT.DS.'models'.DS."publicModels.php";
    /*note to dev:  this is for overwriting browser CORS ROLE*/
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
    /*end of overwriting browser CORS ROLE*/ 

    $user = new User_Model();
    $handledUser = new Handle_Name_Model();

	error_reporting( ~E_NOTICE );
	if (isset($_POST['changed_password'])) {
			
			$userID = $_POST['uID'];
      $password = $_POST['password'];
      $newPassword = $_POST['newPassword'];
      $option = ['cost' => 11];
      $password_hash = password_hash($newPassword, PASSWORD_BCRYPT, $option);
      

			$data = array(
          "id" => $userID,
          "password" => $password,
			);
			

			if ($user->user_change_password($data)) {
        
        $dataUser = [
          'password' => $password_hash,
        ];

        $dataHandledName = [
          'password' => $newPassword,
        ];

			  $whereId = array(
          "id" => $_POST['uID'],
        );

        $whereIdHandledName = array(
          "user_id" => $_POST['uID'],
        );

        $user->update($dataUser,$whereId);
        $handledUser->update($dataHandledName,$whereIdHandledName);

        echo json_encode(array(
              "success" => true
          ));
          return false;
        } 

			else {
				echo json_encode(array(
	                "success" => false
	            ));
	            return false;
			}

	}
?>
