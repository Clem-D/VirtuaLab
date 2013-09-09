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
$rubric='Biobricks';
$title='Add biobricks';
include("../utils/header.php");

if (isset($_POST['add'])){

  //save biobricks
  include('save_biobrick.php');     
  $name=$_POST['name'];
  $width=11;
  $size=strlen($name)*$width;
  if ($size < 100){
	$size=100;
	}
  // create biobricks' picture from biobricks' name
  //$direction='../Pictures/'.$name.'.png';  // $_SERVER['DOCUMENT_ROOT'].
  
  $direction='../Pictures/'. $igem_name . '-' . $antibio.'.png';   //new name (test)
  
    
  $image = imagecreate($size,20);             
  $white = imagecolorallocate($image, 255, 255, 255);
  $ligthBlue = imagecolorallocate($image, 156, 227, 254);
  $black = imagecolorallocate($image, 0, 0, 0);
  ImageLine($image,0,10,7,10,$black);
  ImageLine($image,$size-10,10,$size,10,$black);
  ImageFilledRectangle ($image,8,0,$size-10,20, $ligthBlue);
  ImageString($image,4,20,2,$name,$black); 
  imagepng($image,$direction);
} 
?>

<section>
<h1> Create a BioBrick </h1>

<form class='bordure' action='create.php' method='POST'>
    <label for='igem_name'>IGEM Name : <br> (ex : BBa_S01288 )</label></br>
    <input type='text' name='igem_name'/ required ></br></br>
    
    
     <label for='name'>Sequence Name : </label></br>
     <input type='text' name='name'/ required ></br></br>
    


    
    <label for='antibio'>Choose an Antibiotic :<br></label>
     <select name="antibio">
           <option value="AmpR">Ampicillin</option>
           <option value="KanR">Kanamycin</option>
           <option value="ChloR">Chloramphenicol</option>
           <option value="TetR">Tetracyclin</option>
                   
</select> </br></br>
    
        <label class='description' for='description'> Description : </label></br>
    <textarea name='description'></textarea>
    
    </br></br>

    
    

    <input type='submit' name='add' value='Add'/>
</form>
</section>
   
<?php include('../utils/footer.php');?>
