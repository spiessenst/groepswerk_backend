<?php
require_once "lib/autoload.php";

PrintHead();
?>

    <main>

        <?php  PrintTop() ; ?>

        <section class="middle">
            <?php
            // get data from album table based on get parameter
            $data = getData("select * from album where alb_id =" . $_GET['alb_id']);

           // get template
            $template =file_get_contents("templates/detail.html");
            //merge
            $output  = MergeViewWithData( $template , $data);

            // get data from artis based on $data[0]['alb_art_id']
            $album = getData("select * from artist where art_id =" . $data[0]['alb_art_id']);
            //merge
            $output  = MergeViewWithData( $output  , $album);

            //get all the genres for album
            $genre = getData("select * from genre
join `album_genre` `a-g` on genre.gr_id = `a-g`.gr_id
where alb_id =" . $_GET['alb_id']);


            //merge
            $output = MergeViewWithExtraElementsGenre ( $output  , $genre);

            // get all the tracks based on album  id
            $songlist = getData("select * from track
where tr_alb_id=". $_GET['alb_id']. " order by tr_id");

            //merge
           $output =  MergeSongList($output , $songlist);

            $extra_elements['csrf_token'] = GenerateCSRF();

            //merge with csfr
            $output =  MergeViewWithExtraElements( $output , $extra_elements);

            //final output
            print $output;

            ?>

        </section>

    </main>

<?php

$data = getData("select * from genre" );
print GenreList($data) ?>

<?php  PrintFooter() ;




