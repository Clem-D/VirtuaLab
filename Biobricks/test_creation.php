<?php

$dom = new DOMDocument();

// version & encodage
$dom->version = '1.0';
$dom->encoding = 'ISO-8859-1';
        
$row = $dom->createElement('row');

$seq_name= $dom->createElement('seq_name', 'sequence');
$igem_name= $dom->createElement('igem_name', 'IGEM');
$antibio= $dom->createElement('antibio', 'TetR');
$short_desc= $dom->createElement('short_desc', 'OneDescription');
$groupe= $dom->createElement('member_groupe', '3');  // faudra rendre ça variable

// add children

$row -> appendChild($seq_name);
$row -> appendChild($igem_name);
$row -> appendChild($antibio);
$row -> appendChild($short_desc);
$row -> appendChild($groupe);


$dom -> appendChild($row);
$dom->formatOutput = true;
$dom->preserveWhiteSpace = false;


$igem_name_content="BBa_01205";

$antibio_content="TetR";
        
        
$dom->save('XMLfiles/'.$igem_name_content.'-'.$antibio_content.'.xml');

//$test=exec('ls XMLfiles/');
//$test=`ls XMLfiles`;
$test = shell_exec('ls XMLfiles');
//echo " OK ".$test."<br>  !!! ";
//echo ' <br>'.$test[2].'<br>';

$tab = explode(".xml", $test);
//$tab = reg_split('[:blank:]', $test);

echo " OK ".$test."<br>  !!! ";
//print_r($test);

//echo " $tab[0]";



foreach ($tab as $elements){
    $check = eregi($igem_name_content.'-'.$antibio_content,$elements);
    if ( $check ){
    echo " check vaut : ".$check;
    echo " et ça fait plaisir !!!";
    }
    echo  "--".$elements."<br>";
   
    
}

?>
