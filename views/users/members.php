<?php 
  session_start(); 
  include ROOT.DS.'views'.DS.'users'.DS."header.php";
  include ROOT.DS.'models'.DS."publicModels.php";

  $user = new User_Model();

  $where = array(
      "id" => $_SESSION['id']
  );

  $userID = $user->getBy($where);
  $userStatus = $userID[0]->status;
  
  if($user->isloggedin()){
    $id = $_SESSION['id'];
    $userName = $_SESSION['username'];
  } else {
    $user->redirect('logout');
    exit();
  }
  include ROOT.DS.'views'.DS.'users'.DS."header-menu.php";
?>

<div class="container">
  <form>
    <div class="form-box">
    <h3>Members</h3><br>
      <div class="row">
       
        something

      </div><!-- end of row -->
    </div><!-- end of form-box -->
  </form>
</div><!-- end of container -->

<?php 
  include ROOT.DS.'views'.DS.'users'.DS."footer.php";
?>