<?php

	include __DIR__.'/db.php';

	$username = strip_tags($_POST['username']);
	$message = strip_tags($_POST['message']);
	$time = date("h:i A");
	$date = date("F d, Y");
	$ip = $_SERVER['REMOTE_ADDR'];

	if (strlen($username) > 0) {
		if (strlen($message) > 0) {
			if (strlen($message) < 500) {
				$sql = "INSERT INTO guestbook (username, message, time, date, ip) VALUES ('$username', '$message', '$time', '$date', '$ip')";
				mysqli_query($dbConn, $sql);
				header("Location: ../?post=success");
				exit();
			} else {
				header("Location: ../?post=2long");
				exit();
			}
		} else {
			header("Location: ../?post=empty");
			exit();
		}
	} else {
		header("Location: ../?post=empty");
		exit();
	}

?>