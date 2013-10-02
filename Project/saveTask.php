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
 $pseudo=$_SESSION['pseudo'];

////////////// TO SAVE THE TASK THAT HAD BEEN MODIFIED (XML) //////////////

function addNode($node,$content,$dom,$exp){
    $name = $dom ->createElement($node);
    $name_content = $dom -> createTextNode($content);
    $name ->appendChild($name_content);
    $exp ->appendChild($name);
}
 
function removeNode($node,$element){
    $elem = $element ->getElementsByTagName($node);
    $element ->removeChild($elem->item(0));
}
 
$task = str_replace('./Images/','',$_SESSION['title']);
 
//Check if a file for this task already exist
$bool = false;
exec('ls ../Biobricks/XMLfiles',$elements);
foreach ($elements as $element){
    $element =  str_replace('.xml','',$element);
    if ($element==$task){
        $bool=true;
    }
}
 
$dom = new DOMDocument();
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
 
//To get informations about experiment
//$state = $_POST['state'];
$date = $_POST['date'];
echo $_POST['date'];
$technician = $_POST['technician'];
echo $_POST['technician'];
$method = $_POST['method'];
$antiB = $_POST['antiB'];
echo $_POST['antiB'];
$comments = $_POST['comments'];
echo $_POST['comments'];
$succeed = $_POST['progress'];
 
$nb=0;
 
if($bool==true){
    $expNb = $_POST['hide'];
    //To count the experiments and
    $dom->load('../Biobricks/XMLfiles/'.$task.'.xml');
    $elements = $dom ->getElementsByTagName('experiment'); 
    foreach ($elements as $element){
        $nb ++;
        $number = $element ->getElementsByTagName('number');
        if($number -> item(0) ->nodeValue == $expNb){
            removeNode('date',$element);
            removeNode('technician',$element);
            removeNode('method',$element);
            removeNode('antibiotic',$element);
            removeNode('short_desc',$element);
            removeNode('succeed',$element);
            $exp = $element;
        }
        else{
            $exp = $dom ->createElement('experiment');
             
            //To give it a number
            addNode('number',$nb+1,$dom,$exp);
        }
    }
    $list = $dom ->getElementsByTagName('list');
    $list = $list ->item(0);
}
 
else {
    $list = $dom ->createElement('list');
    addNode('team',$_SESSION['team'],$dom,$list);
    addNode('member',$pseudo,$dom,$list);
    $exp = $dom ->createElement('experiment');
     
    //To give it a number
    addNode('number',$nb+1,$dom,$exp);
}
 
//To set the date
addNode('date',$date,$dom,$exp);
 
//To add a technician
addNode('technician',$technician,$dom,$exp);
//To add a method
addNode('method',$method,$dom,$exp);
 
//To add an antibiotic
addNode('antibiotic',$antiB,$dom,$exp);
 
//To add short_desc
addNode('short_desc',$comments,$dom,$exp); 
 
 
//To set the progress
addNode('succeed',$succeed,$dom,$exp);
 
$list->appendChild($exp);
$dom ->appendChild($list);
 
/*save*/
 
$dom->save('../Biobricks/XMLfiles/'.$task.".xml");
shell_exec('chmod 777 ../Biobricks/XMLfiles/'.$task.".xml");
 
echo '<script> window.history.back()</script>'
?>
