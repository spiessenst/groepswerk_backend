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

    $list = '<select name="genre[]" multiple size="5" class="form__genre">';

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

        foreach ($genres_album as $genre) {
            foreach ($data as $row) {
                if ($row['gr_id'] === $genre['gr_id']) {
                    $list .= '<option value="' . $row["gr_id"] . '" selected>' . $row["gr_name"] . '</option>';
                } else {
                    $list .= '<option value="' . $row["gr_id"] . '">' . $row["gr_name"] . '</option>';
                }
            }
            $list .= '</select>';

            return $list;
        }
    }
}




