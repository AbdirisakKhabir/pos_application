<?php
    //convert all data into json
    // header("Content-type: application/json");
    //create DB connection
    include '../config/conn.php';
   //create Register API
    function register_credit($conn){

      //create DATA varibale to store the API Respnse
        $data = array();
        //make POST RESQUEST all data are inside this POST Request
        extract($_POST);
        //create Query
        $query = "CALL register_credit_sp('', '$customer_name', '$amount','$deadline','$city','$phone','$description', '$user_id')";
        //execute the Query
        $result = $conn->query($query);
        //after the execution, Check if the API is success or Failure
        if($result){
            $row = $result->fetch_assoc();

           if($row['Message'] == "Registered") {
                $data = array("status" => true, "data" => "Successfully Registered");
            }
        }else {
            $data = array("status" => false, "data" => $conn->error);
        }
        echo json_encode($data);
    };
    
   //create Update API
    function update_credit($conn){

      //create DATA varibale to store the API Respnse
        $data = array();
        //make POST RESQUEST all data from DB are inside this POST Request
        extract($_POST);
        //create Query
        $query = "CALL register_credit_sp('$id','$customer_name', '$amount','$deadline','$city','$phone','$description', '$user_id')";
        //execute the Query
        $result = $conn->query($query);
        //after the execution, Check if the API is success or Failure
        if($result){
            $row = $result->fetch_assoc();

           if($row['Message'] == "Updated") {
                $data = array("status" => true, "data" => "Successfully Updated");
            }
        }else {
            $data = array("status" => false, "data" => $conn->error);
        }
        echo json_encode($data);
    };

    //read All Data from DB API
    function get_credits($conn){
        //we use the variables future 
        $data = array();
        $response_data = array();

        $query = "SELECT `id`, `customer_name`, `amount`, `description`, `deadline`, `city`, `phone` FROM `credits` WHERE 1";
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
    //read One Credit Data from DB API
    function get_credit($conn){
        //we use the variables future 
            extract($_POST);
        $data = array();
        $response_data = array();

        $query = "SELECT `id`, `customer_name`, `amount`, `description`, `deadline`, `city`, `phone` FROM `credits` WHERE id = '$id'";
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

    
        //Delete one Credit
    function delete_credit($conn){
        //extract POST you able to access all the columns of DB
        extract($_POST);
        //we use the variables future 
        $data = array();

        $query = "DELETE FROM `credits` WHERE id = '$id'";
        $result = $conn->query($query);

        if($result){
            $data = array("status" => true, "data" => "Deleted Successfully");
        }else {
                $data = array("status" => false, "data" => $conn->error);
            }
            echo json_encode($data);
    };

       //Get user Statement Report
    function get_credit_report($conn){
     
        extract($_POST);
        //we use the variables future 
        $data = array();
        $response_data = array();

        $query = "CALL get_credit_report('$phone','$from', '$to', '$user_id')";
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
    function get_credit_phone($conn){
        //extract POST you able to access all the columns of DB
        extract($_POST);
        //we use the variables future 
        $data = array();

        $query = "SELECT lpad(phone, 10, '0') 'phone' FROM `credits` WHERE id = '$id'";
        $result = $conn->query($query);

        if($result){
           $row = $result->fetch_assoc();
            $data = array("status" => true, "data" => $row);
            
        }else {
                $data = array("status" => false, "data" => $conn->error);
            }
            echo json_encode($data);
    };
 
        //read one Expense Info API
    function approve_credit($conn){
        //extract POST you able to access all the columns of DB
        extract($_POST);
        //we use the variables future 
        $data = array();

        $query = "CALL returned_loans_sp('$id')";
        $result = $conn->query($query);

        if($result){
            $data = array("status" => true, "data" => "Successfully Approved");
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