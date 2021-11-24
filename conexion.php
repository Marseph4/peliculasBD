<?php 
	
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$name = 'multimedia';

	$con = mysqli_connect($host, $user, $pass, $name);
	if (!$con) {
		die('No se ha podido conectar a la base de datos' .mysqli_connect_error());
	}


 ?>