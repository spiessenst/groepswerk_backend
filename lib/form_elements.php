<?php
require_once "autoload.php";

function MakeSelect( $fkey, $value, $sql )
{
    $select = "<select id=$fkey name=$fkey value=$value>";
    $select .= "<option value='0'></option>";

    $data = GetData($sql);

    foreach ( $data as $row )
    {
        if ( $row[0] == $value ) $selected = " selected ";
        else $selected = "";

        $select .= "<option $selected value=" . $row[0] . ">" . $row[1] . "</option>";
    }

    $select .= "</select>";

    return $select;
}

function GenreList($sql){

    $data = GetData($sql);


    $list  = '<section class="genre_links"> <ul>';

    foreach ( $data as $row )
    {
      // $list  .= '<li><a href=index.php?gr_id='.$row["gr_id"].'>'.$row["gr_name"].'</a></li>';

        $list  .= '<a href=index.php?gr_id='.$row["gr_id"].'><li>'.$row["gr_name"].'</li></a>';
    }
    $list  .= '</ul> </section>';

    return $list;


}

function MakeCheckbox( )
{

}

