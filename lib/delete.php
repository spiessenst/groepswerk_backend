<?php
require_once "autoload.php";

if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
    if ( CheckCSRF() ) {

        //Delete all records from album-gerne based on album_id
       ExecuteSQL( "DELETE FROM album_genre where alb_id = '". $_POST['alb_id']."'" );
        //Delete all records from track based on album_id
       ExecuteSQL( "DELETE FROM track where tr_alb_id = '". $_POST['alb_id']."'" );

        //Get artist id from album table to delete artist and save in variable $id
       $id = getData( "SELECT alb_art_id from album where alb_id = ". $_POST['alb_id'] );

        // Then delete record from album table
        ExecuteSQL( "DELETE FROM album where alb_id = ". $_POST['alb_id'] );

        // finally delete record from artist table based on $id
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



