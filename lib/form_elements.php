<?php
require_once "autoload.php";


function GenreList($data) //printed on every page above footer
{
// print the gerne buttons in ul
    $list = '<section class="genre_links"> <ul>';

    foreach ($data as $row) {

        $list .= '<a href=index.php?gr_id=' . $row["gr_id"] . '><li>' . $row["gr_name"] . '</li></a>';
    }
    $list .= '</ul> </section>';

    return $list;

}

function GenreSelect($data) //used on the add page for genre multi-select
{
        // name="genre[]" used to post multiple genre selection in $_POST(puts all the genres in genre array)
    $list = '<select name="genre[]" multiple size="5" class="form__genre" required>';

    foreach ($data as $row) {

        $list .= '<option value="' . $row["gr_id"] . '">' . $row["gr_name"] . '</option>';
    }
    $list .= '</select>';

    return $list;
}

function GenreSelectUpdate($data, $genres_album = []) // data from genre table and array with the selected genres
{
    if (!$genres_album) {
        return GenreSelect($data);
    } else {
        $list = '<select name="genre[]" multiple size="5" class="form__genre">';

        foreach ($data as $row)     {
            // set selected false
            $isSelected = false;
            foreach ($genres_album as $genre) {
                // check if genre in $date exists in $genres_album if so set true
                if ($row["gr_id"] === $genre["gr_id"] ) $isSelected = true;
        }
                if ($isSelected === false){
                    $list .= '<option value="' . $row["gr_id"] . '">' . $row["gr_name"] . '</option>';
                }else{
                    $list .= '<option value="' . $row["gr_id"] . '" selected>' . $row["gr_name"] . '</option>';
                }
        }

            $list .= '</select>';

            return $list;
        }

}

function makeTracks($data) // used
{
    //make new array
    $data_new = [];
    foreach ($data as $row){
        // seconds to H:i:s and set to new array
       $time = gmdate("H:i:s", $row['tr_time']);
       $newtime['tr_time'] = $time;

       // replace old ['tr_time'](seconds) with new ['tr_time'](H:i:s)
       $new_datarow = array_replace($row,$newtime );
       // push to new array
       array_push($data_new , $new_datarow );

    }

    $template = file_get_contents("templates/track.html");
    return MergeViewWithData($template, $data_new);
}



