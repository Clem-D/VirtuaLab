<?php

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