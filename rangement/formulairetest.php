<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
$_SESSION['derniereaction'] = time();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<center>
<html>
<head>
<title>Cahier de laboratoire</title>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
   <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

<?php
	include("header.php");
	include("nav.php");
?>

	<section>
	<h1> Création d'une BB</h1>
	<h1>Bienvenue
		<?php echo $_SESSION['pseudo'];	?></h1>		

		<form class='bordure' action='saisie_biobricks.php' method='POST'>
			<label for='name'> Nom de la BB : </label></br>
			<input type='text' name='name'/></br></br>
			
			<label for='number'> Description : </label></br>
			<input type='text' name='description'  /></br></br>
			
			<input type='submit' name='add' value='OK'/>
		</form>
	</section>
   

</body>
</html>
