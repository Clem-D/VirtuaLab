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
$_SESSION['derniereaction'] = time();

$title = "Home - Virtu-Lab";
$rubric = "Home";

include("../utils/header.php");


?>				

<section>

    <h1>Welcome to the Virtual L.A.B. project, 
        <span id="pseudo"> <?php echo $_SESSION['pseudo']; ?> </span></h1>

    <h2>First time you're here ?</h2>
    <p>You can change your account settings or begin to create biobricks for your futurs projects.</p>
    <p>You also can check which biobricks are avaibles to use them in your projects.</p>

    <h2>Not your first time ?</h2>
    <p>Do what you want : create biobricks or contribute to a project.</p>

    <h2>Anyway</h2>
    <p>If you got any problems, check the <a href='../utils/help.php'>help page</a> .</p>


</section>

<?php include('../utils/footer.php'); ?>
