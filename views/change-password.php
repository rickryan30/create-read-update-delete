<?php 
  include ROOT.DS.'views'.DS."header.php";
  include ROOT.DS.'views'.DS."header-menu.php";
  if($user->isloggedin()){
    $id = $_SESSION['id'];
  } else {
    $user->redirect('home');
    exit();
  }
?>


<div class="container">
  <form>
    <div class="form-box">
    <h3>Change Password</h3><br>
      <div class="row">
       
        <div class="col-md-6">
          <div class="form-group">
              <label for="Password">Current Password</label>
              <input type="password" class="form-control" id="password">
            </div><!-- end of form group -->
        </div><!-- end of col-md-6 left-->

        <div class="col-md-6">
             <div class="form-group">
            <input type="hidden" class="form-control" id="uID" value="<?php echo (!empty($userID[0]->id)) ? $userID[0]->id : '' ?>">
            </div><!-- end of form group -->
        </div>
      
      </div><!-- end of row -->

      <div class="row">
       
        <div class="col-md-6">
          <div class="form-group">
              <label for="newPassword">New Password</label>
              <input type="password" class="form-control" id="newPassword">
            </div><!-- end of form group -->
        </div><!-- end of col-md-6 left-->

        <div class="col-md-6">
            <div class="form-group">
              <label for="confirmPassword">Confirm Password</label>
              <input type="password" class="form-control" id="confirmPassword">
            </div><!-- end of form group -->
        </div><!-- end of col-md-6 right -->
        
        <div class="col-md-12 text-right">
        <button type="reset" class="btn btn-danger">Clear</button>
          <button type="submit" class="btn btn-primary" id="btn-change-password">Change</button>
        </div><!-- end of col-md-12 -->

      </div><!-- end of row -->
    </div><!-- end of form-box-->
  </form>
</div><!-- end of container -->

<?php 
  include ROOT.DS.'views'.DS."footer.php";
?>