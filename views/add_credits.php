<?php
    include 'header.php';
    include 'sidebar.php';
    $user_id = $_SESSION['id'];
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
                                            <h5>Add New Credit</h5>
                                        </div>
                                        <div class="card-body">
                                <form id="add_credit">
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
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Amount</label>
                                                <input type="number" name="amount" id="amount" class="form-control amount" placeholder="Amount" required>
                                            </div>
                                                </div>
                                
                                                <div class="col-sm-6">
                                                 <div class="form-group">
                                                <label for="">Due Date</label>
                                                <input type="date" name="deadline" id="deadline" class="form-control" required>
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
                                            <textarea class="form-control" rows="5" id="description" placeholder="Description" required></textarea>
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
    <!-- get user id from the session  -->
<script type='text/javascript'>
  let user_id = "<?php echo $_SESSION['id'] ?>"; //dont forget to place the PHP code block inside the quotation 
</script>

    <script src="../js/credits.js"></script>
