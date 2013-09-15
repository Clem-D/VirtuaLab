<?php
	$pass_hache = sha1($_POST['pass']);
	$pseudo = $_POST['pseudo'];
	$document_xml = new DomDocument();
	$document_xml->load('user.xml'); // Chargement à partir de zcode.xml
	$resultat_html = '';
	$name=[];
	$pass=[];
	$group=[];
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
			  elseif($balise == 'group')
			  {					
					$group[]= $enfant->nodeValue;
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
			$_SESSION['group'] = $group[$i];			
			header('Location: rubrics/home.php');  
		}		
	}
	echo '<p>Incorrect password or login !</p>';
?>

<!DOCTYPE html>
<html>
</p>
	<a href="index.php">Back to the index</a> 
</p>
</html>
