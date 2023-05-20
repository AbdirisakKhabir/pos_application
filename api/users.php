<?php
    //convert all data into json
    include '../config/conn.php';
    // Start session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    
    
    //create User API
    function register_user($conn){

      //create DATA varibale to store the API Respnse
        $data = array();
        //make POST RESQUEST all data from DB are inside this POST Request
        extract($_POST);
        //create Query
         $encpass = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO `system_users`(`name`, `username`,`phone`, `password`) VALUES('$name', '$username','$phone', '$encpass')";
        //execute the Query
        $result = $conn->query($query);
        //after the execution, Check if the API is success or Failure
        if($result){
            $data = array("status" => true, "data" => "Successfully Registered");
        }else {
            $data = array("status" => false, "data" => $conn->error);
        }
        echo json_encode($data);
    };
    //create Update API
    function update_user($conn){

      //create DATA varibale to store the API Respnse
        $data = array();
        //make POST RESQUEST all data from DB are inside this POST Request
        extract($_POST);
        //create Query
        $query = "UPDATE system_users set `name` = '$name', `username` = '$username',`phone` = '$phone', `user_status` = '$user_status' WHERE `id` = '$id'";
        //execute the Query
        $result = $conn->query($query);
        //after the execution, Check if the API is success or Failure
        if($result){
            $data = array("status" => true, "data" => "Successfully Updated");
            
        }else {
            $data = array("status" => false, "data" => $conn->error);
        }
        echo json_encode($data);
    };

    //read All Data from DB API
    function get_users($conn){
        //we use the variables future 
        $data = array();
        $response_data = array();

        $query = " SELECT `id`, `username`, `user_status`, `phone` FROM `system_users` WHERE 1";
        $result = $conn->query($query);

        if($result){
            while($row = $result->fetch_assoc()){
                $response_data [] = $row;
            }
            $data = array("status" => true, "data" => $response_data);
            
        }else {
                $data = array("status" => false, "data" => $conn->error);
            }
            echo json_encode($data);
    };
 
    //read one User Info API
    function get_update_info($conn){
        //extract POST you able to access all the columns of DB
        extract($_POST);
        //we use the variables future 
        $data = array();

        $query = "SELECT * FROM `system_users` WHERE id = '$id'";
        $result = $conn->query($query);

        if($result){
           $row = $result->fetch_assoc();
            $data = array("status" => true, "data" => $row);
            
        }else {
                $data = array("status" => false, "data" => $conn->error);
            }
            echo json_encode($data);
    };
    //Delete User Info API
    function delete_user($conn){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
         
        //extract POST you able to access all the columns of DB
        extract($_POST);
        //we use the variables future 
        $data = array();
           // Get ID of currently logged-in user from session
           $logged_in_user_id = $_SESSION['id'];
        // Check if the user id and the Logged in user are Same
        if($logged_in_user_id == $id){
        $query = "DELETE FROM `system_users` WHERE id = '$id'";
        $result = $conn->query($query);

        if($result){
       
            $data = array("status" => true, "data" => "Successfully User Deleted");
              // Clear session data
                session_unset();
                session_destroy();
            
        }else {
                $data = array("status" => false, "data" => $conn->error);
            }
    }else {
        $data = array("status" => false, "data" => "You Have not the Right Permission to Delete this User");
    }
       
            echo json_encode($data);
    };

    //to run the API, user should make ACTION as a function
    //here we make three steps: 1.if the user passes the function, 2.make action variable that receives this function. 3. add this function to the connection ($conn).
    if(isset($_POST['action'])){
        $action = $_POST['action'];
        $action($conn);
    }else{
        echo json_encode(array("status" => false, "data" => "Action Required"));
    };

?>