<?php

	$inData = getRequestInfo();
	
	$userid = $inData["userid"];
	$firstname = $inData["firstname"];
	$lastname = $inData["lastname"];
	$phonenumber = $inData["phonenumber"];
	$email = $inData["email"];
	//$datecreated = "";

	$conn = new mysqli('localhost', 'root', '8C@UnIoOwUK2k7gZl%N9Mi', 'cookiebook');
   
   if ($conn->connect_error) 
	{
		returnWithError($conn->connect_error);
	} 
	else
	{
		// Formatted sql query.
		$sql = "INSERT into contacts (userid,firstname,lastname,phonenumber,email) VALUES (" . $userid . ",'" . $firstname . "','" . $lastname . "','" . $phonenumber . "','" . $email . "')";
		// Result of insert query.
		if($result = $conn->query($sql) != TRUE)
		{
			returnWithError($conn->error);
		}
		else
		{
			echo "Successfully added contact.";
		}
		$conn->close();
	}
	
	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson($obj)
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError($err)
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson($retValue);
	}
	
?>