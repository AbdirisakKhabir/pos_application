<?php
    include 'header.php';
    include 'sidebar.php';
    include '../config/conn.php';

    // Query
    $query = "SELECT * FROM system_users";
    $result = mysqli_query($conn, $query);
    $credits = $result->fetch_all(MYSQLI_ASSOC);
 

?>

<style>
    #show{
        width: 150px;
        height: 150px;
        border: solid 1px #744547;
        border-radius: 50%;
        object-fit: cover;
    }
</style>
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
                                            <h5>All Users</h5>
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                                
                                                <table class="table" id="usersTable">
                                                    <thead>
                                                       <th>Id</th>
                                                       <th>Name</th>
                                                       <th>Username</th>
                                                       <th>Phone</th>
                                                       <th>Status</th>
                                                       <th>Action</th>
                                                    </thead>
                                                   <tbody>
                                                         <?php
                                                            foreach($result as $row){
                                                                ?>
                                                                <tr>
                                                                    <td> <?php echo $row['id'] ?></td>
                                                                    <td> <?php echo $row['name'] ?></td>
                                                                    <td> <?php echo $row['username'] ?></td>
                                                                    <td> <?php echo $row['phone'] ?></td>
                                                                    <td> <?php echo $row['user_status'] ?></td>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           </div>
                           <div class="modal" tabindex="-1" id="usersModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Users Form</h5>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                </div>
                                <div class="modal-body">
                                  <form id="updateForm">
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
                                                <label for="">Phone</label>
                                                <input type="text" name="phone" id="phone" class="form-control">
                                            </div>
                                                </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">User Status</label>
                                                        <input type="text" name="user_status" id="user_status" class="form-control">
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
<script src="../js/user.js"></script>
    

<!-- Search Script -->
<script>

$(document).ready(function() {
  $('#usersTable').DataTable();
});

</script>