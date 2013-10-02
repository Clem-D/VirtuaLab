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

//////////////// TO OPEN A PROJECT ALREADY STARTED ///////////////

$bNb=count($names);
echo "<div id='project'>
    <h1 id='title'>$project</h1> 
    <section class='level'>";
    echo"<p>Drag and drop a biobrick in a task (rectangle).<br>When two biobrick are in the same rectangle, they are assembled. You can use this new biobrick on an another level.<br>Click on new task for add a task and click on new level for add a level.  </p>";

$id = 0;
for($i=0;$i<$bNb;$i++){
  $id++;
  $name=$names[$i];
  $name='../Pictures/'.$name.'.png';
    echo"<div class='biobrick';><img src=$name alt=$name id=$id draggable='true' ondragstart='drag(event)'></div>";
}
echo "</section>";

$cpt=0;

$idTask=$id+100;
$idButton1=$id+50;
$idButton2=$id+200;

echo"
<form name='button' method='POST' action=''>";

//To count the number of levels
$nbLevels=0;
$levelsBis=$levels;
        
while($levelsBis->length!=0){
    $nbLevels++;
    $levelsBis=$element->getElementsByTagName('level'.$nbLevels);
}


while($levels->length !=0){ //for each level
  $tasks=$levels->item(0)->getElementsByTagName('name');
  $task_names=array();
  foreach($tasks as $task){ //for each task (tag name)
    //we keep their names
    array_push($task_names,trim($task->nodeValue));
  }
  echo "</br><div class='level2'> Level ".($cpt+1)."</div>";
  for($j=0;$j < count($task_names);$j++){
           
    $i++;     
    $idTask++;
    $idButton1++;
    $idButton2++;
    
    //to display the images
    echo "<div class='task' name=$cpt id=$idTask ondrop='drop(event,this.id)' ondragover='allowDrop(event)'>";
    $name='../Pictures/'.$task_names[$j].'.png';
    echo"<img class='newBrick' id=$i src=$name draggable='true' ondragstart='drag(event)' onclick=\"window.open('details.php?title=$task_names[$j]');\"></img>
    <em>Click to see or modify data about this task</em></div>";  
   
  }  
  
   if($cpt!=$nbLevels-1){
    echo "<button type='button' id=$idButton1 name=$cpt onclick='addTask2(this.id);'>New task</button>";
  }
  else{
      echo "<button type='button' id=$idButton1 name=$cpt onclick='addTask(this.id);'>New task</button>";
  }
  
  $cpt+=1;
  $idTask=$idTask+149;
  $idButton1=$idTask-50;   
  $levels=$element->getElementsByTagName('level'.$cpt);
}
$idButton2=$idTask-49;
echo "<button type='button' id=$idButton2 onclick='addLevel(this.id);'>New level</button>
<input type='hidden' name='save1' id='save1' value='' />
<input type='hidden' name='save2' id='save2' value='' />
</form></br></div>
<div></div>";
?>
