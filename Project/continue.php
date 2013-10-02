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
$team= $_SESSION['team'];
$pseudo=$_SESSION['pseudo'];
$rubric='Project';
$title='Continue a project - Virtua LAB';

include($_SERVER['DOCUMENT_ROOT']."/virtuLab/utils/header.php");
include("./searchFunctions.php");
ini_set('display_errors', 1); 

$allprojects=getAllProjects(); 
$size=count($allprojects);


echo "

<section>
<h1>Continue a project</h1>

<h2>Choose a Project</h2>
 <label for='project_name'>Choose a project you want to manage :<br></label>
 
 <form class='' action='openProject.php' method='POST'>    
 
 <select name=\"project_name\">
 <option value=\"\"></option>
";


for ( $i=0; $i<$size; $i++){
	echo "
    <option value=\"".str_replace(".xml",'',$allprojects[$i])."\">".str_replace(".xml",'',$allprojects[$i])."</option> ";   
}

echo " </select> <br> <br>
    <input type='submit' name='add' value='Continue'/>
 </br></br> ";


echo " </section> ";
include($_SERVER['DOCUMENT_ROOT'].'/virtuLab/utils/footer.php'); 

?>
