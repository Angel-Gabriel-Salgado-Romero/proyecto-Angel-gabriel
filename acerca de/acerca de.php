

<?php
    setcookie("chek", 1);
    if (isset($_POST['submit']))
    {
    	setcookie("vote", 1);
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="acerca de/acerca de.php">
	<title>Tienes algun problema con nuestros servicios?</title>
	<meta http-equiv="content-type">
</head>
<link rel="stylesheet" type="text/css" href="acerca de.css">
<link rel="stylesheet" type="text/css" href="acerca de">
<body>
	<h1>Cuentanos en que podemos ayudarte? </h1>
	<h3>¿Tienes algun inconveniente?</h3>
	<form action="<?php  echo $_SERVER['PHP_SELF']; ?>" method="post">
		<input type="radio" name="reply" value="0">
		Si,es un problema.<br>
		<input type="radio" name="reply" value="1">
		No mucho, es un pequeño error.<br>
		<input type="radio" name="reply" value="2">
		¡Bah!solo es una pregunta
		<br><br>
		<?php 
		if (empty($_POST['submit']) && empty($_COOKIE['voted']))
		{
			//Mostrar el boton submit solo si el formulario todavia
			//no se ha enviado y el usuario no ha votado.
		?>
		<input type="submit" name="submit" value="vota!">
		<?php
	} else
	{
		echo "<p>Gracias por tu voto.</p>\n";
		//¿Formulario enviado? ¿cookies activas? ¿pero totavia no se ha votado?
		if (isset($_POST['reply']) && isset($_COOKIE['check']) && empty($_COOKIE['voted'])) 
			{
				//Guardar nombre de archivo  en la variable
				$file="results.txt";
				$fp=fopen($file, "r+");
				$vote=fread($fp, filesize($file));
				//Descomponer la string del archivo en array con coma como separador
				$arr_vote =explode(",", $vote); //explode convierte la string en array
				//¿que valor se ha seleccionado en el formulario?
				//¡El recuento aumenta en 1!
				$reply = $_POST['reply'];
				$arr_vote[$reply]++;
				//volver a montar la string
				$vote =implode(",", $arr_vote); //implode vincula elementos de la arraya a string
				rewind($fp);
				//Escribir nueva stringen el  archivo
				fputs($fp, $vote);
				fclose($fp);
			}
		}
		?>
	</form>
	<p>
		[ <a href="results.php" target="_blank">Gracias por tu atencion, en un momento te atendemos</a>]
	</p>
<div>
				
				<a class="Volver" href="index.html">Pagina Inicial</a>

			</div>
</body>
</html>