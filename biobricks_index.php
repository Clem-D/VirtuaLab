<?php
session_start();
$title="Biobricks - Virtu-Lab";
$rubric="Biobricks";
include("header.php");
?>		


<section>
<h1>Welcome to the Biobricks Management Page
<span id="pseudo"> <?php echo $_SESSION['pseudo']; ?> </span></h1>

<h2>Biobricks</h2>
<p>Here you can use the menu at the top for create, see, and delete Biobricks.</p>

    </section>

    <?php include('footer.php');?>