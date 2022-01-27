<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set( 'display_errors', 1 );
require_once "lib/autoload.php";

PrintHead();
?>

    <main>

        <?php PrintTop(); ?>

        <section class="middle">
            <div class="albumgrid">
                <?php
                //get data
                if ($_GET) {
                    $sql = "select * from album inner join artist a on album.alb_art_id = a.art_id where alb_name like '%" . $_GET["search"] . "%'";
                } else {
                    $sql = "select * from album inner join artist a on album.alb_art_id = a.art_id";
                }
                //print $sql;
                $data = getData($sql);
                //get template
                $template = file_get_contents("templates/albumgrid.html");

                //merge
                $output = MergeViewWithData($template, $data);
                print $output;

                ?>
                <!----- <div class="pagenumbers"><p>1 2 3 ></p></div></div> --->
        </section>

    </main>

<?php

$data = getData("select * from genre");
print GenreList($data) ?>

<?php PrintFooter();




