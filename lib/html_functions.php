<?php
function PrintHead()
{
    $head = file_get_contents("templates/head.html");
    print $head;
}

function PrintFooter()
{
    $footer = file_get_contents("templates/footer.html");
    print $footer;
}

function PrintTop()
{
    $top = file_get_contents("templates/top.html");
    print $top;
}

function PrintMiddle(){
    $middle = file_get_contents("templates/albumgrid.html");
    print $middle;
}

function PrintIntro()
{
    $intro = file_get_contents("templates/intro.html");
    print $intro;
}

function MergeViewWithData( $template, $data )
{
    $returnvalue = "";

    foreach ( $data as $row )
    {
        $output = $template;

        foreach( array_keys($row) as $field )  //eerst "img_id", dan "img_title", ...

        {

            $output = str_replace( "@$field@", $row["$field"], $output );
        }

        $returnvalue .= $output;
    }

    return $returnvalue;
}

function MergeViewWithExtraElements( $template, $elements )
{

    foreach ( $elements as $key => $element )
    {

        $template = str_replace( "@$key@", $element, $template );
    }
    return $template;
}


function MergeViewWithExtraElementsGenre( $template, $elements )
{
    $genre = "";
    foreach ($elements as  $element ){
        $genre .= $element['gr_name'] . ", ";
    }
    $genre = substr($genre, 0, -2);
    $template = str_replace( "@gr_name@", $genre, $template );
    return $template;
}

function MergeSongList( $template , $data){

   // print("<pre>".print_r($data,true)."</pre>");

$counter = 1;
    $songlist = "<table>";

    foreach ($data as $row){
        $songlist .= "<tr>";
        $songlist .=  "<td>" . $counter . "</td>";
        $songlist .=  "<td>" . $row['tr_name']. "</td>";
        $songlist .=  "<td>" . gmdate("H:i:s", $row['tr_time']). "</td>";
        $songlist .=  "</tr>";
        $counter++;

    }
    $songlist .=  "</table>";
    $template = str_replace( "@songlisttable@", $songlist, $template );
return $template;
}


function MergeViewWithErrors( $template, $errors )
{
    foreach ( $errors as $key => $error )
    {
        $template = str_replace( "@$key@", "<p style='color:red'>$error</p>", $template );
    }
    return $template;
}

function RemoveEmptyErrorTags( $template, $data )
{
    foreach ( $data as $row )
    {
        foreach( array_keys($row) as $field )  //eerst "img_id", dan "img_title", ...
        {
            $template = str_replace( "@$field" . "_error@", "", $template );
        }
    }

    return $template;
}