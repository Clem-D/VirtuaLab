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

///////////////////////////////////////////////////////////
//////////////// FUNCTIONS ////////////////////////////////
///////////////////////////////////////////////////////////

function menu_count(){
    echo "
    <section>
	<nav>	
	<ul id=\"nav\">
		<li><a href=\"../Member/info.php\">Informations</a></li>
		<li><a href=\"../Member/settings.php\">Settings</a></li>
		<li><a href=\"../Member/my_team.php\">My Team</a></li>	
                <li><a href=\"../utils/help.php\">Help</a></li>
		<li><a href=\"../index.php\">Disconnect</a></li>
	</ul>
	</nav>

</section>
    ";
    
}
function menu_project(){
    
      echo "
    <section>
	<nav>	
	<ul id=\"nav\">
		<li><a href=\"../Project/create.php\">Create Project</a></li>
		<li><a href=\"../Project/continue.php\">Continue a project</a></li>
		<li><a href=\"../Project/delete.php\">Delete a project</a></li>
		<li><a href=\"../utils/help.php\">Help</a></li>
		<li><a href=\"../index.php\">Disconnect</a></li>
	</ul>
	</nav>

</section>
    ";
    
    
}
function menu_biobrick(){
    
        echo "
    <section>
	<nav>	
	<ul id=\"nav\">
		<li><a href=\"../Biobricks/create.php\">Add Biobricks</a></li>
                <li><a href=\"#\">See Biobricks</a>
                    <ul>
				<li class=\"test\"><a href=\"../Biobricks/allBiobricks.php\">See all Biobricks</a></li>
				<li class=\"test\"><a href=\"../Biobricks/memberBiobricks.php\">See my Biobricks</a></li>
			</ul>
                        </li>

		<li><a href=\"../Biobricks/delete.php\">Delete a Biobricks</a></li>
                    <li><a href=\"../utils/help.php\">Help</a></li>
		<li><a href=\"../index.php\">Disconnect</a></li>		
	</ul>
	</nav>

</section>
    ";
    
    
}
function menu_home(){
    
        echo " 
    <section>
	<nav>	
	<ul id=\"nav\">
		<li><a href=\"../utils/help.php\">Help</a></li>	
		<li><a href=\"../index.php\">Disconnect</a></li>
	</ul>
	</nav>

</section>
    ";
    
    
}

function menu_choose($rubric){ /* switch on rubric and call other functions */
switch ($rubric) {
	case "Home":
		menu_home();
		break;
	case"Project":
		menu_project();
		break;
	case"Biobricks":
		 menu_biobrick();
		break;
	case"Project":
		menu_project();
		break;
        case "Count" :
            menu_count();
            break;
        case "NoMenu": // if you don't want a menu
            break;
	default :
		echo "<p> Variable Rubric undefined ! </p> ";

} 

}

function checktimeAndLog(){

	$dureelimite=15*60;

    if (time() - $_SESSION['derniereaction'] > $dureelimite) {
        ob_start();
        echo "<script>alert('Your session has expired. Please log you again.')</script>";
		header('Refresh:0.1; url=../index.php'); 
    	ob_flush();
    }
    else {
        $_SESSION['derniereaction'] = time();
    }
    if ( $_SESSION['pseudo'] == "") {
		echo "<script>alert('Please log you.')</script>";
		header('Refresh:0.1; url=../index.php'); 
    }
    
}

checktimeAndLog();
?>




<!DOCTYPE html>

<html>
<head> 
<title><?php echo $title ?></title>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
   <link rel="stylesheet" type="text/css" href= <?php $_SERVER['DOCUMENT_ROOT']?>"/virtuLab/config/style.css" />
<script type="text/javascript" src=<?php $_SERVER['DOCUMENT_ROOT']?>"/virtuLab/Project/projectFunctions.js">
		</script>
</head>

<body>

<div id="global">
<header>
	<figure>
		<img src=<?php $_SERVER['DOCUMENT_ROOT']?>"/virtuLab/Pictures/igem.jpg" alt="logo" title="VirtuLab Home" class="titlepicture"/>				
	</figure>
 </header>

<?php menu_choose($rubric); ?>
<nav id= "horizontalist" >	
	<ul>
	
<li <?php if ($rubric == 'Home' ) { echo "id=\"currentli\" "; } else { echo "class=\"notcurrent\""; }  ?> ><a href= <?php $_SERVER['DOCUMENT_ROOT']?>"/virtuLab/rubrics/home.php " <?php if ($rubric == 'Home' ) { echo "id=\"current\" "; } ?> >Home</a></li>


<li <?php if ($rubric == 'Count' ) { echo "id=\"currentli\" "; } else { echo "class=\"notcurrent\""; }  ?>  ><a href= <?php $_SERVER['DOCUMENT_ROOT']?>"/virtuLab/rubrics/count.php " <?php if ($rubric == 'Count' ) { echo "id=\"current\" "; } ?> >My account</a></li>


<li <?php if ($rubric == 'Biobricks' ) { echo "id=\"currentli\" "; } else { echo "class=\"notcurrent\""; }  ?>  ><a href= <?php $_SERVER['DOCUMENT_ROOT']?>"/virtuLab/rubrics/biobricks_index.php " <?php if ($rubric == 'Biobricks' ) { echo "id=\"current\" "; } ?> >Biobricks</a></li>


<li <?php if ($rubric == 'Project' ) { echo "id=\"currentli\" "; } else { echo "class=\"notcurrent\""; }  ?>  ><a href= <?php $_SERVER['DOCUMENT_ROOT']?>"/virtuLab/rubrics/project_index.php " <?php if ($rubric == 'Project' ) { echo "id=\"current\" "; } ?> >Project</a></li>



	</ul>
</nav> 

<div id="content">
<br>

