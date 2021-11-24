<select name="genero">
			<?php 
				$sql = "select * from genero";
				$generos = mysqli_query($con,$sql);
				while ($fila = mysqli_fetch_assoc($generos)) {
					echo "<option value='$fila[id]'>$fila[descripcion]</option>";

				}



			 ?>
		</select>