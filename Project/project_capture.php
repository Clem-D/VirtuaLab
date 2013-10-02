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
  	ob_start();
	session_start();	
	$_SESSION['derniereaction'] = time();
	ini_set('display_errors', 1); 
	$team= $_SESSION['team'];
	$pseudo=$_SESSION['pseudo'];

 	$group=getGroup($pseudo,$team);
	$dom = new DOMDocument();
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->encoding = 'ISO-8859-1';  
	$dom->version = '1.0';
	


        /* new tag <project> */
        $project = $dom->createElement('project');
        
	/*new tag <date> */
	$date = date('m/d/Y');
        $new_date = $dom->createElement('date');
	$date_content = $dom->createTextNode($date);
	$new_date->appendChild($date_content);
	$project->appendChild($new_date);
        
        /*new tag <team>*/
	$new_group = $dom->createElement('group');
	$group_content = $dom->createTextNode($group);
	$new_group->appendChild($group_content);
	$project->appendChild($new_group);
        
        /*new tag <team>*/
	$new_team = $dom->createElement('team');
	$team_content = $dom->createTextNode($team);
	$new_team->appendChild($team_content);
	$project->appendChild($new_team);
        
	/*new tag <brick>*/
	for ( $i=0; $i<$_POST['number']; $i++)
	{
		$new_brick = $dom->createElement('brick');
		$brick_content = $dom->createTextNode($_POST[$i]);
		$new_brick->appendChild($brick_content);
		$project->appendChild($new_brick);
	}	
	
	$dom->appendChild($project);

        /*to save in a file*/
	
	$dom->save("XMLfiles/".$_POST['name'].".xml");
	shell_exec("chmod 777 XMLfiles/".$_POST['name'].".xml");
	
	echo "<script>alert('Your Project was successfully added.')</script>";
 

header('Refresh:0.1; url=../rubrics/project_index.php'); 
    ob_flush();

///////////////////////
///// FUNTIONS////////
//////////////////////

function getGroup($pseudo,$team){
            $dom = new DomDocument();
            $dom->load('../Member/XMLfiles/'.$pseudo.'-'.$team.'.xml');
            $elements = $dom->getElementsByTagName('user');
            foreach($elements as $element){
                    $children = $element->childNodes; 
                    foreach($children as $child) {
                            $balise = $child->nodeName; 
                            if ($balise == 'group'){				
                                    $group=$child->nodeValue;
                            }
                    }
            }
            return $group;
}
?>
