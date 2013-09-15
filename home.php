<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
$_SESSION['derniereaction'] = time();


$title = "Home - Virtu-Lab";
$rubric = "Home";

include("../utils/header.php");
?>				

<section>

    <h1>Welcome to the Virtual L.A.B. project
        <span id="pseudo"> <?php echo $_SESSION['pseudo']; ?> </span></h1>

    <h2>First time you're here ?</h2>
    <p>You can change you're account settings or begin to create biobricks for you're futur projects ! </p>
    <p>You also can check which biobricks are avaibles to use them in your projects ! </p>

    <h2>Not your first time ?</h2>
    <p>Do what you want : to create biobricks or to contribute to a project !</p>

    <h2>Anyway</h2>
    <p>If you got any problems, check the <a href='../utils/help.php'>help page</a> .</p>


</section>

<?php include('../utils/footer.php'); ?>
