<?php

$servername = "localhost";
$database = "task_master";
$username = "admin";
$password = "dtabkm313tolik11";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}