<?php
/*  Voilà ce que j'imagine : dans informations y aurai un tableau recapitulatifs des infos de l utilisateur
 *  son nom, sa date d inscription, son équipe, son groupe. ( c est tout je pense ? )
 * Dans setting on pourra changer son mail et son MDP
 * Dans My team on pourra voir les autres membres de son équipe (et/ou de son groupe)
 * */
 
session_start();
$_SESSION['derniereaction'] = time();
$title="My Count - Virtu-Lab";
$rubric="Count";

include("header.php");
?>		


<section>
<h1>Welcome to your count
<span id="pseudo"> <?php echo $_SESSION['pseudo']; ?> </span></h1>

<h2>Your count</h2>
<p>Here you can use the menu at the top for see and change informations about your count and your team.</p>

    </section>

    <?php include('footer.php');?>
