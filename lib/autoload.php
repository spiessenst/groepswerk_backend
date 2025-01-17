<?php
session_start();

require_once "connection_data.php";
require_once "pdo.php";
require_once "html_functions.php";
require_once "form_elements.php";
require_once "sanitize.php";
require_once "validate.php";
require_once "security.php";




$old_post = [];

if ( isset($_SESSION['OLD_POST']) AND is_array( $_SESSION['OLD_POST']) )
{
    $old_post = $_SESSION['OLD_POST'];
    $_SESSION['OLD_POST'] = null;
}



$msgs = "";

if ( key_exists( 'msgs', $_SESSION ))
{
    $msgs = $_SESSION['msgs'];

    $_SESSION['msgs'] = null;

}

$errors = [];

if ( key_exists( 'errors', $_SESSION ) AND is_array( $_SESSION['errors']) )
{

    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = null;
}


