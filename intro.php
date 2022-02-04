<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 1);
require_once "lib/autoload.php";

PrintHead();
?>

    <main>

        <?php PrintIntro(); ?>

        <section class="middle">

        </section>

    </main>

    <div class="intro">
    <?php
$data = getData("select * from genre");
print GenreList($data)  //print the genres?>
</div>
<?php PrintFooter();




