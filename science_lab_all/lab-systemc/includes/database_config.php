<?php
$conn = new mysqli("localhost","root","","chemistry_lab");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " .$conn->connect_error);
}
