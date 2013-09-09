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
if(isset($_POST['continue'])){
  $project = $_POST['choix'];
}
include('../utils/header.php');
?>

<?php
$project=$_POST['project_name'];

$document_xml = new DomDocument();
$document_xml -> load('XMLfiles/'.$project.'.xml');

$names=[];
$elements = $document_xml->getElementsByTagName('project');

foreach($elements as $element){ //read each project  
    $bricks=$element->getElementsByTagName('brick');
    foreach($bricks as $brick){
      $names[]=$brick->nodeValue;
    }
    $levels=$element->getElementsByTagName('level0');
    if($levels->length==0){
      include('newProject.php');
    }
    else{
      include('savedProject.php');
    }
  //}
}
include('../utils/footer.php');

?>
