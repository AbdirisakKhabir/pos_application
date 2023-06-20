<?php
    include 'header.php';
    include 'sidebar.php';
    include '../config/conn.php';

    // get the user ID from the Session
    $user_id = $_SESSION['id'];
    // Query
    $query = "SELECT * FROM returned_loans WHERE user_id = $user_id";
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
                                    <div class="card shadow-lg">
                                        <div class="card-header">
                                            <h5>Returned Loans</h5>
                                            
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="row">
                                               
                                    
                                              <div class="col-sm-12">
                                                 <button type='submit' class="btn btn-primary float-right mb-2" id='add_new'>Add Returned Loan</button>
                                                </div>
                                            </div>
                                                
                                            <div class="table-responsive">
                                              
                                                <table class="table" id="returnedLoansTable">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Customer Name</th>
                                                            <th>Amount</th>
                                                            <th>Phone</th>
                                                            <th>Description</th>
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
                                                                    <td> <?php echo $row['customer_name'] ?></td>
                                                                    <td> <?php echo $row['amount'] ?></td>
                                                                    <td> <?php echo $row['phone'] ?></td>
                                                                    <td> <?php echo $row['description'] ?></td>
                                                                    <td> <?php echo $row['date'] ?></td>
                                                                    <td> <?php echo "
                                                                            <a class='btn btn-danger text-white delete' delete_id='{$row['id']}'><i class='fas fa-trash' style='color:#fff;'></i>Delete</a> 
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

                                            <!-- Returned Loans Modal -->
                                            
                         <div class="modal" tabindex="-1" id="returned_loans_modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Returned Loan Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                </div>
                                <div class="modal-body">
                                    <form id="add_returned_loan">
                                        <div class="row">
                                         <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Customer Name</label>
                                                  <select name="customer_name" id="customer_name" class="form-control 
                                                customer_name
                                                ">
                                                      <option value="0">Select Customer</option>
                                                </select>
                                            </div>
                                                </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Amount</label>
                                                <input type="number" name="amount" id="amount" class="form-control" placeholder="Amount">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    include 'footer.php';

?>
<script type='text/javascript'>
  let user_id = "<?php echo $_SESSION['id'] ?>"; //dont forget to place the PHP code block inside the quotation 
</script>
<script src="../js/returned_loans.js"></script>
<script src="../js/credits.js"></script>

<!-- Search Script -->
<script>

$(document).ready(function() {
  $('#returnedLoansTable').DataTable();
});

</script>