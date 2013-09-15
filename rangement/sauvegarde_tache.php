<?php	

$dom = new DOMDocument();
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->load('projet.xml');

//Nouvelle balise <level>

$level='level'.$_level;
$new_level = $dom->createELement($level);

//Nouvelle balise <task>

$new_task = $dom->createElement('task');

//Nouvelle balise <name> pour <task>

$new_name = $dom->createElement('name');
$name_content = $dom->createTextNode(getName($_newTask));
$new_name->appendChild($name_content);
$new_task->appendChild($new_name);

//Nouvelle balise <leftParent>
$new_leftParent = $dom->createElement('leftParent');
$lParent_content = $dom->createTextNode($_newTask->getLeftParent());
$new_leftParent->appendChild($lParent_content);
$new_task->appendChild($new_leftParent);

//Nouvelle balise <rightParent>
$new_rightParent = $dom->createElement('rightParent');
$rParent_content = $dom->createTextNode($_newTask->getRightParent());
$new_rightParent->appendChild($rParent_content);
$new_task->appendChild($new_rightParent);

//Nouvelle balise <etat>
$new_state = $dom->createElement('state');
$state_content = $dom->createTextNode($_newTask->getState());
$new_state->appendChild($state_content);
$new_task->appendChild($new_state);

//Recherche du projet et attache de <task>
$elements = $dom->getElementsByTagName('projet');

foreach($elements as $element){
  $children = $element->getElementsByTagName('name')->item(0);
  if($children->firstChild->nodeValue == $_project){ 
    //recuperation de la balise correspondant au niveau en cours
    $child=$element->getElementsByTagName($level); 
    if($child->length!=0){
	$child->item(0)->appendChild($new_task);
    }      
    else{
      //Attache de <task> a <level>
      $new_level->appendChild($new_task);
      $element -> appendChild($new_level);
    }    
  }
}

/*on enregistre dans un fichier*/

$dom->save("projet.xml");

?>