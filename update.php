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

            $data = $data = getData("select * from genre"); // get all the genres
            $extra_elements['select_genre'] = GenreSelect($data); //make genreselector
            $extra_elements['csrf_token'] = GenerateCSRF(); //generate CSRF

            $output = MergeViewWithExtraElements($output, $extra_elements); // merge this with the template

            print $output; // print the output


            //            print $output_extraelements;
            ?>


        </section>

    </main>

<?php
$data = getData("select * from genre");
print GenreList($data)  //print the genres?>

<?php PrintFooter();



