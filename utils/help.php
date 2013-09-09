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
session_start();
$title="Help";
$rubric="NoMenu";
include("header.php");
?>		


<section>
    <h1>HELP</h1>
    <h2>What is it ? </h2>
    <p>This is a web site for manage IGEM's tasks.</p>
    <h2>What's the point ? </h2>
    <p>It eases your IGEM's project arrangement : It can show who use what biobricks for what project etc.</p>
    <h2>How can I use it ?</h2>
    <p>First, click on the Biobricks menu on your left then manage the Biobricks you will use for your projects. Then, manage your project with theses Biobricks, thanks to the Project menu on your left.</p>
    <!--
    <h2>Example</h2>
    <p>Quand ce sera finit ça serai HYPER COOL de faire une vidéo youtube (sous titrée en anglais) et de la foutre là.</p>
    -->
    <a href="video.php" onClick="window.open('','popup','width=900,height=560,left='+
((screen.width - 900)/2)+',top='+((screen.height - 560)/2));" target="popup">Modify a project</a>
    <h2>Who made it ?</h2>
    <p>The Bordeaux team of IGEM 2013. For more informations please check the <a href='about.php'>about page</a>.</p>
        </section>


    <?php include('footer.php');?>
