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
$title = "Settings - Virtu-Lab";
$rubric = "Count";
$name=$_SESSION['pseudo'];
$team=$_SESSION['team'];
$email=getMail();


include("../utils/header.php");

if (isset($_POST['delete'])  ){

	$_SESSION['pseudo']="";
	$_SESSION['group']="";    // dans les autres pages, mettre un test sur ces 2 variables ( if != "" )
	shell_exec('rm XMLfiles/' . $name . '-' . $team . '.xml');
	header('Location: delete.php'); 
}

if (isset($_POST['adress'])    ){

	setEmail($_POST['adress']);
	echo "<p> Your adress was update ! </p> "; //alert ???
}

if (isset($_POST['pwd'])   and isset($_POST['pwd_2'])   ){

	if ($_POST['pwd'] == "" ||  $_POST['pwd_2'] == "" ) {
		echo "<p> Please don't type an empty password !!! </p> "; // alert ??
	}
	else {
		if ( $_POST['pwd']==$_POST['pwd_2']){
			setPWD($_POST['pwd_2']);
			echo "<p> Your password was succefully changed ! </p> "; // alert ??
		}
		else {
			echo "<p> The two passwords are not the same. Please try again. </p> "; // alert ??
		}
	}
}



echo "
<h2>Change your mail adress </h2>
<form  method=\"post\" action=\"settings.php\">
 <label >E-Mail adress :</label> 
			 <input type=\"email\" name=\"adress\" id=\"pseudo\" value=\"".$email."\" /> 
					<input type=\"submit\" value=\"Update my e-mail adress\" />
</form>

";



echo "
<h2>Change your password</h2>
<form  method=\"post\" action=\"settings.php\">
 <label >New password :</label> 
  <input type=\"password\" name=\"pwd\" id=\"\" /> 
  <label >New password : (again)</label> 
  <input type=\"password\" name=\"pwd_2\" id=\"\" /> 
  
					<input type=\"submit\" value=\"Update my password\" />
</form>

";


echo "
<CENTER>
<h2>Delete your count </h2>
<CENTER>
 <form  method=\"post\" action=\"settings.php\">	

<input type=\"hidden\" name=\"delete\"/>
<input type=\"submit\" value=\"Delete my count\" />
</form>


";

include('../utils/footer.php'); 
 
 
 
function getMail(){

	global $name,$team;
	$dom = new DomDocument();
	$dom->load('XMLfiles/'.$name.'-'.$team.'.xml');

	$elements = $dom->getElementsByTagName('user');
	foreach($elements as $element){
		$children = $element->childNodes; 		 
		foreach($children as $child) {
			$balise = $child->nodeName; 
			if ($balise == 'email'){				
				$pwd=$child->nodeValue;
				return $pwd;
			}
			
		}
			
	}
} 


function setEmail($email){
	
	global $name,$team;
	$dom = new DomDocument();
		$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->load('XMLfiles/'.$name.'-'.$team.'.xml');
	$elements = $dom->getElementsByTagName('user');
	foreach($elements as $element){
		$children = $element->childNodes; 		 
		foreach($children as $child) {
			$balise = $child->nodeName; 
			if ($balise == 'mail'){	
	
				$element->removeChild($child);
				$dom->appendChild($element);

	
			}
			
		}
		
		$new_email = $dom->createElement('email');
		$email_content = $dom->createTextNode($email);
		$new_email->appendChild($email_content);
		$element->appendChild($new_email);
		$dom->appendChild($element);	
	}
	

	$dom->save('XMLfiles/' . $name . '-' . $team . '.xml');

} 
 
 
 function setPWD($pwd){
	$hpwd=sha1($pwd);
	global $name,$team;
	$dom = new DomDocument();
	$dom->load('XMLfiles/'.$name.'-'.$team.'.xml');
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	
	
	$elements = $dom->getElementsByTagName('user');
	foreach($elements as $element){
		$children = $element->childNodes; 		 
		foreach($children as $child) {
			$balise = $child->nodeName; 
			if ($balise == 'pass'){	
	
				$element->removeChild($child);
				$dom->appendChild($element);

			}
			
		}
		
		$new_pass = $dom->createElement('pass');
		$pass_content = $dom->createTextNode($hpwd);
		$new_pass->appendChild($pass_content);
		$element->appendChild($new_pass);
		$dom->appendChild($element);	
	}
	

	$dom->save('XMLfiles/' . $name . '-' . $team . '.xml');

} 
 
?>
