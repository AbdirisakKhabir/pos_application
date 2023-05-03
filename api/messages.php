<?php
include '../config/conn.php';

function processSms($to, $customer_name, $amount) {
  include '../api/credentials.php';
  // $amount_query = "SELECT amount FROM credits WHERE phone = $to";
  // $result = mysqli_query($conn, $amount_query);
  // $row = mysqli_fetch_assoc($result);
  // $my_message = "Shirkada Taam Technology Waxay ku Ogaysiinaysaa Inay Gaadhay Wakhtigii aad Deynta soo Bixin Lahayd Xaddi Lacageed oo Dhan $row";
        $message= "$customer_name" . ", Macmiil Shirkada Taam Solutions Waxay ku Ogaysiinaysaa inay Gaadhay Wakhtigii aad Deynta soo Celin lahayd, Xaddi Lacageed oo dhan $" . $amount;
        $msg = str_ireplace(" ", "%20", $message);
        $username = $username;
        $password = $password;
         $to = $to;
         $curentDate = date("d/m/Y");
         $from = "Qaansheeg";
         $key = $key;

    
   //to replace empty space to "%20"
   $message = str_ireplace(" ", "%20", $message);
   //HASHS KEY
   $hashkey = strtoupper(md5($username . "|" . $password . "|" . $to . "|" . $msg . "|" . $from . "|" . $curentDate . "|" . $key));
    
   $fields = [
        'from' => $from,
        'to' => $to,
        'msg' => $msg,
        'key' => $hashkey,
    ];
    $postdata = http_build_query($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://sms.mytelesom.com/index.php/Gway/sendsms/");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    $json = $output;
    $data = json_decode($json, true);
    // echo '<script>alert("' . $data['msg'] . '");</script>';



if ($data['status'] === 'success') {
  echo "<script>
          swal({
            title: 'Success!',
            text: 'SMS Sent successful to the Customer.',
            icon: 'success',
            button: 'OK'
          });
        </script>";
} else {
  echo "<script>
          swal({
            title: 'Error!',
            text: 'The SMS Not Sent.',
            icon: 'error',
            button: 'OK'
          });
        </script>";
}
}

// ?>

<!-- Script for Sweet Alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>