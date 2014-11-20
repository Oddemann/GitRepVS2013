<?php 
// This file demonstrates how to handle different member events and access the data passed to the script by MemberMouse.

// ---- GET EVENT TYPE ----
if(!isset($_GET["event_type"])) 
{
	// event type was not found, so exit
	exit;
}
else 
{
	$eventType = $_GET["event_type"];
}


// ---- EVENT TYPES ----
$MEMBER_ADD = "mm_member_add";
$MEMBER_STATUS_CHANGE = "mm_member_status_change";
$MEMBER_MEMBERSHIP_CHANGE = "mm_member_membership_change";
$MEMBER_ACCOUNT_UPDATE = "mm_member_account_update";
$MEMBER_DELETE = "mm_member_delete";


// ---- ACCESS DATA ----
// member data
$memberId = $_GET["member_id"];
$registeredDate = $_GET["registered"];
$lastLoginDate = $_GET["last_logged_in"];
$lastUpdatedDate = $_GET["last_updated"];
$daysAsMember = $_GET["days_as_member"];
$status = $_GET["status"];
$statusName = $_GET["status_name"];
$membershipLevelId = $_GET["membership_level"];
$membershipLevelName = $_GET["membership_level_name"];
$isComplimentary = $_GET["is_complimentary"];
$username = $_GET["username"];
$email = $_GET["email"];
$phone = $_GET["phone"];
$firstName = $_GET["first_name"];
$lastName = $_GET["last_name"];
$expirationDate = $_GET["expiration_date"];
$cancellationDate = $_GET["cancellation_date"];
$billingAddress = $_GET["billing_address"];
$billingCity = $_GET["billing_city"];
$billingState = $_GET["billing_state"];
$billingZipCode = $_GET["billing_zip_code"];
$billingCountry = $_GET["billing_country"];
$shippingAddress = $_GET["shipping_address"];
$shippingCity = $_GET["shipping_city"];
$shippingState = $_GET["shipping_state"];
$shippingZipCode = $_GET["shipping_zip_code"];
$shippingCountry = $_GET["shipping_country"];

// custom field data 
// You can access custom field data by accessing the get parameter cf_# where # is the
// ID of the custom field

//$exampleCustomData = $_GET["cf_1"];

if($eventType == $MEMBER_ACCOUNT_UPDATE)
{
	// When an account update event is triggered, the previous values can be access by prefixing 'last_' to 
	// the value parameter names. For example, to check if the first name was changed and access the previous value 
	// you would check $_GET["last_first_name"] and to check if the email address was changed you would check $_GET["last_email"]
	//
	// $exampleLastEmail = isset($_GET["last_email"]) ? $_GET["last_email"] : "";
}

$mm_ods_member_melding='';

// ---- PERFORM ACTION BASED ON EVENT TYPE ----
switch($eventType)
{
	case $MEMBER_ADD:
		$mm_ods_member_melding='Lagt til i WMC';
		break;
		
	case $MEMBER_ACCOUNT_UPDATE:
        // Endre denne etter behov ODS endre sms-melding
		$mm_ods_member_melding= 'WMC konto oppdatert';
		break;
		
	case $MEMBER_MEMBERSHIP_CHANGE:
		$mm_ods_member_melding= 'WMC medlemskap endret';
		break;
		
	case $MEMBER_STATUS_CHANGE:
		$mm_ods_member_melding= 'WMC medlemskapstatus endret'; 
		break;
		
	case $MEMBER_DELETE:
		$mm_ods_member_melding= 'WMC medlemskap slettet'; 
		break;
}
if ($mm_ods_member_melding != '')
    $fraSendMess= send_message('truls','wmctf35',$phone,$mm_ods_member_melding,'','','','','','');
$mm_ods_member_melding = '';
?>