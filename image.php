<?php
$name1=&$_POST['img1'];
$name2=&$_POST['img2'];

if($name1!='' and $name2!=''){
  $name1=str_replace('.png','',$name1);
  $name2=str_replace('.png','',$name2);
  $nbParents=count(explode('_',$name1))+count(explode('_',$name2));
  $name='../Pictures/'.$name1.'_'.$name2.'.png';
  $image1 = imagecreatefrompng('../Pictures/'.$name1.'.png');
  $image = imagecreate(74*$nbParents,20);
  imagecopymerge($image,$image1,0,0,0,0,imagesx($image1),20,100); 
  $image2 = imagecreatefrompng('../Pictures/'.$name2.'.png');
  imagecopymerge($image,$image2,imagesx($image1),0,0,0,imagesx($image2),20,100);  imagepng($image,$name);
echo $name;
}
?>
    