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
?>


<?php 	

if(isset($_GET['title'])){
$_SESSION['title']=$_GET['title'];}

$title=str_replace('./Images/','',$_SESSION['title']);
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8" />
<link rel="stylesheet" href=<?php $_SERVER['DOCUMENT_ROOT']?>"/virtuLab/config/style.css" />
<script type="text/javascript" src=<?php $_SERVER['DOCUMENT_ROOT']?>"/virtuLab/Project/taskFunctions.js">
		</script>
<title> Task : <?php echo $title ?></title>
</head>


<body>
    <div id='global'>
<div id="content">

<?php

//check if a file for this task already exist
$bool=false;
exec('ls ../Biobricks/XMLfiles',$elements);
foreach ($elements as $element){
    $element=str_replace('.xml','',$element);
    if ($element==$title){
        $bool=true;
    }
}

echo"
 <form id='details' method='POST' action='' name='details'>
     </br><h1> $title </h1>           
     </br><input type='hidden' id='nbExperiment' value='0'>      
     <h2 id='details'> Experiments </h2></br>
</form>";
         
 if ($bool==true){
    include('openTask.php');    
}
     
     echo "
     <form id='details' method='POST' action='details.php' name='experiment'>
         <button type='button' name='newTech' onclick='addExperiment()'> Add an experiment </button></br></br> 
     </form>   

<input type='submit' id='pop_up' value='Exit' onclick='self.close();'/>";
include('../utils/footer.php');?>
