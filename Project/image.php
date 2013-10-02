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
    
$name1=&$_POST['img1'];
$name2=&$_POST['img2'];

if($name1!='' and $name2!=''){ //to get the name of the 2 biobricks
  $name1=str_replace('.png','',$name1);
  $name2=str_replace('.png','',$name2);

  $name='../Pictures/'.$name1.'_'.$name2.'.png';

  $image1 = imagecreatefrompng('../Pictures/'.$name1.'.png');
  $image2 = imagecreatefrompng('../Pictures/'.$name2.'.png');

  $size=imagesx($image1)+imagesx($image2);//calculate the image'slength
  $image = imagecreate($size,20);//and create this image

  imagecopymerge($image,$image1,0,0,0,0,imagesx($image1),20,100);  
  imagecopymerge($image,$image2,imagesx($image1),0,0,0,imagesx($image2),20,100); imagepng($image,$name);
echo $name;
}
?>
    
