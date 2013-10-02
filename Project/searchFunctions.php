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

function getAllProjects(){ //to get all the saved projects
 	global $team;
	$projects = array();
	$results=array();
	exec('ls ../Project/XMLfiles',$elements);
	foreach($elements as $element){ 
	  $teamcheck=checkTeam($team,$element);//to only keep team's projects	
		if ($teamcheck){
			$results[]=str_replace(".xml",'',$element);//to save into $projects, project's names
		}	
	}
	return $results;                                                   
}

function checkTeam($team,$file){
	global $team;
	$document_xml = new DomDocument();
	$document_xml->load('XMLfiles/'.$file);
	$elements = $document_xml->getElementsByTagName('project');
	foreach($elements as $element){
			$children = $element->childNodes; //to get child nodes (like team)
			foreach($children as $child) {
				 $balise = $child->nodeName; //to get the node name	 
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
