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
    
	$pass_hache = sha1($_POST['pass']);
	$pseudo = $_POST['pseudo'];
	$document_xml = new DomDocument();
	$document_xml->load('XMLFiles/user.xml'); // Chargement à partir de zcode.xml
	$resultat_html = '';
	$name=[];
	$pass=[];
	$team=[];
	$elements = $document_xml->getElementsByTagName('user');
	foreach($elements as $element)
	{
		$enfants = $element->childNodes; // On récupère les nœuds enfants de zcode avec childNodes
						 
		foreach($enfants as $enfant) // On prend chaque nœud enfant séparément
		{
			  $balise = $enfant->nodeName; // On prend le nom de chaque nœud
						 
			  if ($balise == 'name')
			  {				
					$name[]= $enfant->nodeValue;
			  }
			  elseif($balise == 'pass')
			  {				
					$pass[]= $enfant->nodeValue;
			  }
			  elseif($balise == 'team')
			  {					
					$team[]= $enfant->nodeValue;
			  }
		}
	}
	$cc=count($name)-1;	
	for ($i = 0; $i<=$cc; $i++)
	{
		if (($name[$i]==$pseudo) && ($pass[$i]==$pass_hache))
		{
			session_start();    
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['team'] = $team[$i];			
			header('Location: ../rubrics/home.php');  
		}		
	}
	echo 'Incorrect password or login !</p>';
?>

<!DOCTYPE html>
<html>
</p>
	<a href="index.php"> Retour </a> 
</p>
</html>
