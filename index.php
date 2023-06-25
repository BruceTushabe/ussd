<?php

error_reporting(0);

// Connecting to the database
$servername = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'ussd';

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

// Ussd Sessions

$sessionId = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text = $_POST["text"];

// Insert the session data into the database
$sql = "INSERT INTO ussd_sessions (session_id, service_code, phone_number, text) VALUES ('$sessionId', '$serviceCode', '$phoneNumber', '$text')";
if (!mysqli_query($conn, $sql)) {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


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


} else if ($text == "1*4") {
    $response = "CON Please enter your location (e.g., city):";
} else if (strpos($text, "1*4*") === 0) {
    $location = substr($text, 4);
    // Store the entered location in the database for sellers
    $query = "UPDATE sellers SET location = '$location' WHERE phoneNumber = '$phoneNumber'";
    mysqli_query($conn, $query);
    $response = "END Location submitted successfully!";


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
        $response = "END Successfully submitted!";
    
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
        $response = "END Successfully submitted!";
    
} else if ($text == "2*3*3" ) {
    $response = "END Successfully submitted!";


} else if ($text == "2*4") {
    $response = "CON Please enter your location (e.g., city):";
} else if (strpos($text, "2*4*") === 0) {
    $location = substr($text, 4);
    // Store the entered location in the database for buyers
    $query = "UPDATE buyers SET location = '$location' WHERE phoneNumber = '$phoneNumber'";
    mysqli_query($conn, $query);
    $response = "END Location submitted successfully!";


} else {
    $response = "END Invalid input. Please try again.";
}

header('Content-type: text/plain');
echo $response;
?>