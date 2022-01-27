<?php
require_once "lib/autoload.php";

PrintHead();
?>

    <main>

        <?php  PrintTop() ; ?>

        <section class="middle">

            <?php  print file_get_contents("templates/detail.html"); ?>

        </section>

    </main>

<?php

$data = getData("select * from genre" );
print GenreList($data) ?>

<?php  PrintFooter() ;




