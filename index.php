<?php
require_once "lib/autoload.php";

PrintHead();
?>

    <main>

        <?php PrintTop(); ?>

        <section class="middle">
            <div class="albumgrid">
                <?php
                //get data
                $data = getData("select * from album inner join artist a on album.alb_art_id = a.art_id");
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




