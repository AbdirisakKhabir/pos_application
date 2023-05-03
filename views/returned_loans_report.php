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
                                            <h5 class="mb-2">Returned Loans Report</h5>
                                            
                                            <form id="return_loan">
                                                    <div class="row">
                                                        <div class="col-sm-2 mb-1">Customize</div>
                                                        <div class="col-sm-2 mb-1">Enter Phone</div>
                                                        <div class="col-sm-2 mb-1">Start Date</div>
                                                        <div class="col-sm-2 mb-1">End Date</div>
                                                    </div>
                                                    <div class="row">

                                                    <div class="col-sm-2 ">
                                                        <select name="type" id="type" class="form-control">
                                                            <option value="0">All</option>
                                                            <option value="custom">Custom</option>
                                                        </select>
    
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="number" name="phone" placeholder="Search by Phone" id="phone" class="form-control">
                                                    </div>
                                                    <div class="col-sm-2 ">
                                                        <input type="date" name="from" id="from" class="form-control">
                                                    </div>
                                                    <div class="col-sm-2 ">
                                                        <input type="date" name="to" id="to" class="form-control">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <button type="submit" class="btn btn-info float-right" id="addNew">Get Transactions</button>
                                                        
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive" id="printArea">
                                                <table class="table" id="returned_loans_table">
                                                    <thead>
                                                     
                                                    </thead>
                                                   <tbody>

                                                   </tbody>
                                                </table>
                                            </div>
                                            <button class="btn btn-success" id="printButton"><i class="fa fa-print"></i> Print</button>
                                            <button class="btn btn-info" id="exportButton"><i class="fa fa-file"></i> Export to Excel</button>
                                        </div>
                                    </div>
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
<!-- get user id from the session  -->
<script type='text/javascript'>
  let user_id = "<?php echo $_SESSION['id'] ?>"; //dont forget to place the PHP code block inside the quotation 
</script>
<script src="../js/returned_loans_report.js"></script>