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
$rubric = 'Biobricks';
$title = "Biobricks - " . $_GET['igem_name'];



include("../utils/header.php");
$seqname;
$desc;
$date;
$member_name;
getXMLinfos();
$teams=getTeam($member_name);  //maybe severals team are possible

echo "<section>";
echo"<h1> Biobrick Informations </h1>";
echo"<h3>IGEM Name</h3>"; 
echo" <h4>" . $_GET['igem_name'] . "</h4>";
echo"<h3>Sequence Name</h3>";
echo" <h4>" . $seqname . "</h4>";
echo"<h3>Antibiotic Name</h3>";
echo" <h4>" . $_GET['antibio'] . "</h4>";

echo"<h2>Creation : </h2> 
    <h3>Member's Name </h3> <h4> ".$member_name." </h4>
    <h3>Member's Team</h3> ";
    
    for ($i=0;$i<count($teams);$i++){
    
    echo "<h4>"  .$teams[$i]. "</h4>";
    
    }
    echo"
   <h3> Date </h3> <h4> ".$date."</h4> ";




echo"<h2>Description : </h2>";
echo "<p>" . $desc . "</p>";



//echo"<h2>Use in projects : </h2>"; <- to do

echo "</section>";
include('../utils/footer.php');

////////////////////
////// FUNCTIONS /////
////////////////////

function getXMLinfos() {
    $dom = new DOMDocument();
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->load('XMLfiles/' . $_GET['igem_name'] . "-" . $_GET['antibio'] . ".xml");

    global $seqname, $desc,$date,$member_name;

    $row = $dom->getElementsByTagName('row');

    foreach ($row as $elem) {
        $children = $elem->childNodes;

        foreach ($children as $child) {

            if ($child->nodeName == 'seq_name') {
                $seqname = $child->nodeValue;
            }

            if ($child->nodeName == 'short_desc') {
                $desc = $child->nodeValue;
            }
			if ($child->nodeName == 'date') {
                $date = $child->nodeValue; 
            } 
            
			if ($child->nodeName == 'member_name') {
				$member_name = $child->nodeValue;  
            } 
        }
    }
}

function getTeam($member_name){
	$results=array();
     exec('ls ../Member/XMLfiles/*'.$member_name.'-*',$querries);
     foreach ($querries as $element){
    	$explode=explode("-",$element);  //return an array size 2
    	$team=str_replace(".xml","",$explode[1]);
    	$results[]=$team;
    }
    
 	return $results;

}

?>
