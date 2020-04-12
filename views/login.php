<?php 
  include ROOT.DS.'views'.DS."header.php";
  include ROOT.DS.'views'.DS."header-menu.php";
?>

<div class="container">
  <form>
    <div class="form-box">
    <h3>Login</h3><br>
      
      <div class="row">
       <div class="col-md-6">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email">
            </div><!-- end of form group -->
        </div><!-- end of col-md-6 left-->

        <div class="col-md-6">
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password">
            </div><!-- end of form group -->
        </div><!-- end of col-md-6 right -->
      </div><!-- end of row -->

      <div class="row">
        <div class="col-md-12 text-right">
          <button type="reset" class="btn btn-danger">Clear</button>
            <button type="submit" class="btn btn-primary" id="btn-login">Login</button>
          </div><!-- end of col-md-6-->
      </div><!-- end of row -->

    </div><!-- end of form-box -->
  </form>
</div><!-- end of container -->
 
<?php 
  include ROOT.DS.'views'.DS."footer.php";
?>