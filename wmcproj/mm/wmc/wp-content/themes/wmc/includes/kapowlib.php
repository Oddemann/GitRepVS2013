<?php
	/*
	kapow sms libraries standard php v0.1
	kapow tech support
	08/03/2011	
	*/
	
	DEFINE("CNX_TIMEOUT",30);

	function send_message($username,$password,$mobile,$sms,$from_id,$url,$route,$returnid,$sendtime,$dlr,$isFlash)
	{
		/*
		send a message via http://www.kapow.co.uk/scripts/sendsms.php
		*/

		// check if sending flash message, add formatting if so
		if(isFlash)
			$sms='FLASH'.$sms;
		$posturl='http://www.kapow.co.uk/scripts/sendsms.php?username='.$username.'&password='.$password.'&mobile='.$mobile.'&sms='.urlencode($sms);
		// check if non-compulsory items are in use, add to string if so
		if($from_id!='')		
			$posturl.='&from_id='.$from_id;
		if($url!='')
			$posturl.='&url='.urlencode($url); 
		if($route!='')
			$posturl.='&route='.$route;
		if($returnid!='')
			$posturl.='&returnid='.$returnid;
		if($sendtime!='')
			$posturl.='&sendtime='.$sendtime;
		if($dlr!='')
			$posturl.='&dlr='.$dlr;
		
		// attempt to post message
		$handle=fopen($posturl,'r') or die('Unable to open URL');
		$response=stream_get_contents($handle);
		
		// return reponse
		if(strstr($response,'OK'))
			return 'Your message was sent successfully.';
		if($response=='USERPASS')
			return 'Your credentials are incorrect.';
		if($response=='ERROR')
			return 'An error has occured.';
		if($response=='NOCREDIT')
			return 'You have no credits remaining.';
		return $response;
	}

	function check_credit($username,$password)
	{
		/*		
		check remaining credit via http://www.kapow.co.uk/scripts/chk_credit.php
		*/
		$response='';
		$posturl=fopen('http://www.kapow.co.uk/scripts/chk_credit.php?username='.$username.'&password='.$password,'r') or die('Unable to open URL');
		$response=stream_get_contents($posturl);
		return $response;
	}

	function check_status($username,$returnid)
	{
		/*
		check status of message http://www.kapow.co.uk/scripts/chk_status.php?username=test&returnid=xyz
		*/
		
		$posturl='http://www.kapow.co.uk/scripts/chk_status.php?username='.$username.'&returnid='.$returnid;
		$handle=fopen($posturl,'r') or die('Unable to open stream.');
		$response=stream_get_contents($handle);
		fclose($handle);
		return $response;
	}

	function check_daystatus($username,$password,$day,$month,$year)
	{
		/*
		check status logs for a given day http://www.kapow.co.uk/scripts/chk_daystatus.php
		*/

		$posturl='http://www.kapow.co.uk/scripts/chk_daystatus.php?username='.$username.'&password='.$password;
		// is user checking a specific date? if so, add to string
		if($day!=''&&$month!=''&&$year!='')
			$posturl.='&day='.$day.'&month='.$month.'&year='.$year;
		
		// post request
		$handle=fopen($posturl,'r') or die('Unable to open stream.');
		$response=stream_get_contents($handle);
		fclose($handle);
		return $response;
	}
?>
