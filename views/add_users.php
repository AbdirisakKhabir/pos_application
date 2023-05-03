<?php
    include 'header.php';
    include 'sidebar.php';
    include '../api/users.php';
?>                         
<!-- [ Main Content ] start -->
  <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                           <div class="row">
                                  <!-- [ basic-table ] start -->
                                  <div class="col-xl-12">
                                    <div class="card shadow-lg">
                                        <div class="card-header">
                                            <h5>Add New User</h5>
                                        </div>
                                        <div class="card-body">
                                     <form id="registerForm">
                                    <input type="hidden" name="update_info" id="update_id">
                                    <div class="row">
                                              <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" name="name" id="name" class="form-control">
                                            </div>
                                                </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Username</label>
                                                <input type="text" name="username" id="username" class="form-control">
                                            </div>
                                                </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">Password</label>
                                                        <input type="password" name="password" id="password" class="form-control">
                                                </div>
                                            </div>
                                  
                                    </div>
                                <div class="modal-footer">
                                 
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                    </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                           </div>
                          
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php
    include 'footer.php';
    
    ?>
    <script src="../js/user.js"></script>
