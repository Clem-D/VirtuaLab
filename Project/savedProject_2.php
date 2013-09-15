<?php
$bNb=count($names);
echo "<div id='project'>
    <h1 id='title'>$project</h1> 
    <section class='level'>";

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
    array_push($task_names,$task->nodeValue);
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
    echo"<img class='newBrick' id=$i src=$name draggable='true' ondragstart='drag(event)' onclick=\"window.open('details.php?title=$task_names[$j].png');\"></img>
    </div>";  
   
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