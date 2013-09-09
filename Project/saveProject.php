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
    
function createNode($dom,$name){
    //New tag <name>
    $new_name = $dom->createElement('name');
    $name_content = $dom->createTextNode($name);
    $new_name->appendChild($name_content);
    return $new_name;
}

//To get arguments
$project=&$_POST['project'];
$level=&$_POST['level'];
$level='level'.$level;
$name=&$_POST['name'];
$name = str_replace('.png    ','',$name);
$name = str_replace('../Pictures/','',$name);
echo $name;

$dom = new DOMDocument();
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->load('XMLfiles/'.$project.'.xml');

$root = $dom->getElementsByTagName('project');

$new_name = createNode($dom,$name);

$child=$dom->getElementsByTagName($level); 
if($child->length!=0){
            $child->item(0)->appendChild($new_name);
}      
else{
  $new_level = $dom->createElement($level);     
  $new_level->appendChild($new_name);
  $root->item(0)->appendChild($new_level);
}


//to save 

$dom->save('XMLfiles/'.$project.'.xml');  

?>
