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
	$name= $_POST['pseudo'];
	$email= $_POST['mail'];
	$team= $_POST['team'];
	
	$dom = new DOMDocument();
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->load('XMLFiles/user.xml');

	/*new tag <user>*/

	$new_user = $dom->createElement('user');

	/*new tage <name>*/

	$new_name = $dom->createElement('name');
	$name_content = $dom->createTextNode($name);
	$new_name->appendChild($name_content);
	$new_user->appendChild($new_name);
	
	/*new tage <pass>*/
	
	$new_pass = $dom->createElement('pass');
	$pass_content = $dom->createTextNode($pass_hache);
	$new_pass->appendChild($pass_content);
	$new_user->appendChild($new_pass);
	
	/*new tag <email>*/
	
	$new_email = $dom->createElement('email');
	$email_content = $dom->createTextNode($email);
	$new_email->appendChild($email_content);
	$new_user->appendChild($new_email);
	
	/*new tage <team>*/
	
	$new_team = $dom->createElement('team');
	$team_content = $dom->createTextNode($team);	
	$new_team->appendChild($team_content);
	$new_user->appendChild($new_team);


	
	$elements = $dom->getElementsByTagName('liste');
	$element = $elements->item(0);
	$element->appendChild($new_user);
	

	
	$dom->save("XMLFiles/user.xml");
	
	
header('Location: ../index.php');   
?>
