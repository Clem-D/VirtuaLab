<?php

/*
$sessionCookieExpireTime=1;
session_set_cookie_params($sessionCookieExpireTime);
*/
/*
        ini_set('session.gc_maxlifetime',1);
ini_set('session.gc_probability',1);
ini_set('session.gc_divisor',1);
                $currentTimeoutInSecs = ini_get('session.gc_maxlifetime');
                echo " la variable : ".$currentTimeoutInSecs; 


/*
$CookieInfo = session_get_cookie_params();

echo "<pre>";
echo "Session information session_get_cookie_params function :: <br />";
print_r($CookieInfo);
echo "</pre>";*/


session_start();
 $_SESSION['derniereaction'] = time();
 echo "Session vaut : ". $_SESSION['derniereaction'];
	
$title="test";
$rubric="Home";
/*$test=ord(Home);
echo" petit test : ".$test;*/

/*
switch ($title) {
	case "toto":
		echo" ben c est toto hein ! ";
 		break;
	default :
		echo"eh bah c est pas toto";
    	}
*/
include("header.php");
?>				

<section>

<h1>Welcome to the M.A.E.V' project 
<?php echo $_SESSION['pseudo'];	?></h1>		
		
<form class='bordure' method="post" action="openProject.php">					
	<label for="pays">Project in progress :</label><br /></br>
	<select name="choix">
		<?php	
			$document_xml = new DomDocument();
			$document_xml->load('projet.xml'); // Chargement à partir de code.xml					
			$name=[];
			$team=[];
			$elements = $document_xml->getElementsByTagName('projet');
			foreach($elements as $element)
			{						
				$children = $element->childNodes; // On récupère les nœuds childs avec childNodes
								 
				foreach($children as $child) // On prend chaque nœud child séparément
				{
					  $balise = $child->nodeName; // On prend le nom de chaque nœud
								 
					  if ($balise == 'name')
					  {									
							$name[]= $child->nodeValue;
					  }
					  elseif($balise == 'team')
					  {					
							$team[]= $child->nodeValue;
					  }
				}
			}		
			for ($i=0; $i<count($name);$i++)
				{
				if ($team[$i]==$_SESSION['team'])
					{
					  echo "<option value='".$name[$i]."'";
					  if(isset($_GET['choix']) && $_GET['choix']==$name[$i]) echo "selected";
					  echo ">".$name[$i]." </option>";
		
					}
				}
		?>
		
	</select></br></br>
	<input type='submit' name='continue' value='Continuer'/>
</form>		
</section>
<?php include('footer.php');?>
