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
$title="Project - Virtu-Lab";
$rubric="Project";
include($_SERVER['DOCUMENT_ROOT']."/virtuLab/utils/header.php");
?>		


<section>
<h1>Welcome to the Project Management Page,
<span id="pseudo"> <?php echo $_SESSION['pseudo']; ?> </span></h1>

<h2>Project</h2>
<p>Here you can use the menu at the top to create, see, join or delete project(s).</p>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'].'/virtuLab/utils/footer.php');?>
