<?php 
  include ROOT.DS.'views'.DS.'users'.DS."header.php";
  include ROOT.DS.'views'.DS.'users'.DS."header-menu.php";
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
          <button type="submit" class="btn btn-primary" id="btn-change-passwod">Change</button>
        </div><!-- end of col-md-12 -->

      </div><!-- end of row -->
    </div><!-- end of form-box-->
  </form>
</div><!-- end of container -->

<?php 
  include ROOT.DS.'views'.DS.'users'.DS."footer.php";
?>