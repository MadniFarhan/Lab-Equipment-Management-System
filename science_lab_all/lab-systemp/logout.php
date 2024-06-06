<?php
include_once "includes/sessions.php";


session_unset();
session_destroy();

header("Location: login.php");

?>

