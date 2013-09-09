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
$title = "My Team - Virtu-Lab";
$rubric = "Count";
$name=$_SESSION['pseudo'];
$team=$_SESSION['team'];
include("../utils/header.php");

echo " <section> ";
echo "<p>page not avaible for the moment</p>";


echo " </section> ";

echo " <br>  <br>  <br>  ";
include('../utils/footer.php'); 
 
?>
