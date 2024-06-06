<?php
ob_start();
session_start();

function errorFunction()
{
    if(isset($_SESSION["ErrorMessage"]))
    {
        $output = "<div class='alert alert-danger'>";
        $output .= $_SESSION["ErrorMessage"];
        $output .= "</div><br>";
        $_SESSION["ErrorMessage"] = null;
        return $output;
    }
}

function successFunction()
{
    if(isset($_SESSION["SuccessMessage"]))
    {
        $output = "<div class='alert alert-success'>";
        $output .= $_SESSION["SuccessMessage"];
        $output .= "</div><br>";
        $_SESSION["SuccessMessage"] = null;
        return $output;
    }
}
