<?php
require_once "lib/autoload.php";

PrintHead();
?>

    <main>

        <?php  PrintTop() ; ?>

        <section class="middle">
            <?php

            $data = getData("select * from album where alb_id =" . $_GET['alb_id']);

            $template =file_get_contents("templates/detail.html");

            $output  = MergeViewWithData( $template , $data);

            $album = getData("select * from artist where art_id =" . $data[0]['alb_art_id']);

            $output  = MergeViewWithData( $output  , $album);

            $genre = getData("select * from genre
join `album_genre` `a-g` on genre.gr_id = `a-g`.gr_id
where alb_id =" . $_GET['alb_id']);

            $output = MergeViewWithExtraElementsGenre ( $output  , $genre);

            $songlist = getData("select * from track
where tr_alb_id=". $_GET['alb_id']. " order by tr_id");

           $output =  MergeSongList($output , $songlist);

            $extra_elements['csrf_token'] = GenerateCSRF();

            $output =  MergeViewWithExtraElements( $output , $extra_elements);

            print $output;

            ?>

        </section>

    </main>

<?php

$data = getData("select * from genre" );
print GenreList($data) ?>

<?php  PrintFooter() ;




