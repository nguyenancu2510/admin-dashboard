<?php

$sname= "";
$unmae= "";
$password = "";

$db_name = "";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Lỗi kết nối!";
}