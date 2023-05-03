<?php

session_start();
    //convert all data into json
    header("Content-type: application/json");
    //create DB connection
    include '../config/conn.php';


    //Create Login APi
    function login($conn){
        extract($_POST);
        //we use the variables future 
        $data = array();
        $response_data = array();

        $query = " CALL login_sp('$username', '$password')";
        $result = $conn->query($query);

        if($result){
          $row = $result->fetch_assoc();
          if(isset($row['Message'])){
            if($row['Message'] == 'Deny'){
                 $data = array("status" => false, "data" => "Username or Password is Incorrect");
            }else{
                 $data = array("status" => false, "data" => "User Locked by the Admin");
            };
         }else{
            //if there is no message and user is correct create session and pass data
            //each data in a $row will split key per value
            forEach($row as $key => $value){
                $_SESSION[$key] = $value;
                 $data = array("status" => true, "data" => "Success");
            }
          }   
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