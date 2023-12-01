<?php

require "processes/db.php";
require('UserInfo.php');

$ip = "";
$device = "";
$os = "";
$browser = "";

$ip = UserInfo::get_ip();
$device = UserInfo::get_device();
$os = UserInfo::get_os();
$browser = UserInfo::get_browser();

// set the time zone to Sri Lanka
date_default_timezone_set('Asia/Colombo');

// get the current time in Sri Lanka
$dateTime = date('Y-m-d H:i:s');

$q1 = "SELECT * FROM `visitors` WHERE `ip`='" . $ip . "'";
$rs1 = $conn->query($q1);
$n1 = $rs1->num_rows;

if ($n1 >= 1) {

	$d1 = $rs1->fetch_assoc();

	$q2 = "UPDATE `visitors` SET `lastVisited_dateTime`='" . $dateTime . "',`visitedCount`='" . $d1["visitedCount"] + 1 . "' 
	WHERE `visitorId`='" . $d1["visitorId"] . "'";
	$rs2 = $conn->query($q2);

} else {

	$q3 = "INSERT INTO `visitors` (`ip`,`device`,`os`,`browser`,`firstVisited_dateTime`,`visitedCount`) 
	VALUES ('" . $ip . "','" . $device . "','" . $os . "','" . $browser . "','" . $dateTime . "','1')";
	$rs3 = $conn->query($q3);
}
