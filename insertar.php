<?php 

	include("conexion.php");

	$exito= false;
	if ($_POST) {
		define('FOTOSDIR', 'imagenes/');
		$errores = '';
		

		$titulo = $_POST['titulo'];
		$director = $_POST['director'];
		$anio = $_POST['anio'];
		$duracion = $_POST['duracion'];
		$genero = $_POST['genero'];
		if (!empty($_FILES)) {
			$rutaFoto = FOTOSDIR . $_FILES['foto']['name'];
			if (!$_FILES['foto']['error']){
				if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaFoto)) {
						//Insertar datos en la base de datos
					$sql ="insert into peliculas (titulo, director, anio, duracion, genero, foto)values('$titulo', '$director', $anio, $duracion, $genero,'$rutaFoto')";

					
					if(mysqli_query($con,$sql)){
						$exito=true;
					
			}else{
				$errores .= 'Error al insertar datos' .mysqli_error($con);
			}
		}
		}else{
			$errores .= 'Error al subir la imagen';
			}
		}

	}
 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Insertar</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
	<?php 
	include("menu.php");

	 ?>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?> " method="post" enctype="multipart/form-data">
		<h1>Introduce los datos de la pelicula</h1>
		<label for="titulo">Título</label>
		<input type="text" name="titulo" id="titulo" placeholder="titulo" required>
		<label for="titulo">Director</label>
		<input type="text" name="director" id="director" placeholder="director">
		<label for="anio">Año</label>
		<input type="number" name="anio" id="anio" min="1900" max="2099" value="2019">
		<label for="duracion">Duración</label>
		<input type="number" name="duracion" id="duracion" min="30" max="240">(min.)
		<label for="genero">Género</label>

		<?php  include("combo.php"); ?>
		
		<label for="foto">Carátula</label>
		<input type="file" name="foto"><br>
		<input type="submit">
		<input type="reset" value="Borrar">

	</form>
	<option value=''></option>
	<?php 
	if (!empty($errores)) {
	 	echo "<div class='error'>$errores</div>";

	 } 
	 if ($exito) {
	 	echo "<div class='ok'>Los datos se han insertado correctamente</div>";
	 }
	 ?>


</body>
</html>