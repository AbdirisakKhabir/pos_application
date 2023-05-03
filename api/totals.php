<?php
       header("Content-type: application/json");
    //create DB connection
    include '../config/conn.php';
    //get total income to dispay the dashbaord
    function get_total_return_credits($conn){

        extract($_POST);
        //we use the variables future 
        $data = array();
        $response_data = array();

        $query = "SELECT SUM(`amount`) total FROM `returned_loans` WHERE user_id = $user_id";
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

    //get toal credits
       //get total income to dispay the dashbaord
    function get_total_credits($conn){

        extract($_POST);
        //we use the variables future 
        $data = array();
        $response_data = array();

        $query = "SELECT SUM(`amount`) total FROM `credits` WHERE user_id = $user_id";
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
       //get total expense to dispay the dashbaord
    function get_number_customers($conn){

        extract($_POST);
        //we use the variables future 
        $data = array();
        $response_data = array();
//         $query = "select * from customers";
// $result = $conn->query($query);
// $num_rows = mysqli_num_rows($result);

// echo "Number of rows: " . $num_rows;
        $query = "SELECT COUNT(`id`) total FROM customers WHERE user_id = $user_id";
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