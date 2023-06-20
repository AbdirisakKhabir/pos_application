<?php
    include 'header.php';
    include 'sidebar.php';
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
                                            <h5>Add New Customer</h5>
                                        </div>
                                        <div class="card-body">
                                <form id="registerForm">
                                        <div class="row">
                                         <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Customer Name</label>
                                                <input type="text" name="customer_name" id="customer_name" class="form-control" required>
                                                 
                                            </div>
                                                </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">City</label>
                                                <input type="text" name="city" id="city" class="form-control city" placeholder="city" required>
                                            </div>
                                                </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Phone</label>
                                                <input type="text" name="phone" id="phone" class="form-control" pattern="[0-9]{10}"
                                                title="Please enter 063XXXXXXX."
                                                placeholder="Phone" required>
                                            </div>
                                                </div>
                                </div> 
                               <div class="float-right">
                                    <button type="submit" id="customer_form" class="btn btn-primary">Submit</button>
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
        <script type='text/javascript'>
      let user_id = "<?php echo $_SESSION['id'] ?>"; //dont forget to place the PHP code block inside the quotation 
    </script>
    <script src="../js/customer.js"></script>
