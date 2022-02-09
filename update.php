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
            $sql = "select * from album 
                    inner join track t on album.alb_id = t.tr_alb_id
                    inner join artist a on album.alb_art_id = a.art_id
                    inner join album_genre ag on album.alb_id = ag.alb_id
                    inner join genre g on ag.gr_id = g.gr_id
                    where album.alb_id = " . $_GET['alb_id'];

            $data = getData($sql);

            $template = file_get_contents("templates/update.html");
            $output = MergeViewWithData($template, $data);
            print $output;

//            $extra_elements['select_genre'] = GenreSelect($data);
//            $extra_elements['csrf_token'] = GenerateCSRF();
//
//            $output_extraelements = MergeViewWithExtraElements($template, $extra_elements);
//            print $output_extraelements;
            ?>


        </section>

    </main>

<?php
$data = getData("select * from genre");
print GenreList($data)  //print the genres?>

<?php PrintFooter();




