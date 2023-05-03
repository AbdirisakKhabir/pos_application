<?php
    //convert all data into json
    header("Content-type: application/json");
    //create DB connection
    include '../config/conn.php';
  
    //create Register API
    function register_action($conn){

      //create DATA varibale to store the API Response
        $data = array();
        //make POST RESQUEST all data are inside this POST Request
        extract($_POST);
        //create Query
        $query = "INSERT INTO `system_actions`(`name`, `action`, `link_id`) VALUES('$name', '$system_action', '$link_id')";
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
    
            //read All Data from DB API
    function get_actions($conn){
        //we use the variables future 
        $data = array();
        $response_data = array();

        $query = " SELECT `id`, `name`, `action`, `link_id`, `date` FROM `system_actions` WHERE 1";
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
    //Get all Links API in VIEWS directory with .php Extension
    function getAllLinks(){
        //in this function we use to create dashboard links and categories
        $data = array();
        $data_array = array();
        //read all files with this extension
        $result = glob("../views/*.php");
       forEach($result as $sr){
        $pureLink = explode("/", $sr);
        $data_array[] = $pureLink[2];

       }
       if(count($result) > 0){
        $data = array("status" => true, "data" => $data_array);
       }else{
        $data = array("status" => false, "data" => "Not Found");
       }
       echo json_encode($data);
    }
    //create Update API
    function update_action($conn){

      //create DATA varibale to store the API Respnse
        $data = array();
        //make POST RESQUEST all data from DB are inside this POST Request
        extract($_POST);
        //create Query
        $query = "UPDATE `system_actions` set `name`='$name', `action`='$system_action' ,`link_id`='$link_id' WHERE `id` = '$id' ";;
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
    
    //read one Link Info API
    function get_update_action($conn){
        //extract POST you able to access all the columns of DB
        extract($_POST);
        //we use the variables future 
        $data = array();

        $query = "SELECT * FROM `system_actions` WHERE id = '$id'";
        $result = $conn->query($query);

        if($result){
           $row = $result->fetch_assoc();
            $data = array("status" => true, "data" => $row);
            
        }else {
                $data = array("status" => false, "data" => $conn->error);
            }
            echo json_encode($data);
    };

        //read one Info API to delete
    function get_delete_action($conn){
        //extract POST you able to access all the columns of DB
        extract($_POST);
        //we use the variables future 
        $data = array();

        $query = "DELETE FROM `system_actions` WHERE id = '$id'";
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