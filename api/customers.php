<?php

    //create DB connection
    include '../config/conn.php';
    //create Register API
    function register_customer($conn){

      //create DATA varibale to store the API Respnse
        $data = array();
        //make POST RESQUEST all data are inside this POST Request
        extract($_POST);
        //create Query
        $query = "INSERT INTO `customers`(`customer_name`, `city`, `phone`, `user_id`) VALUES('$customer_name', '$city', '$phone', '$user_id')";
        //execute the Query
        $result = $conn->query($query);
        //after the execution, Check if the API is success or Failure
        if($result){
            // $row = $result->fetch_assoc();
                $data = array("status" => true, "data" => "Successfully Registered");
        }else {
            $data = array("status" => false, "data" => $conn->error);
        }
        echo json_encode($data);
    };
    
    //create Update API
    function update_customer($conn){

      //create DATA varibale to store the API Respnse
        $data = array();
        //make POST RESQUEST all data from DB are inside this POST Request
        extract($_POST);
        //create Query
        $query = "UPDATE `customers` set `customer_name`='$customer_name', `city`='$city' ,`phone`='$phone' WHERE `id` = '$id'";
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
    function get_customers($conn){
        extract($_POST);
        //we use the variables future 
        $data = array();
        $response_data = array();
     
        $query = "SELECT `id`, `customer_name`, `phone`, `city` FROM `customers` WHERE `user_id` = '$user_id' ";
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
    //read Specific User Data
    function get_customer($conn){
            extract($_POST);
        //we use the variables future 
        $data = array();
        $response_data = array();
        $query = "SELECT * FROM `customers` WHERE `customer_name` = '$customer_name'";
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


    //read one Expense Info API
    function get_update_info($conn){
        //extract POST you able to access all the columns of DB
        extract($_POST);
        //we use the variables future 
        $data = array();

        $query = "SELECT * FROM `customers` WHERE id = '$id'";
        $result = $conn->query($query);

        if($result){
           $row = $result->fetch_assoc();
            $data = array("status" => true, "data" => $row);
            
        }else {
                $data = array("status" => false, "data" => $conn->error);
            }
            echo json_encode($data);
    };

        //Delete one Customer
    function delete_customer($conn){
        //extract POST you able to access all the columns of DB
        extract($_POST);
        //we use the variables future 
        $data = array();

        $query = "DELETE FROM `customers` WHERE id = '$id'";
        $result = $conn->query($query);

        if($result){
            $data = array("status" => true, "data" => "Deleted Successfully");
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