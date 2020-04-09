<?php 
  include ROOT.DS.'views'.DS.'users'.DS."header.php";
?>

<div class="container">
  <form>
    <div class="form-box">
    <h3>Register</h3><br>
      
      <div class="row">
        <div class="col-md-6">
            <div class="form-group">
              <label for="fullname">Fullname</label>
              <input type="text" class="form-control" id="fullname">
            </div><!-- end of form group -->

            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email">
            </div><!-- end of form group -->
        </div><!-- end of col-md-6 left-->

        <div class="col-md-6">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username">
            </div><!-- end of form group -->
        </div><!-- end of col-md-6 right -->
      </div><!-- end of row -->

      <div class="row">
        <div class="col-md-6">
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password">
            </div><!-- end of form group -->
        </div><!-- end of col-md-6 left-->

        <div class="col-md-6">
          <div class="form-group">
              <label for="confirmPassword">Confirm Password</label>
              <input type="password" class="form-control" id="confirmPassword">
            </div><!-- end of form group -->
        </div><!-- end of col-md-6 right -->
      </div><!-- end of row -->

      <div class="row">
          <div class="col-md-6">
                <a href="login">LOGIN</a>
          </div><!-- end of col-md-6-->

        <div class="col-md-6 text-right">
          <button type="reset" class="btn btn-danger">Clear</button>
          <button type="submit" class="btn btn-primary" id="btn-register">Register</button>
        </div><!-- end of col-md-12 -->
      </div><!-- end of row -->

    </div><!-- end of form-box-->
  </form>
</div><!-- end of container -->

<?php 
  include ROOT.DS.'views'.DS.'users'.DS."footer.php";
?>