<?php
    $conn = new mysqli("localhost", "root", "", "loancloud");

    if($conn->connect_error){
        echo $conn->error; 
    }
?>