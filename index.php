<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 1);
require_once "lib/autoload.php";

PrintHead();
?>

    <main>

        <?php PrintTop(); ?>

        <section class="middle">
            <div class="albumgrid">
                <?php

                // check if the searchbar has been used or the genres have been clicked
                if ($_GET) {
                    if ($_GET["search"]) {   // if it was the search bar
                        $sql = "select * from album 
                            inner join artist a on album.alb_art_id = a.art_id 
                            where alb_name like '%" . $_GET["search"] . "%' or art_name like '%" . $_GET["search"] . "%'";
                        $data = getData($sql);
                    }
                    if ($_GET["gr_id"]) {   //if it was a genre that has been clicked
                        $sql = "select * from genre 
                            inner join `album_genre` `a-g` on genre.gr_id = `a-g`.gr_id
                            inner join album a on `a-g`.alb_id = a.alb_id
                            inner join artist a2 on a.alb_art_id = a2.art_id
                            where genre.gr_id=" . $_GET["gr_id"];
                    }
                } else {  //if nothing no search was used, show all albums
                    $sql = "select * from album inner join artist a on album.alb_art_id = a.art_id";
                }

                // get data
                $data = getData($sql);

                if (!$data){
                    echo "<p>Er zijn geen resultaten gevonden. Gelieve een andere zoekterm te proberen</p>";
                }

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
print GenreList($data)  //print the genres?>

<?php PrintFooter();




