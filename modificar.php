<?php  
	include("conexion.php");
	$exito = false;
	if(isset($_GET['id'])){
		$sql = "select id, titulo, director, anio, duracion, genero
				from peliculas where id= $_GET[id]";
		$resultado = mysqli_query($con, $sql);
		if(mysqli_num_rows($resultado) == 0){
			header('Location:index.php');
		}
		$fila = mysqli_fetch_assoc($resultado);
		$id = $fila['id'];
		$titulo = $fila['titulo'];
		$director = $fila['director'];
		$anio = $fila['anio'];
		$duracion = $fila['duracion'];
		$genero = $fila['genero'];

	}else if($_POST){
		$id = $_POST['id'];
		$titulo = $_POST['titulo'];
		$director = $_POST['director'];
		$anio = $_POST['anio'];
		$duracion = $_POST['duracion'];
		$genero = $_POST['genero'];
		
		$sql = "update peliculas set
				titulo = '$_POST[titulo]',
				director = '$_POST[director]',
				anio = $_POST[anio],
				duracion = $_POST[duracion],
				genero = $_POST[genero]
				where id = $_POST[id]";
		if(mysqli_query($con,$sql)){
			$exito = true;
		}else{
			$error = "Error al actualizar los datos " . mysqli_error($con);
		}
	}else{
		header('Location:index.php');
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Modificar</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
	<?php include("menu.php"); ?>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
		<input type="hidden" name="id" value="<?php echo $id ?>" >
		<h1>Introduce los datos de la película</h1>
		<label for="titulo">Título</label>
		<input type="text" name="titulo" id="titulo" value="<?php echo $titulo ?>">
		<label for="director">Director</label>
		<input type="text" name="director" id="director" value="<?php echo $director ?>">
		<label for="anio">Año</label>
		<input type="number" name="anio" id="anio" min="1900" max="2099" value="<?php echo $anio ?>">
		<label for="duracion">Duración</label>
		<input type="number" name="duracion" id="duracion" min="30" max="240" value="<?php echo $duracion ?>">
		<label for="genero">Género</label>
		<select name="genero" id="genero">
			<?php 
				$sql = "select * from genero";
				$generos = mysqli_query($con,$sql);
				while($fila = mysqli_fetch_assoc($generos)){
					$option ="<option value='$fila[id]' "; 

					if($genero == $fila['id']){
						$option .= "selected"; 
					}	
					$option .= ">$fila[descripcion]</option>";
					echo $option;
				}
			 ?>
		</select><br>
		<input type="submit" value="Modificar">
		<a href="index.php">Cancelar</a>
	</form>
	<?php 
		if($exito){
	 ?>
	 	<div class="ok">Los datos se han modificado correctamente</div>
	 <?php
	 	}else if(!empty($error)){

	   ?>
	   <div class="error"><?php echo $error ?></div>
	<?php } ?>

</body>
</html>