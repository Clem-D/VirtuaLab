<?php


/*

Copyright (C) 2013  Clément DELESTRE
    					Jonathan MELIUS
						Maëva VEYSSIERE
						
	version beta 0.5					

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
    
    */

/*  Voilà ce que j'imagine : dans informations y aurai un tableau recapitulatifs des infos de l utilisateur
 *  son nom, sa date d inscription, son équipe, son groupe. ( c est tout je pense ? )
 * Dans setting on pourra changer son mail et son MDP
 * Dans My team on pourra voir les autres membres de son équipe (et/ou de son groupe)
 * */
 
session_start();

$title="My Count - Virtu-Lab";
$rubric="Count";

include("../utils/header.php");
?>		


<section>
<h1>Welcome to your count,
<span id="pseudo"> <?php echo $_SESSION['pseudo']; ?> </span></h1>

<h2>Your count</h2>
<p>Here you can use the menu at the top for see and change informations about your count and your team.</p>

    </section>

    <?php include('../utils/footer.php');?>
