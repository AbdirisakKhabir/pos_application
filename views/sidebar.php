<?php
// Validate if the user is logged in or not
$email = $_SESSION['username'];
if($email == false){
  header('location: login.php');

}
?>
<nav class="pcoded-navbar">
        <div class="navbar-wrapper">
            <div class="navbar-brand header-logo">
            <img src="../images/loanCloud.png" alt=" Loan">
                </a>
                <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
            </div>
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar" id="userMenu">
                <li  class="nav-item active">
                        <a href="dashboard.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="javascript:"><span></span></a>
            <a href="index.html" class="b-brand">
                   <div class="b-bg">
                       <i class="feather icon-trending-up"></i>
                   </div>
                   <img src="../assets/images/loanCloud.png" alt="">
               </a>
        </div>
        <a class="mobile-menu" id="mobile-header" href="javascript:">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li><a href="javascript:" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>
               
            
            </ul>
            <ul class="navbar-nav ml-auto">
               
                <li>
                    <div class="dropdown drp-user">
                        <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon feather icon-settings"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                               
                               
                                <span><?php echo $_SESSION['name']  ?></span>
                              
                            </div>
                            <ul class="pro-body">
                       
                                <li><a href="logout.php" class="dropdown-item"><i class="feather icon-lock"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <script type='text/javascript'>
  let user_id = "<?php echo $_SESSION['id'] ?>"; //dont forget to place the PHP code block inside the quotation 
</script>
<script src="../js/sidebar.js"></script>