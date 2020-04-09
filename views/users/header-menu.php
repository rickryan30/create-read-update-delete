<div class="container">
    <div class="row header-menu">
        <div class="col-md-12">
            <strong><?php echo $userStatus; ?></strong>
            <div class="bt-display">
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary">Settings</button>
                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                        <!-- <a class="dropdown-item" href="members">Home</a> -->
                        <a class="dropdown-item" href="update">Profile</a>
                        <?php echo ($userStatus == 'Admin') ? '<a class="dropdown-item" href="#">Admin</a>' : ''; ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout">Logout</a>
                    </div>
                </div>
            </div>
        </div><!-- end of col-md-6  -->

        
  </div> <!-- end of row header-menu -->
</div><!-- end of container  -->


