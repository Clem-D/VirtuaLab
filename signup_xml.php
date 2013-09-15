<?php

if ( $_POST['pass'] != $_POST['pass2'] ) {
	echo " <p> The two password are not the same ! please <a href=\"index.php\"> sign up again. </a> </p> ";


}
	
else {
	$pass_hache = sha1($_POST['pass']);
	$pass_hache2 = sha1($_POST['pass2']);
	$name= $_POST['pseudo'];
	$email= $_POST['mail'];
	$team= $_POST['team'];
	$group= $_POST['group'];
	$test=check();
	if ($test){
		echo " <p>Sorry ! But this name is already use, please sign up again on the <a href=\"index.php\"> index page.</a> </p>";
	}
	else {
		save();
	}
}
	
function check(){
global $name,$team;
$querry = shell_exec('ls Member/XMLfiles/');
$files = explode(".xml", $querry);

    foreach ($files as $elements) {

        $check = eregi($name . '-' . $team, $elements);
        if ($check) {
            return true;
        }
    }
    return false;

}
	
	
	
function save(){
	global $pass_hache,$name,$email,$team,$group;

	
	$dom = new DOMDocument();
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->version = '1.0';
	$dom->encoding = 'ISO-8859-1';  


	/*new balise <user>*/

	$new_user = $dom->createElement('user');

	/*new balise <name>*/

	$new_name = $dom->createElement('name');
	$name_content = $dom->createTextNode($name);
	$new_name->appendChild($name_content);
	$new_user->appendChild($new_name);
	
	/*new balise <pass>*/
	
	$new_pass = $dom->createElement('pass');
	$pass_content = $dom->createTextNode($pass_hache);
	$new_pass->appendChild($pass_content);
	$new_user->appendChild($new_pass);
	
	/*new balise <email>*/
	
	$new_email = $dom->createElement('email');
	$email_content = $dom->createTextNode($email);
	$new_email->appendChild($email_content);
	$new_user->appendChild($new_email);
	
	/*new balise <team>*/
	
	$new_team = $dom->createElement('team');
	$team_content = $dom->createTextNode($team);	
	$new_team->appendChild($team_content);
	$new_user->appendChild($new_team);


/*new balise <group>*/
	
	$new_group = $dom->createElement('group');
	$group_content = $dom->createTextNode($group);	
	$new_group->appendChild($group_content);
	$new_user->appendChild($new_group);

	/*new balise <date>*/
	
	
	$date = date("m-d-Y");
	$new_date = $dom->createElement('date');
	$date_content = $dom->createTextNode($date);	
	$new_date->appendChild($date_content);
	$new_user->appendChild($new_date);
	
	
	$dom->appendChild($new_user);
	

	
	$dom->save('Member/XMLfiles/' . $name . '-' . $team . '.xml');
    
    shell_exec('chmod 777 Member/XMLfiles/' . $name . '-' . $team . '.xml');
    
    // echo "<script>alert(\"You are now registered. Welcome ! \")</script> ";

	
	//header('Location: index.php');   
	
	echo " <p >You are now succesfully registred, log you on the <a href=\"index.php\"> index page.</a> </p>";
}
?>
