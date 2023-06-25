<?php

error_reporting(0);

// Connecting to the database
$servername = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'getcassava';

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Ussd Sessions

$sessionId = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text = $_POST["text"];

if ($text == ""){
    $response = "CON WELCOME TO GETCASSAVA SERVICES\n";
    $response .= "1. Are you a Cassava Seller \n";
    $response .= "2. Are you a Cassava Buyer \n";

// SELLER------------------------------------------

} else if ($text == "1") {
     
    $response = "CON What type of Cassava are you selling? \n";
    $response .= "1. Fresh Cassava \n";
    $response .= "2. Dry Cassava \n";
    $response .= "3. Packed Cassava\n";
    $response .= "4. For more information \n";

} else if ($text == "1*1") {

    $response = "CON How many Kilograms\n";
    $response .= "1. 10 \n";
    $response .= "2. 100 \n";
    $response .= "3. 1000 \n";


} else if ($text == "1*1*1" ) {
    $response = "END You have successfully uploaded your produce!";

} else if ($text == "1*1*2" ) {
        $response = "END You have successfully uploaded your produce!";

} else if ($text == "1*1*3" ) {
    $response = "END You have successfully uploaded your produce!";


} else if ($text == "1*2") { 
    $response = "CON How many Kilograms\n";
    $response .= "1. 10 \n";
    $response .= "2. 100 \n";
    $response .= "3. 1000 \n";
    
    
} else if ($text == "1*2*1" ) {
    $response = "END You have successfully uploaded your produce!";
    
} else if ($text == "1*2*2" ) {
        $response = "END You have successfully uploaded your produce!";
    
} else if ($text == "1*2*3" ) {
    $response = "END You have successfully uploaded your produce!";
    

}else if ($text == "1*3") {

    $response = "CON How many Kilograms\n";
    $response .= "1. 10 \n";
    $response .= "2. 100 \n";
    $response .= "3. 1000 \n";
    
    
} else if ($text == "1*3*1" ) {
    $response = "END You have successfully uploaded your produce!";
    
} else if ($text == "1*3*2" ) {
        $response = "END You have successfully uploaded your produce!";
    
} else if ($text == "1*3*3" ) {
    $response = "END You have successfully uploaded your produce!";

    
}else if ($text == "1*4") {

    $response = "END Request for a call back or Call us on 0702059835. THANK YOU!\n";



// BUYER --------------------------------------------- 

} else if ($text == "2") {
     
    $response = "CON What type of Cassava are you buying? \n";
    $response .= "1. Fresh Cassava \n";
    $response .= "2. Dry Cassava \n";
    $response .= "3. Packed Cassava\n";
    $response .= "4. For more information \n";

} else if ($text == "2*1") {

    $response = "CON How many Kilograms\n";
    $response .= "1. 10 \n";
    $response .= "2. 100 \n";
    $response .= "3. 1000 \n";


} else if ($text == "2*1*1" ) {
    $response = "END You have successfully submitted your request!";

} else if ($text == "2*1*2" ) {
        $response = "END You have successfully submitted your request!";

} else if ($text == "2*1*3" ) {
    $response = "END You have successfully submitted your request!";


} else if ($text == "2*2") { 
    $response = "CON How many Kilograms\n";
    $response .= "1. 10 \n";
    $response .= "2. 100 \n";
    $response .= "3. 1000 \n";
    
    
} else if ($text == "2*2*1" ) {
    $response = "END Successfully submitted!";
    
} else if ($text == "2*2*2" ) {
        $response = "END Successfully submitted !";
    
} else if ($text == "2*2*3" ) {
    $response = "END Successfully submitted!";
    

}else if ($text == "2*3") {

    $response = "CON How many Kilograms\n";
    $response .= "1. 10 \n";
    $response .= "2. 100 \n";
    $response .= "3. 1000 \n";
    
    
} else if ($text == "2*3*1" ) {
    $response = "END Successfully submitted!";
    
} else if ($text == "2*3*2" ) {
        $response = "END Congratulations, Successfully submitted!";
    
} else if ($text == "2*3*3" ) {
    $response = "END Congratulations, successfully submitted!";

    
}else if ($text == "2*4") {

    $response = "END Request for a call back or Call us on 0702059835. THANK YOU!\n";

}

header('Content-type: text/plain');
echo $response;

?>

