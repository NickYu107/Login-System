<?php

$dbServername = "localhost"; //If not local, need to find the local name of the specific website
$dbUsername = "root";
$dbPassword = "";
$dbName = "login";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);