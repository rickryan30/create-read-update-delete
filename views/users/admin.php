<?php 
  include ROOT.DS.'views'.DS.'users'.DS."header.php";
  include ROOT.DS.'views'.DS.'users'.DS."header-menu.php";

  if($user->isloggedin() && $userID[0]->status == 'Admin'){
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];
  } else {
    $user->redirect('members');
    exit();
  }
  $userList = $user->getAll();
  // print_r($userList);
?>

<div class="container">
  <form>
    <div class="form-box">
      <div class="row">
        <div class="col-md-6"><h3>Admin</h3></div>
        <div class="col-md-6 text-right"><button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Add User</button></div>
      </div><!-- end of row -->
    <br>
      <div class="row">
       
      <div class="col-md-12">
      <table id="myTable" class="table table-bordered">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>FULLNAME</th>
                  <th>USERNAME</th>
                  <th>STATUS</th>
                  <th>ACTION</th>
              </tr>
          </thead>
          <tbody>
          <?php if(!empty($userList)) { foreach ($userList as $key => $userListing) { ?>
            <tr>
              <td><?php echo (!empty($userListing->id)) ? $userListing->id : ''; ?></td>
              <td><?php echo (!empty($userListing->fullname)) ? $userListing->fullname : ''; ?></td>
              <td><?php echo (!empty($userListing->username)) ? $userListing->username : ''; ?></td>
              <td><?php echo (!empty($userListing->status)) ? $userListing->status : ''; ?></td>
              <td>
                <button type="button" class="btn btn-info" data-tooltip="tooltip" data-placement="top" title="Edit" data-toggle="modal" data-target="#update-user<?php echo (!empty($userListing->id)) ? $userListing->id : ''; ?>"><i class="fas fa-pencil-alt"></i></button>&nbsp;
                <button type="submit" class="btn btn-danger btn-delete" id="btnDelete<?php echo (!empty($userListing->id)) ? $userListing->id : ''; ?>" value="<?php echo (!empty($userListing->id)) ? $userListing->id : ''; ?>" data-tooltip="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></button>
              </td>
            </tr>
            
            <!-- update modal -->
            <div class="modal fade" id="update-user<?php echo (!empty($userListing->id)) ? $userListing->id : ''; ?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><strong><?php echo (!empty($userListing->fullname)) ? $userListing->fullname .' Information' : ''; ?></strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label for="Fullname">Fullname</label>
                            <input type="text" class="form-control" id="fullname_<?php echo (!empty($userListing->id)) ? $userListing->id : ''; ?>" value="<?php echo (!empty($userListing->fullname)) ? $userListing->fullname : ''; ?>">
                          </div><!-- end of form group -->

                          <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" id="email_<?php echo (!empty($userListing->id)) ? $userListing->id : ''; ?>" value="<?php echo (!empty($userListing->email)) ? $userListing->email : ''; ?>">
                          </div><!-- end of form group -->
                      </div><!-- end of col-md-6 left-->

                      <div class="col-md-6">
                          <div class="form-group">
                            <label for="Username">Username</label>
                            <input type="text" class="form-control" id="username_<?php echo (!empty($userListing->id)) ? $userListing->id : ''; ?>" value="<?php echo (!empty($userListing->username)) ? $userListing->username : ''; ?>">
                          </div><!-- end of form group -->

                          <div class="form-group">
                            <label for="status">Status</label>
                              <select class="form-control" id="status_<?php echo (!empty($userListing->id)) ? $userListing->id : ''; ?>">
                                <?php if($userListing->status == 'Admin') { ?>>
                                  <option value="Member">Member</option>
                                  <option selected value="Admin">Admin</option>
                                <?php } else { ?>
                                  <option value="Admin">Admin</option>
                                  <option selected value="Member">Member</option>
                                <?php } ?>
                              </select>
                          </div>
                      </div><!-- end of col-md-6 right -->
                    
                    <!-- get user id -->
                      <div class="col-md-6">
                          <div class="form-group">
                            <input type="hidden" class="form-control" id="uID_<?php echo (!empty($userListing->id)) ? $userListing->id : ''; ?>" value="<?php echo (!empty($userListing->id)) ? $userListing->id : ''; ?>">
                          </div><!-- end of form group -->
                      </div><!-- end of col-md-6 left-->
                      <!-- end of get user id  -->

                    </div><!-- end of row -->
                  </div><!-- end of modal-body -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-listing" user-id="<?php echo (!empty($userListing->id)) ? $userListing->id : ''; ?>">Update</button>
                  </div><!-- end of modal-footer -->
                </div>
              </div>
            </div><!-- end update modal -->
            <?php } } ?>
          </tbody>
      </table>
      </div>

      </div><!-- end of row -->
    </div><!-- end of form-box -->
  </form>
</div><!-- end of container -->

<?php 
  include ROOT.DS.'views'.DS.'users'.DS."footer.php";
?>