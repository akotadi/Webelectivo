<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{

}
else 
{
	header("Location: ../index.html");
	exit;
}
$now = time();
if($now > $_SESSION['expire'])
{
	session_destroy();
	header("Location: ../index.html");	
}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>WebElectivo &mdash; Sistema de gestión de UAE</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" media="all" href="../NuevaCarpeta/styles.css" />
		<script src="http://code.jquery.com/jquery-latest.js"></script>
	</head>
	
	<style>
		body,h1,h2,h3,h4,h5,h6 {
			font-family: "Lato", sans-serif
		}
		.mySlides {
			display:none
		}
		.w3-tag, .fa {
			cursor:pointer
		}
		.w3-tag {
			height:15px;
			width:15px;
			padding:0;
			margin-top:6px
		}
		.w3-bar,h1,button {
			font-family: "Montserrat", sans-serif
		}
		.fa-anchor,.fa-coffee {
			font-size:200px
		}
	</style>
	
	<body>
		
		<!-- Navbar -->
		<div class="w3-top">
			<div class="w3-bar w3-wine w3-card w3-left-align w3-large">
				<a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-wine" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu">
					<i class="fa fa-bars"></i>
				</a>
				<a href="index.html" class="active w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Inicio</a>
				<div class="w3-dropdown-hover w3-right">
					<button class="w3-button w3-hide-small w3-padding-large">Panel de Control</button>
					<div class="w3-dropdown-content w3-card-4 w3-bar-block">
						<a href="constancia.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Subir Constancia</a>
						<a href="contrasenia.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Cambiar Contraseña</a>
						<a href="../index.html" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Cerrar Sesión</a>
					</div>
				</div>
				<a href="perfil.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right">Perfil</a>
				<a href="votaciones.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right">Votaciones</a>
				<div class="w3-dropdown-hover w3-right">
					<button class="w3-button w3-hide-small w3-padding-large">Clubes</button>
					<div class="w3-dropdown-content w3-card-4 w3-bar-block">
						<a href="inscribir.php?idclub=0" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Inscribir Club</a>
						<a href="clubes.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Ver Clubes</a>
						<a href="misclubes.php?idclub=0" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Mis Clubes</a>
					</div>
				</div>
				
			</div>

			<!-- Navbar on small screens -->
			<div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
				<a href="misclubes.php" class="w3-bar-item w3-button w3-padding-large">Clubes</a>
				<a href="votaciones.php" class="w3-bar-item w3-button w3-padding-large">Votaciones</a>
				<a href="perfil.php" class="w3-bar-item w3-button w3-padding-large">Perfil</a>
				<a href="../index.html" class="w3-bar-item w3-button w3-padding-large">Cerrar Sesión</a>
			</div>
		</div>

		<!-- Header -->
		<header class="w3-container w3-wine w3-center" >

			<div style="padding:50px">
				<img src="../img/HeaderFinal2.jpg" style="width:100%">
			</div>
		</header>

		<hr>

		<div class="w3-container">
			<p class="w3-jumbo w3-center">Subir Constancia</p>
		</div>

		<form id="upload" action="constancia.html" method="POST" enctype="multipart/form-data">
			<fieldset>
				<legend>HTML File Upload</legend>
				<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000" />
				<div>
					<label for="fileselect">Files to upload:</label>
					<input type="file" id="fileselect" name="fileselect[]" multiple="multiple" />
					<div id="filedrag">or drop files here</div>
				</div>
				<div id="submitbutton">
					<button type="submit">Upload Files</button>
				</div>
			</fieldset>

		</form>

		<div id="messages">
			<p>Status Messages</p>
		</div>

		<div class="w3-row-padding w3-container">
			<div class="w3-half w3-container">
				<p class="w3-large w3-left-align">Eje temático</p>


				<div class='w3-half w3-container'>

					<select name='destino'>";

					<?php
						$conectar = conectar();
						if ($conectar) {
							$consulta = "select ideje, descripcion from ejetematico;";
							$Registro = mysqli_query($conectar, $consulta);
							while($Ren = mysqli_fetch_array($Registro))
							{
								echo "<option value='$row[0]'> $row[0] - $row[1]</option>";
							} 
							mysqli_free_result($Registro);
							mysqli_close($conectar);
						}
						
					?>
					
					</select>
				</div>


				<div class="w3-dropdown-hover">
					<button class="w3-button w3-theme w3-black w3-text-white">Seleccionar <i class="fa fa-caret-down"></i></button>
					<div class="w3-dropdown-content w3-bar-block w3-border">
						<a href="#" class="w3-bar-item w3-button">Inquietudes vocacionales propias</a>
						<a href="#" class="w3-bar-item w3-button">Énfasis a la profesión</a>
						<a href="#" class="w3-bar-item w3-button">Complementarias a la profesión</a>
					</div>
				</div>
			</div>
			<div class="w3-half w3-container">
				<form class="w3-container w3-card-4">
					<p class="w3-large w3-left-align">Horas</p>
					<div class="w3-section w3-left-align">
						<input class="w3-input" type="text" required="">
						<label># Horas</label>
					</div>
					<br>
				</form>
			</div>
		</div>

		<hr>

		<div class="w3-row w3-center">
			<a href="index.html" class="w3-button w3-black w3-padding-large w3-large w3-margin-top">Subir Constancia</a>
		</div>

		<hr>

		<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
			<h1 class="w3-margin w3-xlarge">Cita del día: </h1>
			<p style="font-size: large;">“Puede que lo que hacemos no traiga siempre la felicidad, pero si no hacemos nada, no habrá felicidad”. (Albert Camus)</p>
		</div>

		<!-- Footer -->
		<footer class="w3-container w3-padding-64 w3-center w3-opacity">
			
			<!--
			<div class="w3-xlarge w3-padding-32">
				<i class="fa fa-facebook-official w3-hover-opacity"></i>
				<i class="fa fa-instagram w3-hover-opacity"></i>
				<i class="fa fa-snapchat w3-hover-opacity"></i>
				<i class="fa fa-pinterest-p w3-hover-opacity"></i>
				<i class="fa fa-twitter w3-hover-opacity"></i>
				<i class="fa fa-linkedin w3-hover-opacity"></i>
			</div>
			-->

			<p>Powered by <a href="https://www.facebook.com/chadcarreto" target="_blank">"El Chad"</a></p>
		</footer>


		<script src="../NuevaCarpeta/filedrag.js"></script>
		<script src="../js/main.js"></script>

	</body>
</html>
