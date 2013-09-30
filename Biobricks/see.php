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
$rubric = 'Biobricks';
$title = 'See biobricks';
include("../utils/header.php");
session_start();
echo "<section>";
$dom = new DOMDocument();
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->load('biobrick.xml');
$elements = $dom->getElementsByTagName('row');



$result = array();
$result = getAllXML($elements);


echo "<br><h1>Biobricks</h1><br>
	<table class='tableau'>
	  	 <TR> 
 			<TH class='tableth'>Biobrick's IGEM name</TH> 
 			<TH class='tableth'>Biobrick's name</TH> 
 	
 		</TR>";

for ($i = 0; $i < (count($result)); $i+=2) {
    echo " <TR class='' ><TD class='tabletd'> <a href=\"infosBiobricks.php?igem_name=" . $result[$i] . "\">" . $result[$i] . "</a></TD> <TD class='tabletd'>" . $result[$i + 1] . "</TD></TR> ";
}
echo"</table>";

echo "</section>";

include('../utils/footer.php');

///////////////////////////// 
///////// FUNCTIONS ///////// 
///////////////////////////// 
function getAllXML($elements) {
    foreach ($elements as $elem) {
        $children = $elem->childNodes;
        foreach ($children as $child) { // On prend chaque nœud enfant séparément
            if ($child->nodeName == "member_name") {
                $result[] = $child->nodeValue;
            } elseif ($child->nodeName == 'part_name') {
                $result[] = $child->nodeValue;
            }
            
        }
    }

    return $result;
}

?>
