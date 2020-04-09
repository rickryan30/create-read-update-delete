<?php 
  session_start(); 
  include ROOT.DS.'views'.DS.'users'.DS."header.php";
  include ROOT.DS.'models'.DS."publicModels.php";

  $user = new User_Model();
 
  $where = array(
      "id" => $_SESSION['id']
  );

  $userID = $user->getBy($where);
  print_r($userID[0]->status);
  
  if($user->isloggedin() && $userID[0]->status == 'Admin'){
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];
  } else {
    $user->redirect('members');
    exit();
  }

?>

<div class="container">
  <form>
    <div class="form-box">
    <h3>Admin</h3><br>
      <div class="row">
       
        something

      </div><!-- end of row -->
    </div><!-- end of form-box -->
  </form>
</div><!-- end of container -->

<?php 
  include ROOT.DS.'views'.DS.'users'.DS."footer.php";
?>