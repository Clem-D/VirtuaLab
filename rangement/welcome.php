<!DOCTYPE html>
<html>
<head>
<title>Cahier de laboratoire</title>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
   <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

<div id="global">

<header>
	<figure>
		<img src="igem.jpg" alt="Photo de montagne" title="C'est beau les Alpes quand même !" />				
	</figure>
</header>
 <h1>Welcome to the M.A.E.V' project </h1>	
 <div id="content">

		<section>
            <aside>
                <form class='bordure' method="post" action="connection_xml.php">	
					 <h1>Already registered</h1>
					<table>
					<tr>
					<td>   <label for="pseudo">Login :</label> </td>
					<td class='case' >  <input type="text" name="pseudo" id="pseudo" autofocus required/> </td>
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
        <?php include("footer.php"); ?>		
    </body>
</html>
