<?php
    include 'header.php';
    include 'sidebar.php';
    include '../config/conn.php';

    // Query
    $query = "SELECT * FROM links";
    $result = mysqli_query($conn, $query);
    $credits = $result->fetch_all(MYSQLI_ASSOC);


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
                                            <h5>Links Table</h5>
                                          
                                        </div>   
                                          <div class="row mx-2 mt-3">
                                                
                                            <div class="col-sm-12">
                                                 <button class="btn btn-info float-right" id="addNew">Add New Link</button>
                                            </div>
                                             
                                            </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                                
                                               
                                                <table class="table" id="linkTable">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Link</th>
                                                            <th>Category Id</th>
                                                            <th>Icon Name</th>
                                                            <th>Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                         <?php
                                                            foreach($result as $row){
                                                                ?>
                                                                <tr>
                                                                    <td> <?php echo $row['id'] ?></td>
                                                                    <td> <?php echo $row['name'] ?></td>
                                                                    <td> <?php echo $row['link'] ?></td>
                                                                    <td> <?php echo $row['category_id'] ?></td>
                                                                    <td> <?php echo $row['icon'] ?></td>
                                                                    <td> <?php echo $row['date'] ?></td>
                                                                    <td> <?php echo "
                                                                   <a class='btn btn-info text-white update_info' update_id=${row['id']}>
                                                                    <i class='fas fa-edit' style='color:#fff;'></i>
                                                                     Edit
                                                                    <a class='btn btn-danger text-white delete_info' delete_id=${row['id']}>
                                                                     <i class='fas fa-trash' style='color:#fff;'></i>
                                                                     Delete</a>
                                                                            ";
                                                                        ?>
  
                                                                </td>
                                                                </tr>
                                                                
                                                                <?php
                                                                    
                                                            }
                                                        ?>
                                                   </tbody>
                                                </table>
                                                         <!-- Pagination -->
                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           </div>
                           <div class="modal" tabindex="-1" id="linkModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Register Links</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                </div>
                                <div class="modal-body">
                                  <form id="linkForm">
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
                                                    <label for="">Link</label>
                                                    <select name="link_id" id="link_id" class="form-control">
                                                       
                                                    </select>
                                                </div>
                                            </div>  
                                             <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">Category</label>
                                                    <select name="category_id" id="category_id" class="form-control">
                                                       
                                                    </select>
                                                </div>
                                                    
                                </div>
                                <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Icon</label>
                                                <input type="text" name="icon" id="icon" class="form-control">
                                            </div>
                                                </div>
                                  </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
<script src="../js/system_links.js"></script>
<script>

$(document).ready(function() {
  $('#linkTable').DataTable();
});

</script>
<!-- Search Script -->
