<?php
require_once "autoload.php";

if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
    if ( CheckCSRF() ) {

      //$_POST = StripSpaces($_POST);
     // $_POST = ConvertSpecialChars($_POST);

      $new_artist_id = ExecuteSQL( "INSERT INTO artist (art_name) VALUES ('". $_POST['art_name']."') " );

      $new_album_id = ExecuteSQL ("INSERT INTO album (alb_name , alb_releasedate , alb_url , alb_img , alb_art_id) VALUES ('". $_POST['alb_name']."' , '".$_POST['alb_releasedate']."' , '".$_POST['alb_url']."' ,'".$_FILES['alb_img']['name']."', '".$new_artist_id."') ");


      $tracks = $_POST['tr_name'];
      $seconds = $_POST['tr_time'];


      for($i =0 ; $i < count($tracks) ; $i++){


          $second =  strtotime($seconds[$i]) - strtotime('TODAY');


          ExecuteSQL ( "INSERT INTO track (tr_name , tr_time , tr_alb_id ) VALUES ('". $tracks[$i]. "' , '".$second."' , '".$new_album_id."')");
      }

      $genres = $_POST['genre'];

      foreach ($genres as $genre){
          ExecuteSQL("INSERT INTO album_genre ( alb_id , gr_id) VALUES ('".$new_album_id."' , '".$genre."')");
      }

        $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/images/';
        $uploadfile = $uploaddir . basename($_FILES['alb_img']['name']);


        if (move_uploaded_file($_FILES['alb_img']['tmp_name'], $uploadfile)) {
            echo "File is valid, and was successfully uploaded.\n";
        } else {
            echo "Possible file upload attack!\n";
        }


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



