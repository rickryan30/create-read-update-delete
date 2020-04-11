<?php
	include ROOT.DS.'models'.DS."publicModels.php";
    /*note to dev:  this is for overwriting browser CORS ROLE*/
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With"); 
    /*end of overwriting browser CORS ROLE*/ 

    $user = new User_Model();

	error_reporting( ~E_NOTICE );
	if (isset($_POST['update_user_listing'])) {
			$userID = $_POST['uID'];
			$password = $_POST['password'];

			$where = array(
			    "id" => $userID
			);
			
			$usr = $user->getBy($where);

			
				$data = [
			        'fullname' => $_POST['fullname'],
			        'email' => $_POST['email'],
			        'username' => $_POST['username'],
			        'status' => $_POST['status'],
			        'id' => $_POST['uID']
			      ];

			      $whereId = array(
					    "id" => $_POST['uID'],
					);

			      $user->update($data,$whereId);

			      echo json_encode(array(
		                "success" => true
		            ));

	}
?>
