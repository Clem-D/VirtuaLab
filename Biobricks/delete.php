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
$title = 'Delete biobricks';
include("../utils/header.php");



if ( ( ( isset($_POST['igem_name']) ) and ($_POST['igem_name'] != "" ) )and ( ( isset($_POST['antibio']) ) and ( $_POST['antibio'] != "" ) ) ) {

    $antibio = $_POST['antibio'];
    $igem_name = $_POST['igem_name'];
    $check = check($antibio, $igem_name);

    if ($check) {
        shell_exec('rm XMLfiles/' . $igem_name . '-' . $antibio . '.xml');
        echo "<script>alert(\"The Biobrick was deleted.\")</script> ";
    } else {
        echo "<script>alert(\"This Biobrick doesn't exist !\\n        File not deleted.  \")</script> ";
    }
} 

?>
<section>
    <h1>Delete a biobrick</h1>

    <p>Choose what biobrick you want to delete.</p>

    <form class='bordure' action='delete.php' method='POST'>

        <label for='igem_name'>Type the IGEM Name : <br> (ex : BBa_S01288 )</label></br>
        <input type='text' name='igem_name'/ required></br></br>


        <label for='antibio'>And choose the antibiotic name : </label></br>
        <select name="antibio">
            <option value=""></option>
            <option value="AmpR">Ampicillin</option>
            <option value="KanR">Kanamycin</option>
            <option value="ChloR">Chloramphenicol</option>
            <option value="TetR">Tetracyclin</option>

        </select> </br></br>

        <input type='submit' name='add' value='Delete'/>
    </form>
</section>

<?php

include('../utils/footer.php');


//////////////////////////////////////
/////////// FUNCTIONS ///////////////
//////////////////////////////////////

function delete_row($dom, $name, $type) {
    $rows = $dom->getElementsByTagName('row'); // get all rows
    foreach ($rows as $row) {
        //print_r($row);
        $children = $row->childNodes; // on prend les enfants de chaque row
        foreach ($children as $child) {
            if (($child->nodeName == $type ) && ( $child->nodeValue == $name)) {
                $dom->documentElement->removeChild($row);
            }
        }
    }
    $dom->save('XMLfiles/biobricks.xml');
}

function check($antibio, $igem_name) {
    $querry = shell_exec('ls XMLfiles');

    $files = explode(".xml", $querry);

    foreach ($files as $elements) {
        $check = eregi($igem_name . '-' . $antibio, $elements);
        if ($check) {
            return true;
        }
    }
    return false;
}
?>
