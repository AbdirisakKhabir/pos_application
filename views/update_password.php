<?php 
require_once "../api/controllerUserData.php"; 
$email = $_SESSION['username'];
if($email == false){
  header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reset password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
 

    <!-- Favicon icon -->
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="../assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="../assets/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="auth-bg">
                <span class="r"></span>
                <span class="r s"></span>
                <span class="r s"></span>
                <span class="r"></span>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="feather icon-mail auth-icon"></i>
                    </div>
                    <h3>Verify Code</h3>
                     <p class="text-center">Enter Code from your Email</p>
                     <form action="update_password.php" method="POST"  >
                        <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
        
                        <div class="input-group mb-3">
                       
                            <input class="form-control" type="password" name="password" placeholder="Enter New Password" required>
                           
                    </div>
                        <div class="input-group mb-3">
                       
                            <input class="form-control" type="password" name="cpassword" placeholder="Confirm your password" required>
                           
                    </div>
                  <input class="form-control button btn btn-info" type="submit" name="change-password" value="Change Password">
                    <p class="mb-0 text-muted">Login Now <a href="login.php">Login</a></p>
                     </form>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

</body>
</html>

                <span class="r s"></span>
                <span class="r s"></span>
                <span class="r"></span>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="feather icon-mail auth-icon"></i>
                    </div>
                    <h3>Update Password</h3>
                     <p class="text-center">Enter New Password</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="New Password">
                       
                    </div>
                    <button class="btn btn-primary mb-4 shadow-2">Update Password</button>
                    <p class="mb-0 text-muted">Login Now <a href="login.php">Login</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
<script src="../assets/js/vendor-all.min.js"></script>
	<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/pcoded.min.js"></script>

</body>
</html>
