<?php
    include 'header.php';
    include 'sidebar.php';
    include '../config/conn.php';
    $user_id = $_SESSION['id'];

    // Dynamic Limit
     $limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 10;
    // Current Pagination Page Number
    $page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
    // Offset
	$start = ($page - 1) * $limit;
    // Query
    $query = "SELECT * FROM customers WHERE user_id = '$user_id'  LIMIT $start, $limit";
    $result = mysqli_query($conn, $query);
    $credits = $result->fetch_all(MYSQLI_ASSOC);
 
	$result1 = $conn->query("SELECT count(id) AS id FROM customers  WHERE user_id = $user_id");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['id'];
     // Calculate total pages
	$pages = ceil( $total / $limit );
	$prev = $page - 1;
	$next = $page + 1;
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
                                            <h5>Customers Data</h5>
                                        </div>
                                        
                                         
                                         <!-- Search Component -->
                                          <div class="card-block table-border-style">
                                        <form id="search_form">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                <input type="text" name="search" id="search" class="form-control mb-2" placeholder="Search Here">
                                            </div>
                                            </div>
                                        </form>
                                            
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                               
                                                <table class="table" id="customersTable">
                                                    <thead>
                                                       <th>Id</th>
                                                       <th>Customer Name</th>
                                                       <th>City</th>
                                                       <th>Phone</th>
                                                       <th>Action</th>
                                                    </thead>
                                                   <tbody>
                                                         <?php
                                                            foreach($result as $row){
                                                                ?>
                                                                <tr>
                                                                    <td> <?php echo $row['id'] ?></td>
                                                                    <td> <?php echo $row['customer_name'] ?></td>
                                                                    <td> <?php echo $row['city'] ?></td>
                                                                    <td> <?php echo $row['phone'] ?></td>
                                                                    <td> <?php echo "
                                                                   <a class='btn btn-info text-white update_info' update_id=${row['id']}>
                                                                   <i class='fas fa-edit' style='color:#fff;'></i>
                                                                   Edit
                                                                    <a class='btn btn-danger text-white delete_info' delete_id=${row['id']}> <i class='fas fa-trash' style='color:#fff;'></i>
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


                                             <!-- Pagination -->
                                        <nav aria-label="Page navigation example mt-5">
                                            <ul class="pagination justify-content-end">
                                                <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                                                    <a class="page-link"
                                                        href="<?php if($page <= 1){ echo '#'; } else { echo "?page=" . $prev; } ?>">Previous</a>
                                                </li>
                                                <?php for($i = 1; $i <= $pages; $i++ ): ?>
                                                <li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
                                                    <a class="page-link" href="customers.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                                                </li>
                                                <?php endfor; ?>
                                                <li class="page-item <?php if($page >= $pages) { echo 'disabled'; } ?>">
                                                    <a class="page-link"
                                                        href="<?php if($page >= $pages){ echo '#'; } else {echo "?page=". $next; } ?>">Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                        <!-- Pagination Closed -->


                                        </div>
                                    </div>
                                </div>
                           </div>
                           <div class="modal" tabindex="-1" id="customersModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update Customers Form</h5>
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
                                                <label for="">Customer Name</label>
                                                <input type="text" name="customer_name" id="customer_name" class="form-control">
                                            </div>
                                                </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">City</label>
                                                        <input type="text" name="city" id="city" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">Phone</label>
                                                        <input type="text" name="phone" id="phone" class="form-control">
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
<script src="../js/customer.js"></script>
<!-- get user id from the session  -->


<!-- Search Script -->
<script type="text/javascript">

  $(document).ready(function(){
    $("#search").keyup(function(){
        search_table($(this).val());
    })
    function search_table(value){
        $("#customersTable tbody tr").each(function(){
            var found = "false";
            $(this).each(function(){
                if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)
                {
                    found = 'true';
                }
            });
            if(found == 'true') {
                $(this).show();
            } else {
                $(this).hide();
            }
        })
    }
  });


</script>