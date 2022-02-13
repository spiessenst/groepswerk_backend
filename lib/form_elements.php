<?php
require_once "autoload.php";


function GenreList($data)
{

    $list = '<section class="genre_links"> <ul>';

    foreach ($data as $row) {
        // $list  .= '<li><a href=index.php?gr_id='.$row["gr_id"].'>'.$row["gr_name"].'</a></li>';

        $list .= '<a href=index.php?gr_id=' . $row["gr_id"] . '><li>' . $row["gr_name"] . '</li></a>';
    }
    $list .= '</ul> </section>';

    return $list;


}

function GenreSelect($data)
{

    $list = '<select name="genre[]" multiple size="5" class="form__genre" required>';


    foreach ($data as $row) {

        $list .= '<option value="' . $row["gr_id"] . '">' . $row["gr_name"] . '</option>';
    }
    $list .= '</select>';

    return $list;
}

function GenreSelectUpdate($data, $genres_album = [])
{
    if (!$genres_album) {
        return GenreSelect($data);
    } else {
        $list = '<select name="genre[]" multiple size="5" class="form__genre">';


        foreach ($data as $row)     {
            $isSelected = false;
            foreach ($genres_album as $genre) {
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

function makeTracks($data)
{
    $data_new = [];
    foreach ($data as $row){

       $time = gmdate("H:i:s", $row['tr_time']);
       $newtime['tr_time'] = $time;

       $new_datarow = array_replace($row,$newtime );
       array_push($data_new , $new_datarow );

    }

    $template = file_get_contents("templates/track.html");
    return MergeViewWithData($template, $data_new);
}



