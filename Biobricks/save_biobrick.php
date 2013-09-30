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
ob_start();
$antibio = $_POST['antibio'];
$igem_name = $_POST['igem_name'];


$test = check($antibio, $igem_name);
if ($test) {
    echo "<script>alert(\"This Biobrick already exist !\\n         File not saved.  \")</script> ";
} else {
    save($antibio, $igem_name);
}

/////////////////////////////////////////////
/////////////// FUNCTIONS ////////////////
/////////////////////////////////////////////


function check($antibio, $igem_name) {
    $querry = shell_exec('ls XMLfiles');

    $files = explode(".xml", $querry);

    foreach ($files as $elements) {
        $check = eregi($igem_name . '-' . $antibio, $elements);  // maybe change it
        if ($check) {
            return true;
        }
    }
    return false;
}

function save($antibio, $igem_name) {

    $seq_name = $_POST['name'];
    $short_desc = $_POST['description'];
    $member_name = $_SESSION['pseudo'];


    $dom = new DOMDocument();
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    
    	$dom->version = '1.0';
	$dom->encoding = 'ISO-8859-1';   

// new tag  row
    $new_row = $dom->createElement('experiment');

	/*new tag <date> */
	$date = date('m/d/Y');
    $new_date = $dom->createElement('date');
	$date_content = $dom->createTextNode($date);
	$new_date->appendChild($date_content);



	// new tag seq_name
    $new_seq_name = $dom->createElement('seq_name');
    $seq_name_content = $dom->createTextNode($seq_name);
    $new_seq_name->appendChild($seq_name_content);



    // new itag gem_name
    $new_igem_name = $dom->createElement('igem_name');
    $igem_name_content = $dom->createTextNode($igem_name);
    $new_igem_name->appendChild($igem_name_content);


    // new antibio
    $new_antibio = $dom->createElement('antibio');
    $antibio_content = $dom->createTextNode($antibio);
    $new_antibio->appendChild($antibio_content);

	// new short_desc
    $new_short_desc = $dom->createElement('short_desc');
    $short_desc_content = $dom->createTextNode($short_desc);
    $new_short_desc->appendChild($short_desc_content);


    // new member name

    $new_member_name = $dom->createElement('member_name');
    $member_name_content = $dom->createTextNode($member_name);
    $new_member_name->appendChild($member_name_content);

    

// add children
    $new_row->appendChild($new_seq_name);
    $new_row->appendChild($new_igem_name);
    $new_row->appendChild($new_antibio);
    $new_row->appendChild($new_short_desc);
    $new_row->appendChild($new_member_name);
   $new_row->appendChild($new_date);


    $dom->appendChild($new_row);
    $dom->save('XMLfiles/' . $igem_name . '-' . $antibio . '.xml');
    
    shell_exec('chmod 777 XMLfiles/' . $igem_name . '-' . $antibio . '.xml');
    
    echo "<script>alert('Your Biobrick was successfully created.')</script>";
 

	header('Refresh:0.1; url=../rubrics/biobricks_index.php');  // refresh the page
    ob_flush();
    
}
?>


