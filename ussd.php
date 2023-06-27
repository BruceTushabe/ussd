<?php

error_reporting(0);

// Ussd sessions
$sessionId = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text = $_POST["text"];

// Connecting to the database
include('dbConnect.php');

$sqlQuery = "SELECT `id`, `name`, `phone_number`, `role`, `location` FROM `clients` WHERE `phone_number`= ?";
$stmt = mysqli_prepare($conn, $sqlQuery);
mysqli_stmt_bind_param($stmt, "s", $phoneNumber);
mysqli_stmt_execute($stmt);
$resultSet = mysqli_stmt_get_result($stmt);
$isValidLogin = mysqli_num_rows($resultSet);
$userDetails = mysqli_fetch_assoc($resultSet);
$name = $userDetails['name'];
$role = $userDetails['role'];
$location = $userDetails['location'];

if ($text == "") {
    $response = "CON Waguan Yo! Buyer or Seller? \n";
    $response .= "1. Buyer";
    $response .= "2. Seller";
}

else if($text == "1"){

    $response = "END Dear $name, Your an awesome $role, welcome back!";

} else if ($text =="2"){
    $sql ="SELECT `id`, `phone_number`, `date` FROM `clients` WHERE `phone` = ? ORDER by id DESC LIMIT 10";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt, "s", $phoneNumber);
    mysqli_stmt_execute($stmt);
    $run_query = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($run_query) >0){
        $clients = "";
        while($row=mysqli_fetch_assoc($run_query)){
            $clients .=$row['c-code'] . '||' . $row['amount'] . '||' .
            $row['date'] . ' ##';
        }
        $response = "END Your details: ". $clients;
    }
}
header('Content-type: text/plain');
echo $response;
?>


