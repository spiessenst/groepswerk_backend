<?php
require_once "autoload.php";

if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
    if ( CheckCSRF() ) {

       ExecuteSQL( "DELETE FROM album_genre where alb_id = '". $_POST['alb_id']."'" );
       ExecuteSQL( "DELETE FROM track where tr_alb_id = '". $_POST['alb_id']."'" );

       $id = getData( "SELECT alb_art_id from album where alb_id = ". $_POST['alb_id'] );


        ExecuteSQL( "DELETE FROM album where alb_id = ". $_POST['alb_id'] );


        ExecuteSQL( "DELETE FROM artist where art_id = ". $id[0]['alb_art_id']);
        header("Location: ../" . 'index.php');
    }



}

function CheckCSRF()
{
    if ( ! key_exists("csrf", $_POST)) die("Missing CSRF");
    if ( ! hash_equals( $_POST['csrf'], $_SESSION['lastest_csrf'] ) ) die("Problem with CSRF");

    $_SESSION['lastest_csrf'] = "";

    return true;

}



