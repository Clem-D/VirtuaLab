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
$title="Delete a Project - Virtu-Lab";
$rubric="Project";
include($_SERVER['DOCUMENT_ROOT']."/virtuLab/utils/header.php");
ini_set('display_errors', 1); 
ob_start();
$allprojects=getAllProjects();
$size=count($allprojects);

if (  isset($_POST['project_name']) and $_POST['project_name'] != ""  ) {

 	shell_exec('rm XMLfiles/' . $_POST['project_name'] . '.xml');
	echo "<script>alert(\"The Project was deleted.\")</script> ";
	header('Refresh:0.1; url=../rubrics/project_index.php'); 
    ob_flush();

	//header("location: delete.php");  // for refresh (avec ça l alert ci dessus n apparait pas...)
}


echo "

<section>
<h1>Delete a project</h1>

<h2>Chose a Project </h2>
 <label for='project_name'>Chose a project you want to delete :<br></label>
 
 <form class='' action='delete.php' method='POST'>    
 
 <select name=\"project_name\">
 <option value=\"\"></option>
";


for ( $i=0; $i<$size; $i++){

	echo "
    <option value=\"".str_replace(".xml",'',$allprojects[$i])."\">".str_replace(".xml",'',$allprojects[$i])."</option> ";
   
}

echo " </select> <br> <br>
    <input type='submit' name='add' value='Delete'/>
 </br></br> ";




include('../utils/footer.php');

////////////////////
 //// FUNCTIONS ////
 ////////////////////
function getAllProjects(){
 	global $team;
	$projects = array();
	$results=array();
	exec('ls ../Project/XMLfiles',$elements);
	foreach($elements as $element){
		array_push($projects,str_replace(".xml",'',$element));
		$teamcheck=checkTeam($team,$element);	
		if ( $teamcheck ){
			$results[]=$element;	
		}
	
	}
	//print_r($projects);
	//print_r($results);
	return $results;
                            
                            
}

function checkTeam($team,$file){
	global $team;
	$document_xml = new DomDocument();
	$document_xml->load('XMLfiles/'.$file);
	$elements = $document_xml->getElementsByTagName('project');
	foreach($elements as $element){
			$children = $element->childNodes; // On récupère les nœuds childs avec childNodes			 
			foreach($children as $child) {
				 $balise = $child->nodeName; // On prend le nom de chaque nœud		 
				if ($balise == 'team'){		
					if ($child->nodeValue ==  $team ){	
						return true;
					}
				}
			}
		}

	return false;
}

?>
