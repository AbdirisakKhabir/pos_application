<?php
    include 'header.php';
    include 'sidebar.php';

?>

  <!-- [ Main Content ] start -->
  <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- [ breadcrumb ] start -->

                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                           <div class="row">
                                  <!-- [ basic-table ] start -->
                                  <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Actions Table</h5>
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                                <button class="btn btn-info float-right" id="addNew">Add New action</button>
                                                <table class="table" id="actionTable">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Action</th>
                                                            <th>Link Id</th>
                                                            <th>Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                   <tbody>

                                                   </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           </div>
                           <div class="modal" tabindex="-1" id="actionModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Register actions</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <form id="actionForm">
                                    <input type="hidden" name="update_info" id="update_id">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-success d-none" role="alert">
                                            This is a success alert—check it out!
                                            </div>
                                            <div class="alert alert-danger d-none" role="alert">
                                            This is a danger alert—check it out!
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" name="name" id="name" class="form-control">
                                            </div>
                                                </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Action</label>
                                                <input type="text" name="system_action" id="system_action" class="form-control">
                                            </div>
                                                </div>
                                               
                                           
                                            
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">Link</label>
                                                    <select name="link_id" id="link_id" class="form-control">
                                                       
                                                    </select>
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
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    include 'footer.php';

?>
<script src="../js/system_actions.js"></script>