<!--
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
--> 

<?php
session_start ();
session_destroy(); 
session_unset();
?>
<!DOCTYPE html>
<html>
<head>
<title>Virtual LAB</title>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
   <link rel="stylesheet" type="text/css" href="config/style.css" />
</head>

<body>

<div id="global">

<header>
	<figure>
		<img src="Pictures/igem.jpg" alt="Virtua LAB" title="Welcome to Virtua-LAB !" />				
	</figure>
</header>
 <h1>Welcome to the Virtual-L.A.B. project </h1>	
 <div id="content">
<br>
		<section>
            <aside>
                <form class='bordure' method="post" action="connexion.php">	
					 <h1>Already registered</h1>
					<table>
					<tr>
					<td>   <label for="pseudo">Login :</label> </td>
					<td class='case' >  <input type="text" name="pseudo" id="pseudo" autofocus required/> </td>
					</tr>	
					<tr>
					<td>   <label for="team">Team :</label> </td>
					<td class='case'>   <input type="text" name="team" id="team" required/> </td>
					</tr>			
					<tr>
					<td>   <label for="pass">Password :</label> </td>
					<td class='case'>   <input type="password" name="pass" id="pass" required/> </td>
					</tr>			
					<tr>
					<td colspan="2"> <CENTER> <input type="submit" value="Connect" /> </td>
					</tr>
					</table>			
				</form>	
            </aside>
            <aside>  
                <form  class='bordure' method="post" action="signup_xml.php">	
					<h1>New member</h1>
					<table>
					<tr>
					<td> <label for="pseudo">Login :</label> </td>
					<td> <input type="text" name="pseudo" id="pseudo" required/>	</td>			
					</tr>
					
					<tr>
					<td> <label for="pass">Password :</label> </td>
					<td> <input type="password" name="pass" id="pass" required/> </td>
					</tr>
					
					<tr>
					<td> <label for="pass2">Re-enter your password :</label> </td>
					<td> <input type="password" name="pass2" id="pass" required/> </td>
					</tr>
					
					<tr>
					<td> <label for="mail">E-mail :</label> </td>
					<td> <input type="email" name="mail" id="mail" required />	</td>	 		
					</tr>
					
					<tr>
					<td> <label for="group">Group :</label> </td>
					<td> <input type="text" name="group" id="group" required/>	 </td>			
					</tr>	
					
					<tr>
					<td> <label for="team">Team :</label> </td>
					<td> <input type="text" name="team" id="team" required/>	 </td>			
					</tr>	
					
					<tr>			
					<td colspan="2"><CENTER><input type="submit" value="Sign Up" /> </td>
					</tr>
					</table>					
				</form>
            </aside>
        </section>
        <br>
</div>
<footer>Copyright &copy; IGEM - Bordeaux. All Rights Reserved <br>
    2013 <br>
    <a href="utils/about.php">about</a>
</footer>
</div>
</body>
</html>	
    </body>
</html>
