<?php

date_default_timezone_set('Africa/Kampala');

// set up db connection

include('dbConnect.php');
$TransId = $_GET['Transid'];
$RequestType = $_GET['RequestType'];
$MSISDN = $_GET['MSISDN'];
$SHORTCODE = $_GET['SHORTCODE'];
$AppID = $GET['AppID'];
$USSDString = $_get['USSDString'];

$menus = array();
$sql = "SELECT * FROM menu where status = 1";
$qer = $db->query($sql);
while($tab = $qer->fetch()){
  $menus[] = $tab['participant_id']. ".$tab['name']." \n;
}

$message = "Welcome to the USSD Demo App\n";
$message .= implode(', ', $menus);

switch($RequestType){
	case 1:
		$message = "Welcome to the USSD Demo App\n";
		$sql = "SELECT * FROM menu where status = 1";
		$qer = mysqli_query($sql);
		while($tab = mysqli_fetch_array($qer)){
			$message. = $tab['participant_id']. ".$tab['name']." \n;
		}

		echo "$TransId=".$TransId."&RequestType= 2&MSISDN=". $MSISDN."&AppId=".$AppId."&USSDString=".$message."&TypeofMessage=0";
		break;

		case 2:
			# check balance
			$balance = check_balance($MSISDN);

			# Check if amount is sufficient
			$sql = "select count(*) as isa from participant where participant_id =".$details[2]."and status = 1";
			$qer = mysql_query($sql);
			$tab = mysqli_fetch_array($qer);
			if ($tab['isa'] == 0){
				$message = $details[2]." is not in the list";
			}

			else {
				if(balance>0){
					change_balance ($MSISDN, -1);
					// update our db bcoz message sent
					$sql = "Update participant set point +1 where participant_id =".$details[2];
					mysql_query($sql);
					// send SMS to the user 
					$message = "You have successfully voted for ".$details[2]."Thank you";
					$sms = "Thank%20you%20for%20your%20vote%20has%20been%submitted";
				}
			}
			$message = "Your balance is $balance";

}











?>