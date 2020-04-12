<?php 
  session_start(); 
  include ROOT.DS.'models'.DS."publicModels.php";

  $user = new User_Model();
  
  if($user->isloggedin()){
    $where = array(
        "id" => $_SESSION['id']
    );

    $userID = $user->getBy($where);
    $userStatus = $userID[0]->status;
  } 
?>

<div class="container">
    <div class="row header-menu">
        <div class="col-md-12">
            <strong><?php echo ($user->isloggedin()) ? $userID[0]->username : ''; ?></strong>
            <div class="bt-display">
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary">Settings</button>
                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                        <a class="dropdown-item" href="home">Home</a>
                        <?php echo ($user->isloggedin()) ? '<a class="dropdown-item" href="update">Profile</a>' : '<a class="dropdown-item" href="login">Login</a>' ; ?>
                        <?php echo ($user->isloggedin()) ? '<a class="dropdown-item" href="change-password">Change-Password</a>' : '<a class="dropdown-item" href="register">Register</a>' ; ?>
                        <?php echo ($user->isloggedin() && $userStatus == 'Admin') ? '<a class="dropdown-item" href="admin">Admin</a>' : ''; ?>
                        
                        <?php echo ($user->isloggedin()) ? '<div class="dropdown-divider"></div><a class="dropdown-item" href="logout">Logout</a>' : ''; ?>
                    </div>
                </div>
            </div>
        </div><!-- end of col-md-6  -->

        
  </div> <!-- end of row header-menu -->
</div><!-- end of container  -->


