<?php
require_once "lib/autoload.php";

PrintHead();
?>

    <main>

   <?php  PrintTop() ; ?>

    <section class="middle">

    </section>

    </main>

    <?php


print GenreList("select * from genre") ?>

    <?php  PrintFooter() ;



