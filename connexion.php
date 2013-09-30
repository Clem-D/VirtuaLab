<?php
$pass_hache = sha1($_POST['pass']);
$pseudo = $_POST['pseudo'];
$team=$_POST['team'];
$pseudocheck=checkName();
if ($pseudocheck){

	$pwdcheck=checkPWD();
	if ( $pwdcheck ) {
			session_start();    
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['team'] = $team;			
			// $_SESSION['group']=checkGroup(); // group is not avaible yet...
			header('Location: rubrics/home.php');  
	}
	else {
		echo " <p >Incorrect password, please try again : <a href=\"index.php\"> index page.</a> </p>";
	}
}
else{
	echo " <p >Incorrect login, please try again : <a href=\"index.php\"> index page.</a> </p>";
}

 /////// /////// ///////
//// FUNCTIONS   ///////
 /////// /////// ///////
 /*
 *Check if the XML file exist or not
 * Return true or false
 */
function checkName() {
	global $pseudo,$team;
	 $querry = shell_exec('ls Member/XMLfiles/'.$pseudo.'-'.$team.'.xml');
    $files = preg_split('#\s#', $querry);
    
    
    foreach ($files as $elements) {
       echo "<br>".$elements;
       $check = eregi($pseudo. '-' . $team, $elements);
       if ( $check){
       	return true;
       	}
    }
    return false;
}

function checkPWD(){
	global $pseudo,$team,$pass_hache;
	$dom = new DomDocument();
	$dom->load('Member/XMLfiles/'.$pseudo.'-'.$team.'.xml');
	$elements = $dom->getElementsByTagName('user');
	foreach($elements as $element){
		$children = $element->childNodes; 
						 
		foreach($children as $child) {
			$balise = $child->nodeName; 
			if ($balise == 'pass'){				
				$pwd=$child->nodeValue;
			}
			
		}
			
	}
	
	if ( $pass_hache == $pwd ){
		return true;
	}
	else {
		return false;
	}
}


?>
