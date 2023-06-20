<?php
    include 'header.php';
    include 'sidebar.php';

?>

<style>
    fieldset.authority_border{
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px #000;
        box-shadow: 0px #000;
    }
    legend.auhtority_border{
        width: inherit;
        padding: 0 10px;
        border-bottom: none;
    }
    input[type = checkbox]{
        transform : scale(1.5);
    }
    #all_authority {
        transform: scale(2);

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
                                            <h5>Select User</h5>
                                           
                                            <form id="userForm">
                                                    <div class="row">

                                                    <div class="col-sm-12 mt-2 mb-4">
                                                        <select name="user_id" id="user_id" class="form-control">
                                                            
                                                        </select>   
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-sm-12">
                                                        <fieldset class="authority_border">
                                                            
                                                            <div class="row mt-3" id="authority_area">
                                                               
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-info m-3"> Authorize User</button>

                                            </form>
                                        </div>
                                        <div class="card-block table-border-style">
                                            
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
<script src="../js/system_authority.js"></script>