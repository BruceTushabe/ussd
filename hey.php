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
		$qer = mysql_query($sql);
		while($tab = mysqli_fetch_array($qer)){
			$message .= $tab['participant_id']. ".$tab['name']." \n;
		}

		echo "$TransId=".$TransId."&RequestType= 2&MSISDN=". $MSISDN."&AppId=".$AppId."&USSDString=".$message."&TypeofMessage=0";

}











?>