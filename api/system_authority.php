<?php
    //convert all data into json
    header("Content-type: application/json");
    //create DB connection
    include '../config/conn.php';
    session_start();

    //create function that Returns all the System Authorities from DB
    function get_authorities($conn){
        //we use the variables future 
        $data = array();
        $response_data = array();
        extract($_POST);
        $query = " SELECT * FROM `system_authority`";
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

      //create function that Returns Every users Permission
    function get_user_authorities($conn){
        extract($_POST);

        //we use the variables future 
        $data = array();
        $response_data = array();

        $query = "CALL get_user_authority_sp('$user_id')";
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
        //create User API
    function authorize_user($conn){
     //make POST RESQUEST all data from DB are inside this POST Request
        extract($_POST);
      //create DATA varibale to store the API Respnse
        $data = array();
        $success_array = array();
        $error_array = array();
      
        //create delete query that runs if the user have authroties and deletes them
        $del = "DELETE FROM user_authority where user_id= '$user_id'";
        //create new connection
       $conn = new mysqli("localhost", "root", "", "loancloud");
       $res = $conn->query($del);

       //check if the query is success or not
       if($res){
        for($i = 0; $i<count($link_id); $i++){
            $query="INSERT INTO `user_authority`(`user_id`, `link`) VALUES ('$user_id', '$link_id[$i]')";
            $result = $conn->query($query);
            if($result){
                $success_array [] = array("status" => true, "data" => "User Has Successfully Authorized");
            }else{
                $error_array [] = array("status" => false, "data" => $conn->error);
            }
        }
       }else{
         $error_array [] = array("status" => false, "data" => $conn->error);
       }
       if(count($success_array) > 0 && count($error_array) == 0){
        $data = array("status" => true, "data" => $success_array);
       }elseif (count($success_array) > 0) {
       $data = array("status" => false, "data" => $error_array);
       }
       if(count($error_array) >0 && count($success_array) == 0){
        $data = array("status" => false, "data" => $error_array);
       }
        
        echo json_encode($data);
    };

          //create function that Returns Every users menus to show user Dashboard
    function get_user_menus($conn){
        extract($_POST);
        
        //we use the variables future 
        $data = array();
        $response_data = array();
        // $user_id = $_SESSION['id'];
        // echo $user_id;
        $query = "CALL get_user_menus_sp('$user_id')";
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

     //to run the API, user should make ACTION as a function
    //here we make three steps: 1.if the user passes the function, 2.make action variable that receives this function. 3. add this function to the connection ($conn).
    if(isset($_POST['action'])){
        $action = $_POST['action'];
        $action($conn);
    }else{
        echo json_encode(array("status" => false, "data" => "Action Required"));
    };

?>