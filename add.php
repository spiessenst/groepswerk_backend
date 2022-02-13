<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 1);
require_once "lib/autoload.php";

PrintHead("" , "addfield.js");

?>

    <main>

        <?php PrintTop(); ?>

        <section class="middle">
            <?php
            $data = getData("select * from genre");


            $extra_elements['select_genre'] = GenreSelect($data);
            $extra_elements['csrf_token'] = GenerateCSRF();


            $template =  file_get_contents("templates/add.html");

            $output =  MergeViewWithExtraElements( $template , $extra_elements);


            print $output;
            ?>

        
        </section>

    </main>

<?php
$data = getData("select * from genre");
print GenreList($data)  //print the genres?>

<?php PrintFooter();




