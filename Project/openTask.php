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
?>

<script>
function changeNumber($_number){
    var number = document.getElementById('nbExperiment');
    number.value = $_number;
}
</script>

<?php
  //function to create a new form when the user click on "new experiment"
function writeInfo($_number,$_date,$_technician,$_method,$_antiB,$_comments,$_progress,$_bool){
    echo "<form id='details' method='POST' action='saveTask.php'>
        <h3> Experiment ".$_number."</h3></br>
            <input type='hidden' name='hide' value=$_number>
          <label for='date'> Date : </label>
          <input type='text' name='date' ";
          if ($_bool==false) echo "readonly";
          echo" value=$_date></br></br>
              
          <label for='technician'> Laboratory technician : </label>
          <input type='text' name='technician' ";
          if ($_bool==false) echo "readonly";
          echo" value=$_technician></br></br>
          
          <label for='method'> Method : </label>
          <input type='text' name='method' ";
          if ($_bool==false) echo "readonly";
          echo" value=$_method></br></br>
          
          <label for='antiB'> Antibiotic(s) : </label>
          <select name='antiB'";
          if ($_bool==false) echo "disabled";
          echo">
            <option value='AmpR'";
            if ($_antiB == 'AmpR') echo 'selected';
           echo ">Ampicillin</option><option value='KanR'";
            if ($_antiB == 'KanR') echo 'selected';
           echo ">Kanamycin</option><option value='ChloR'";
            if ($_antiB == 'ChloR') echo 'selected';
           echo ">Chloramphenicol</option><option value='TetR'";
            if ($_antiB == 'TetR') echo 'selected';
          echo ">Tetracyclin</option></select></br></br>
              
          <label for='comments'> Annotations : </label>
          <textarea";
          if ($_bool==false) echo " readonly='readonly'";
          echo">$_comments</textarea></br></br>
              
          <label for='progress'> Succeed : </label>
          <input type='radio' name='progress' value='yes'";
          if ($_progress=='yes') echo 'checked'; 
          elseif ($_bool==false) echo "disabled";
          echo "/> Yes
          <input type='radio' name='progress' value='no'";
          if ($_progress=='no') echo 'checked'; 
          elseif ($_bool==false) echo "disabled";
          echo "/> No</br></br>";
          
}

$dom = new DOMDocument();
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;

$dom->load('../Biobricks/XMLfiles/'.$title.'.xml');

$experiments = $dom ->getElementsByTagName('experiment');
foreach ($experiments as $element){
    $child = $element->childNodes;
    
    //we get saved informations about this task
    foreach ($child as $children){
        if($children->nodeName == 'number'){
            $number = $children->nodeValue;
        }
        elseif ($children->nodeName == 'date'){
            $date = $children->nodeValue;
        } 
        elseif ($children->nodeName == 'technician'){
            $technician = $children->nodeValue;
        }  
        elseif ($children->nodeName == 'method'){
            $method = $children->nodeValue;
        } 
        elseif ($children->nodeName == 'antibiotic'){
            $antiB = $children->nodeValue;
        }  
        elseif ($children->nodeName == 'short_desc'){
            $comments = $children->nodeValue;
        }  
        elseif ($children->nodeName == 'succeed'){
            $progress = $children->nodeValue;
        }     
    }
    
    //we wrote them on the page
    if($progress == ''){
        writeInfo($number,$date,$technician,$method,$antiB,$comments,$progress,true);        
         echo "
          <script> changeNumber(".$number.") </script>
          <input type='submit' value='Save'>
          </form>";
    }
    else{
        //if the experiment is already done
        writeInfo($number,$date,$technician,$method,$antiB,$comments,$progress,false);
        echo "
            <script> changeNumber(".$number.") </script>
            </form>";
    }
        
    
    
}

?>
