<?php
    include 'header.php';   
    include 'sidebar.php'; 
    include '../config/conn.php';
    $user_id = $_SESSION['id'];

    // Query
    $query = "SELECT * FROM credits WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);
    $credits = $result->fetch_all(MYSQLI_ASSOC);
?>

<!-- Logic of Sending SMS from Checkboxes -->
<?php
    include '../api/messages.php';
    if(isset($_POST['submit'])){
        if(isset($_POST['id'])){
            foreach($_POST['id'] as $customer){
                $new_query = "SELECT customer_name, amount, phone FROM credits WHERE id = $customer";
                $new_res = mysqli_query($conn, $new_query);
                $new_row =   mysqli_fetch_assoc($new_res);
                processSms($new_row['phone'], $new_row['customer_name'], $new_row['amount']);
              
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
                        <td><input type="checkbox" name="id[]"  class="form-check checkItem"  value="<?php echo $row['id']; ?>" 
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

<script>
    $(document).ready(function() {
  $('#creditsTable').DataTable();
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

