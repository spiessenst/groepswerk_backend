<?php
require_once "autoload.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (CheckCSRF()) {

        //$_POST = StripSpaces($_POST);
        // $_POST = ConvertSpecialChars($_POST);

        //update the artist table
        $sql = "UPDATE artist set art_name = '" . $_POST['art_name'] . "' where art_id = '" . $_POST['art_id'] . "'";
        print $sql;
        print "/n";
        ExecuteSQL($sql);

        //update the album table
        $sql = BuildSQL(true, "album", $_POST['pkey']);
        print $sql;
        ExecuteSQL($sql);


//        $tracks = $_POST['tr_name'];
//        $seconds = $_POST['tr_time'];


//      for($i =0 ; $i < count($tracks) ; $i++){
//
//
//          $second =  strtotime($seconds[$i]) - strtotime('TODAY');
//
//
//          ExecuteSQL ( "INSERT INTO track (tr_name , tr_time , tr_alb_id ) VALUES ('". $tracks[$i]. "' , '".$second."' , '".$new_album_id."')");
//      }

//      $genres = $_POST['genre'];
//
//      foreach ($genres as $genre){
////          ExecuteSQL("INSERT INTO album_genre ( alb_id , gr_id) VALUES ('".$new_album_id."' , '".$genre."')");
////      }

//        $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/images/';
//        $uploadfile = $uploaddir . basename($_FILES['alb_img']['name']);
//
//
//        if (move_uploaded_file($_FILES['alb_img']['tmp_name'], $uploadfile)) {
//            echo "File is valid, and was successfully uploaded.\n";
//        } else {
//            echo "Possible file upload attack!\n";
//        }


//        header("Location: ../" . 'index.php');
    }


}

function CheckCSRF()
{
    if (!key_exists("csrf", $_POST)) die("Missing CSRF");
    if (!hash_equals($_POST['csrf'], $_SESSION['lastest_csrf'])) die("Problem with CSRF");

    $_SESSION['lastest_csrf'] = "";

    return true;

}

function BuildSQL($update, $table, $pkey)
{
    $sql = "UPDATE $table SET ";

    //make key-value string part of SQL statement
    $keys_values = [];

    foreach ($_POST as $field => $value) {
        //skip non-data fields
        if (in_array($field, ['table', 'pkey', 'afterinsert', 'afterupdate', 'csrf', 'art_id', 'alb_id', 'art_name'])) continue;

        $where = "WHERE alb_id = '" . $_POST['pkey'] . "'";
        //handle primary key field
//        if ( $field == $pkey )
//        {
//            var_dump($field);
//            var_dump($pkey);
//            $where = " WHERE $pkey = $value ";
//            continue;
//        }

        //all other data-fields
        $keys_values[] = " $field = '$value' ";
    }

    $str_keys_values = implode(" , ", $keys_values); // img_title='berlin.jpg' , img_width='456' , ...

    //extend SQL with key-values
    $sql .= $str_keys_values;

    //extend SQL with WHERE
    $sql .= $where;

    return $sql;
}

