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
$title = 'See biobricks';
include("../utils/header.php");

$xmlresults = array();

echo "<section>";

seeAllXML();

echo "
	<table class='tableau'>
 <TR> 
 			<TH class='tableth'>Biobrick's name</TH> 
 			<TH class='tableth'>Biobrick's IGEM name</TH> 
                        <TH class='tableth'>Biobrick's antibiotic</TH> 
 	
 		</TR>";

for ($i = 0; $i < (count($xmlresults)); $i+=3) {
    echo " <TR class='tabletr' ><TD class='tabletd'> <a href=\"infosBiobricks.php?igem_name=" . $xmlresults[$i + 1] . "&antibio=" . $xmlresults[$i + 2] . "\">" . $xmlresults[$i] . "</a></TD> <TD class='tabletd'>" . $xmlresults[$i + 1] . "</TD> <TD class='tabletd'>" . $xmlresults[$i + 2] . "</TD> </TR>  ";
}




echo"</table>";


echo "</section>";
include('../utils/footer.php');

/////////////////////
///// FUNCTIONS ///////
/////////////////////

function seeAllXML() {

    exec('ls XMLfiles',$querry);
    foreach ($querry as $elements) {
        XMLFiles($elements);
    }
}

function XMLFiles($name) {
    $dom = new DOMDocument();
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->load('XMLfiles/'.$name);

    global $xmlresults;

    $row = $dom->getElementsByTagName('experiment');

    foreach ($row as $elem) {
        $children = $elem->childNodes;

        foreach ($children as $child) {
            if ($child->nodeName == 'igem_name') {

                $xmlresults[] = $child->nodeValue;
            }
            if ($child->nodeName == 'seq_name') {

                $xmlresults[] = $child->nodeValue;
            }

            if ($child->nodeName == 'antibio') {

                $xmlresults[] = $child->nodeValue;
            }
        }
    }
    
  
}

?>
