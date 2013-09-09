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
//get the taks' name
function getName($object){
  if (gettype($object)=='object'){
    if(get_class($object)=='task'){
      return $object->name;
    }
  }
  else {
    return $object;
  }
}

//Creer une tache
function task($i,$names,$plus,&$list,$indice){
  //Recuperer les noms des deux parents
  $name1=getName($names[$i]);
  $name2=getName($names[$i+$plus]);
  
  //creation du nom de la nouvelle tache
  $name = $name1."_".$name2;
  
  //Si la nouvelle tache n'existe pas
  if($name!='_' && !array_search($name,$list)){
        
    //creation d'un nouvel objet
    $newTask = new task($name,$name1,$name2,$list,$indice);
    
    //calcul du nombre de biobrick qui le composeront
    $nbParents=count(explode("_",$name));
    
    //construction
    $image1 = imagecreatefrompng('./Images/'.$name1.'.png');
    $image = imagecreate(74*$nbParents,20);
    imagecopymerge($image,$image1,0,0,0,0,imagesx($image1),20,100); 
    $image2 = imagecreatefrompng('./Images/'.$name2.'.png');
    imagecopymerge($image,$image2,imagesx($image1),0,0,0,imagesx($image2),20,100); 
    imagepng($image,'./Images/'.$name.'.png');
    return $newTask;
  }
  else{
    return "";
  }
}

//Affichage des bricks
function image($_newTask,&$_allNames,&$_taskNames,$_id,$_level,$_project){
  if ($_newTask!=''){
      $_allNames=$_newTask->getBiobrickList();
      array_push($_taskNames,$_newTask); //sauvegarde du nouvel objet
      //include('sauvegarde_tache.php');
      $name='./Images/'.getName($_newTask).'.png';
      $id=$_id;
      $id2=$id+1000;
      echo"<button type='button' id=$id2 class='task' onclick=addInfo(this.id)>";
      if ($_newTask->getState()=='in'){
	echo"        <img src=$name  id=$id alt=$name draggable='true' ondragstart='drag(event)'/>";
      }
      elseif($_newTask->getState()=='out'){
	echo"        <img src=$name  class='brightness' id=$id alt=$name draggable='true' ondragstart='drag(event)'/>";
      }  
      elseif($_newTask->getState()=='done'){
	echo"        <img src=$name  class='done' id=$id alt=$name draggable='true' ondragstart='drag(event)'/>";
      }  
      echo"</button>";
  }
}

//creer une tache a partir de celles selectionnees
function image2($img1,$img2){
  $name1=$img1;
  $name2=$img2;
  $name1=str_replace('.png','',$name1);
  $name2=str_replace('.png','',$name2);
  $nbParents=count(explode($name1))+count(explode($name2));
  $name='./Images/'.$name1.'_'.$name2.'.png';
  $image1 = imagecreatefrompng('./Images/'.$name1.'.png');
  $image = imagecreate(74*$nbParents,20);
  imagecopymerge($image,$image1,0,0,0,0,imagesx($image1),20,100); 
  $image2 = imagecreatefrompng('./Images/'.$name2.'.png');
  imagecopymerge($image,$image2,imagesx($image1),0,0,0,imagesx($image2),20,100);  imagepng($image,$name);
}

class task {
  public $name;
  private $leftParent;
  private $rightParent;
  private $biobrickList;
  private $state='out'; //3 etats : in out done
  
  function __construct($_name,$_leftParent,$_rightParent,$_biobrickList,$indice){
    $this->name=$_name;
    $this->leftParent=$_leftParent;
    $this->rightParent=$_rightParent;  
    
    $leftPPosition = array_search($_leftParent,$_biobrickList);
    $rightPPosition = $leftPPosition+1;
    $_biobrickList[$leftPPosition] = $_name;
    unset($_biobrickList[$rightPPosition]);
    $this->biobrickList = array_values($_biobrickList);
    
    if($indice==0){
      $this->state = 'in';
    }
    if($indice==-1){
      $this->state ='done';
    }
  }
  
  function setState($_state){
    $this->state=$_state;
  }
  
  function getLeftParent(){
    return $this->leftParent;
  }
  
  function getRightParent(){
    return $this->rightParent;
  }
  
  function getBiobrickList(){
    return $this->biobrickList;
  }
  
  function getState(){
    return $this->state;
  }
}


?>
