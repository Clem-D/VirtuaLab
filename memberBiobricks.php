<?php
	session_start();
	include("header.php");
	echo "<section>";
//echo " WELCOME " .$_SESSION['pseudo'];
	$dom = new DOMDocument();
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->load('biobrick.xml');
 	$elements = $dom->getElementsByTagName('row');
 	$pseudo=$_SESSION['pseudo'];

 	$verif=false;
  	$result=array();
	$result=getBiobricks($elements,$pseudo,$dom);

	echo "<br><h1>".$_SESSION['pseudo']."'s Biobricks :</h1><br>
	<table class='tableau'>
	  	 <TR> 
 			<TH class='tableth' >Biobrick's name</TH> 
 			<TH class='tableth' >Biobrick's description</TH> 
 		</TR>";

	for ($i=0;$i<count($result);$i+=2){
		echo " <TR><TD class='tabletd' > ".$result[$i]. "</TD> <TD class='tabletd'>" .$result[$i+1]."</TD></TR> ";
 	}
	echo"</table>";
	echo "</section>";
 
 	include("footer.php"); 
 
//////////////////////////////////////////////////////////////////////
///// FUNCTIONS   //////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
function getBiobricks($elements,$member_id,$dom){ 	
 
	foreach ($elements as $elem){
		//echo " <br> et un element, un ! <br> ";
 		$children = $elem->childNodes;
 		foreach($children as $child){ 

			if ( $child->nodeName=="member_name"){
	 			$verif=false;
				if ($child->nodeValue==$member_id){
					$verif=true;
			
				}
			}
		}
		


		if ($verif==true){
			foreach($children as $child){ 
	
				if ( $child->tagName=='part_name'){
					//echo "<br> <br> LE NOM :  ".$child->nodeValue;
					$result[]=$child->nodeValue;
				}
			}
			foreach($children as $child){ 
	
				if ( $child->tagName=='short_desc'){
					//echo "<br> <br> La DESC :  :  ".$child->nodeValue;
					$result[]=$child->nodeValue;
				}
			}
		}
		
	}
	return $result;
}


?>
