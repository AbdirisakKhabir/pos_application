<?php
        //convert all data into json
    header("Content-type: application/json");
    // Create Connection
    include '../config/conn.php';

       //Get Returned Loans Report
    function get_returned_loans_reports($conn){

        extract($_POST);
        //we use the variables future 
        $data = array();
        $response_data = array();

        $query = "CALL get_returned_loans_report_sp('$phone','$from', '$to', '$user_id')";
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

       //create Register API
    function regsiter_returned_loan($conn){

      //create DATA varibale to store the API Respnse
        $data = array();
        //make POST RESQUEST all data are inside this POST Request
        extract($_POST);
        //create Query
        $query = "INSERT INTO `returned_loans`(`customer_name`, `amount`, `phone`, `description`, `user_id`) VALUES('$customer_name', '$amount', '$phone', '$description', '$user_id')";
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
    
    if(isset($_POST['action'])){
        $action = $_POST['action'];
        $action($conn);
    }else{
        echo json_encode(array("status" => false, "data" => "Action Required"));
    };
?>