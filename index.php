<?php 

	include("conexion.php");

	if (isset($_GET['id'])) {
		$sql="delete from peliculas where id= $_GET[id]";
		mysqli_query($con,$sql);
	}
	if (isset($_POST['filtro'])){
		$filtro = $_POST['filtro'];
		$director = $_POST['director'];
		$genero = $_POST['genero'];
		if($filtro == 'director'){
			$sql = "select p.id, p.titulo, p.director, p.anio, p.duracion,
			 		g.descripcion,p.foto 
			 		from peliculas p 
					join genero g on g.id = p.genero
					where p.director like '%$director%' ";
	
	}else if($filtro == "genero"){
		$sql="select p.id, p.titulo, p.director, p.anio, p.duracion,
		 	  g.descripcion, p.foto 
		      from peliculas p 
		      join genero g on g.id = p.genero
		      where p.genero = $genero ";
	}

	}else{
		$sql="select p.id, p.titulo, p.director, p.anio, p.duracion,
		 	  g.descripcion, p.foto 
		      from peliculas p 
		      join genero g on g.id = p.genero";

	}

	

	$resultado = mysqli_query($con,$sql);
 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Indice</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
	<?php 
	include("menu.php");

	 ?>

	 <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	 	<p>Filtrar por</p>
	 	<div>
	 	<input type="radio" name="filtro" value="director" id="director"><label for="director">Director</label><br>
	 	<input type="radio" name="filtro" value="genero" id="genero"><label for="genero">Género</label>
	 	</div>
	 	<p>Criterio de filtrado</p>
	 	<input type="text" name="director" placeholder="Director"><br>
	 	<?php include("combo.php");?> <br>
	 	<input type="submit" name="">
	 </form>

	<table>
		<tr>
			<th>Titulo</th>
			<th>Director</th>
			<th>Año</th>
			<th>Duracion</th>
			<th>Genero</th>
			<th>Caratula</th>
			<th>Modificar</th>
			<th>Eliminar</th>
		</tr>

		<?php 
			while($fila = mysqli_fetch_assoc($resultado)){
				echo "
					<tr>
						<td>$fila[titulo]</td>
						<td>$fila[director]</td>
						<td>$fila[anio]</td>
						<td>$fila[duracion]</td>
						<td>$fila[descripcion]</td>
						<td><a href='$fila[foto]' target='_blank'>Ver Caratula</a></td>
						<td> <a href='modificar.php?id=$fila[id]'>Modificar</a></td>
						<td> <a href='index.php?id=$fila[id]'>X</a></td>

					</tr>

				";
			}


		 ?>
		 <a href=""></a>

	</table>


</body>
</html>