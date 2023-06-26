<?php

error_reporting(E_ALL); // display all errors and warnings for debugging purposes

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ussd Sessions
    $sessionId = isset($_POST["sessionId"]) ? $_POST["sessionId"] : '';
    $serviceCode = isset($_POST["serviceCode"]) ? $_POST["serviceCode"] : '';
    $phoneNumber = isset($_POST["phoneNumber"]) ? $_POST["phoneNumber"] : '';
    $text = isset($_POST["text"]) ? $_POST["text"] : '';

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

    // Define constants or variables to store the common strings
    define("WELCOME_MSG", "CON WELCOME TO GETCASSAVA SERVICES\n");
    define("ERROR_MSG", "END Invalid input. Please try again.");
    define("SELLER_OPTIONS", "CON What type of Cassava are you selling? \n1. Fresh Cassava \n2. Dry Cassava \n3. Packed Cassava\n4. For more information \n");
    define("BUYER_OPTIONS", "CON What type of Cassava are you buying? \n1. Fresh Cassava \n2. Dry Cassava \n3. Packed Cassava\n4. For more information \n");

    // Remove any whitespace from the text input
    $text = trim($text);

    // Print the text input for debugging purposes
    echo "The text input is: $text\n";

    // Use a switch statement instead of multiple if-else statements to handle different cases of user input
    switch ($text) {
        case "":
            display_menu();
            break;
        case "1":
            // Seller options
            ussd_proceed(SELLER_OPTIONS);
            break;
        case "1*1":
            // Seller - Fresh Cassava
            $response = "CON How many Kilograms\n";
            $response .= "1. 10 \n";
            $response .= "2. 100 \n";
            $response .= "3. 1000 \n";
            // Add further options or logic here
            ussd_proceed($response);
            break;
        case "1*2":
            // Seller - Dry Cassava
            // Similar logic as above
            break;
        case "1*3":
            // Seller - Packed Cassava
            // Similar logic as above
            break;
        case "1*4":
            // Seller - More Information
            $response = "END Request for a call back or Call us on 0702059835. THANK YOU!\n";
            ussd_proceed($response);
            break;
        case "2":
            // Buyer options
            ussd_proceed(BUYER_OPTIONS);
            break;
        case "2*1":
            // Buyer - Fresh Cassava
            // Similar logic as above
            break;
        case "2*2":
            // Buyer - Dry Cassava
            // Similar logic as above
            break;
        case "2*3":
            // Buyer - Packed Cassava
            // Similar logic as above
            break;
        case "2*4":
            // Buyer - More Information
            $response = "END Request for a call back or Call us on 0702059835. THANK YOU!\n";
            ussd_proceed($response);
            break;
        default:
            ussd_stop(ERROR_MSG);
    }

    header('Content-type: text/plain');
    if (isset($response)) { // check if the variable is set before echoing it
        echo $response;
    }

    // This function appends CON to the USSD response your application gives.
    // This informs Africa's Talking USSD gateway and consequently Safaricom's USSD gateway that the USSD session is still in progress.
    // Use this when you want the application USSD session to continue.
    function ussd_proceed($ussd_text) {
        echo "CON $ussd_text";
    }

    // This function appends END to the USSD response your application gives.
    // This informs Africa's Talking USSD gateway and consequently Safaricom's USSD gateway that the USSD session should end.
    // Use this when you want the application session to terminate/end.
    function ussd_stop($ussd_text) {
        echo "END $ussd_text";
    }

    // This is the home menu function.
    function display_menu() {
        ussd_proceed(WELCOME_MSG . "Please enter your full name:");
    }
} else {
    echo "Invalid request method";
}
