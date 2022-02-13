<?php
require_once "autoload.php";

var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (CheckCSRF()) {

        //$_POST = StripSpaces($_POST);
        $_POST = ConvertSpecialChars($_POST);

        //update the artist table
        $sql = "UPDATE artist set art_name = '" . $_POST['art_name'] . "' where art_id = '" . $_POST['art_id'] . "'";
        print $sql;
        print "\n";
        ExecuteSQL($sql);

        //update the album table
        $sql = BuildSQL(true, "album", $_POST['pkey']);
        print $sql;
        ExecuteSQL($sql);

        //update the tracks table
        $tracks = $_POST['tr_name'];
        $seconds = $_POST['tr_time'];
        $tracks_ids = $_POST['tr_id'];

        for ($i = 0; $i < count($tracks); $i++) {
            $second = strtotime($seconds[$i]) - strtotime('TODAY');
            $sql = "UPDATE track set tr_name ='" . $tracks[$i] . "', tr_time = '" . $seconds[$i] . "' where tr_id = " . $tracks_ids[$i];
            ExecuteSQL($sql);
        }

        //update genres
        $genres = $_POST['genre'];  //get the new genres
        // delete old album-genre connections in album_genre
        $sql = "DELETE FROM album_genre where alb_id = '" . $_POST['pkey'] . "'";
        ExecuteSQL($sql);

        //insert new genres
        foreach ($genres as $genre) {
            if ($genre === "") {
                continue;
            }
            $sql = "INSERT INTO album_genre (alb_id, gr_id) VALUES ('" . $_POST['pkey'] . "','" . $genre . "')";
            ExecuteSQL($sql);
        }
        header("Location: ../" . 'intro.php');
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
        if (in_array($field, ['table', 'tr_name', 'tr_time', 'tr_id', 'pkey', 'afterinsert', 'afterupdate', 'csrf', 'art_id', 'alb_id', 'art_name', 'genre'])) continue;

        $where = "WHERE alb_id = '" . $_POST['pkey'] . "'";

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

