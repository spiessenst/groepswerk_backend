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

    $data = getData("select * from genre" );
    print GenreList($data) ?>

    <?php  PrintFooter() ;




