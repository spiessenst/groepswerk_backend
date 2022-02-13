<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 1);
require_once "lib/autoload.php";

PrintHead();
?>

    <main>

        <?php PrintTop(); ?>

        <section class="middle">
            <?php
            $template = file_get_contents("templates/update.html"); //load template

            $data = getData("select * from album where album.alb_id = " . $_GET['alb_id']);  //get information from the album table
            $output = MergeViewWithData($template, $data);  //merge this information with the template

            $album = getData("select * from artist where art_id =" . $data[0]['alb_art_id']);   //get the artist information
            $output = MergeViewWithData($output, $album); // merge this with the template


            //get the genre id's for this album to us in the GenreSelect function
            $sql = "select gr_id from album_genre where alb_id =" . $_GET['alb_id'];
            $genres_album = getData($sql);

            //    get the tracks for this album
            $sql = "select * from track inner join album a on track.tr_alb_id = a.alb_id where alb_id = " . $_GET['alb_id'];
            $tracks = getData($sql);
            $extra_elements['tracks'] = makeTracks($tracks);

            // get all the genres
            $data = getData("select * from genre");
            $extra_elements['select_genre'] = GenreSelectUpdate($data, $genres_album); //make genreselector

            //generate CSRF
            $extra_elements['csrf_token'] = GenerateCSRF();

            $output = MergeViewWithExtraElements($output, $extra_elements); // merge this with the template

            print $output; // print the output

            ?>


        </section>

    </main>

<?php
$data = getData("select * from genre");
print GenreList($data)  //print the genres?>

<?php PrintFooter();




