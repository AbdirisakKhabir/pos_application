<?php
    include 'header.php';   
    include 'sidebar.php'; 
    include '../config/conn.php';
    $user_id = $_SESSION['id'];
    // Dynamic Limit
     $limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 20;
    // Current Pagination Page Number
    $page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
    // Offset
	$start = ($page - 1) * $limit;
    // Query
    $query = "SELECT * FROM credits WHERE user_id = $user_id LIMIT $start, $limit";
    $result = mysqli_query($conn, $query);
    $credits = $result->fetch_all(MYSQLI_ASSOC);
 
	$result1 = $conn->query("SELECT count(id) AS id FROM credits WHERE user_id = $user_id");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['id'];
     // Calculate total pages
	$pages = ceil( $total / $limit );
	$prev = $page - 1;
	$next = $page + 1;
?>

<!-- Logic of Sending SMS from Checkboxes -->
<?php
    include '../api/messages.php';
    if(isset($_POST['submit'])){
        if(isset($_POST['phone'])){
            foreach($_POST['phone'] as $phone){
                $new_query = "SELECT customer_name, amount FROM credits WHERE phone = $phone";
                $new_res = mysqli_query($conn, $new_query);
                $new_row =   mysqli_fetch_assoc($new_res);
                processSms($phone, $new_row['customer_name'], $new_row['amount']);
              
            }
        }
    }
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
                                            <h5>Credits Data</h5>
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
                                            <form action="credits.php" method="post">
                                            <div class="table-responsive">
                                               
                                                <table class="table" id="creditsTable">
                                                    <thead>
                                                        <tr>
                                                            <td colspan="9">
                                                            <input type="submit" name="submit" value="Send SMS"  onclick="return confirm('Are you sure you want to submit this form?');" class="btn btn-primary float-right ">
                                                            </td>
                                                        </tr>
                                                       <tr>
                                                        <th><input type="checkbox" name="send_sms" id="send_sms"></th>
                                                        <th>Id</th>
                                                       <th>Customer Name</th>
                                                       <th>Amount</th>
                                                       <th>Due Date</th>
                                                       <th>City</th>
                                                       <th>Phone</th>
                                                       <th>Description</th>
                                                       <th>Action</th>
                                                       </tr>
                                                      
                                                    </thead>
                                                   <tbody>
                    <?php

                    foreach($result as $row){
                   
                       
                        ?>
                        <tr>     
                        <td><input type="checkbox" name="phone[]"  class="form-check checkItem"  value="<?php echo $row['phone']; ?>" 
                        ></td> 
                        <td> <?php echo $row['id'] ?></td>
                        <td> <?php echo $row['customer_name'] ?></td>
                        <td> <?php echo $row['amount'] ?></td>
                       
                        <?php
                             $given_date = $row['deadline'];
                             $currentDate = date('Y-m-d');
                            if ($given_date <= $currentDate) {
                            echo '<td class="badge bg-danger text-white">' . $row['deadline'] . '</td>';
                            } else {
                            echo '<td class="badge bg-success text-white">' . $row['deadline'] . '</td>';
                            }
                        ?>
                     
                        <td> <?php echo $row['city'] ?></td>
                        <td> <?php echo $row['phone'] ?></td>
                        <td> <?php echo $row['description'] ?></td>
                        <td> <?php echo "                 
                                     <a class='btn btn-secondary text-white approve' approve=${row['id']}>
                                        <i class='fas fa-check' style='color:#fff;'></i>
                                        Approve
                                        </a>
                                        <a class='btn btn-primary text-white update_info' update_id=${row['id']}>
                                        <i class='fas fa-edit' style='color:#fff;'></i>
                                        Edit
                                        </a>
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
                                        <nav aria-label="Page navigation example mt-5">
                                            <ul class="pagination justify-content-end">
                                                <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                                                    <a class="page-link"
                                                        href="<?php if($page <= 1){ echo '#'; } else { echo "?page=" . $prev; } ?>">Previous</a>
                                                </li>
                                                <?php for($i = 1; $i <= $pages; $i++ ): ?>
                                                <li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
                                                    <a class="page-link" href="credits.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                                                </li>
                                                <?php endfor; ?>
                                                <li class="page-item <?php if($page >= $pages) { echo 'disabled'; } ?>">
                                                    <a class="page-link"
                                                        href="<?php if($page >= $pages){ echo '#'; } else {echo "?page=". $next; } ?>">Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                  

                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                           </div>
                           <div class="modal" tabindex="-1" id="creditsModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update Credit Form</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                </div>
                                <div class="modal-body">
                                    <form id="update_credit">
                                           <input type="hidden" id="update_id">
                                        <div class="row">
                                         <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Customer Name</label>
                                                 <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Customer Name" readonly>
                                            </div>
                                                </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Amount</label>
                                                <input type="number" name="amount" id="amount" class="form-control" placeholder="Amount">
                                            </div>
                                                </div>
                                      
                                                <div class="col-sm-6">
                                                 <div class="form-group">
                                                <label for="">Due Date</label>
                                                <input type="date" name="deadline" id="deadline" class="form-control">
                                            </div>                                  
                                            </div>

                                                  <div class="col-sm-12">
                                             <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" id="phone" class="form-control" readonly>
                                        </div>                                  
                                    </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">City</label>
                                                   <input type="text" name="city" id="city" class="form-control" readonly>
                                                </div>
                                            </div>
                                      
                                            <div class="col-sm-12">
                                             <div class="form-group">
                                            <label>Desription</label>
                                            <textarea class="form-control" rows="5" id="description" placeholder="Description"></textarea>
                                        </div>                                  
                                    </div>
                                   
                                </div>
                               <div class="float-right">
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
<script src="../js/credits.js"></script>

<!-- Search Script -->
<script type="text/javascript">

  $(document).ready(function(){
    $("#search").keyup(function(){
        search_table($(this).val());
    })
    function search_table(value){
        $("#creditsTable tbody tr").each(function(){
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

<!-- Script for When the User Clicks the checkbox then all other checkboxes are selected -->
<script>
  $(document).ready(function(){ 
    $("#send_sms").click(function() {
        if($(this).is(":checked")){
            $(".checkItem").prop('checked', true)
        }else {
            $(".checkItem").prop('checked', false)
        }
    })
  })

</script>

