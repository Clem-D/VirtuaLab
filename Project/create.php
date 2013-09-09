
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
$rubric='Project';
$title='Create a project';
include("../utils/header.php");
$team=$_SESSION['team'];
?>

	<section>
	<h1> Create a project </h1>
		<?php
		if ( isset($_POST['number']) && isset($_POST['name']) )
			{			  
			  $bricks = array(); 
			  $brickNames = array();
			  exec('ls ../Biobricks/XMLfiles',$elements);
			  foreach($elements as $element){
			    array_push($brickNames,str_replace('.xml','',$element));
			    $dom = new DOMDocument();
			    $dom->preserveWhiteSpace = false;
			    $dom->formatOutput = true;
			    $dom->load('../Biobricks/XMLfiles/'.$element);
			    $tags = $dom->getElementsByTagName('igem_name');
                            $name = $dom ->getElementsByTagName('team');
                            if ($tags->length == 0){
                                if ($name->item(0)->nodeValue==$team){
                                array_push($bricks,str_replace('.xml','',$element));
                                }
                            }
                            foreach ($tags as $tag) {
				    array_push($bricks,$tag->nodeValue);				    
                            }
			  }
			    ?>
			<form id='form' class='bordure' action='project_capture.php' method='POST'>
				<label for='name'> Project Name : </label></br>
				<input type='text' name='name' value="<?php echo $_POST['name']; ?>"/></br></br>
				
				<label for='number'> Number of BioBrick : </label></br>
				<input type='number' name='number' value="<?php echo $_POST['number'];?>" size="30" /></br></br>
					
				<?php 					
					$nb=$_POST['number'];					
					for ( $i=0; $i<$nb; $i++)
					{		
				?>		<label for="<?php echo($i); ?>"> <?php echo "BioBrick ".($i+1); ?>: </label></br>
                                                <select id='link' name=<?php echo $i ; ?> onchange="if(this.value=='create'){location.href='http://localhost/virtuLab/Biobricks/create.php'}">
                                                    <option value=''></option>
                                                <?php for($j=0; $j< count($bricks);$j++){
                                                      echo "<option value='".$brickNames[$j]."'>".$bricks[$j]."</option>";
                                                      if(isset($_POST[$i]) && $_POST[$i]==$brickNames[$j]) echo "selected";
                                             	}?>
					  <option value='create'>Create a biobrick</option>
                                                </select> </br></br> 
                          
                                <?php } ?>
				<input type='submit' name='add' value='Add'/>
			</form>
			<?php 
                        }
		if ( empty($_POST['number']) && empty($_POST['name']) ){
		?>
			<form class='bordure' action='create.php' method='POST'>
				<label for='name'> Project Name: </label></br>
				<input type='text' name='name'autofocus required/></br></br>
				
				<label for='number'> Number of BioBrick: </label></br>
				<input type='number' name='number' required/></br></br>
				
				<input id='submit' type='submit' name='add' value='OK'/>
			</form>
		<?php
		}
		?>
	</section>



<?php include('../utils/footer.php');?>