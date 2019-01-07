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

		<!-- First Grid -->
		<div class="w3-row w3-container w3-center">
			<div class="w3-quarter w3-container">
				<img src="../img/Avatar.png" style="width:100%">
				<a href="" class="w3-button w3-padding-large w3-xlarge w3-margin-top w3-grey w3-text-black w3-border-black">Cambiar Avatar</a>
				<br>
				<br>
			</div>
			<div class="w3-threequarter w3-container">
				<div class="w3-row w3-container">
					<div class="w3-twothird w3-container w3-left-align w3-large">

						<?php
							require ("../conexion.php");
							$ID=$_SESSION['username'];
							$conectar = conectar();
							if ($conectar) {
								$consulta = "select nombre, appaterno, apmaterno from usuario where $ID=idUsuario;";
								$nombre = mysqli_query($conectar,$consulta);
								$boleta = mysqli_query($conectar,"SELECT boleta from estudiante where idUsuario='" . $ID . "'");
								$result = mysqli_fetch_array($nombre);
								echo "<label>Nombre: ".$result['nombre']."   ".$result['appaterno']."   ".$result['apmaterno']."</label><br><br>";
								$result = mysqli_fetch_array($boleta);
								echo "<label>Boleta: ".$result['boleta']."</label>";
							}
							mysqli_close($conectar);
						?>

						<div class="w3-container">
							<hr>
							<div class="w3-center">
								<p w3-class="w3-large">Horas registradas</p>
							</div>
							<div class="w3-responsive w3-card-4">
								<table class="w3-table w3-striped w3-bordered">
									<thead>
										<tr class="w3-theme w3-black">
											<th>Nombre</th>
											<th>Descripción</th>
											<th>Horas</th>
										</tr>
									</thead>
									<tbody>

										<?php
											$conectar = conectar();
											if ($conectar) {
												$consulta = "select re.cantidadHora as horas, c.nombre as nombre, c.descripcion as descripcion from estudiante e, registrado_has_estudiante re, registrado r, club c where $ID=e.idusuario and e.idusuario=re.estudiante_idusuario and re.registrado_idclub=r.idclub and re.registrado_ideje=r.ideje and r.idclub=c.idclub and r.ideje=c.ideje;";
												$Registro = mysqli_query($conectar, $consulta);
												while($Ren = mysqli_fetch_array($Registro))
												{
													echo "<tr>";
													echo "<td>" . $Ren['nombre'] . "</td>";
													echo "<td>" . $Ren['descripcion'] . "</td>";
													echo "<td>" . $Ren['horas'] . "</td>";
													echo "</tr>";
												} 
												mysqli_free_result($Registro);
												mysqli_close($conectar);
											}
											
										?>

									</tbody>
								</table>
							</div>
							<hr>
						</div>
					</div>
					<dir class="w3-third">
						<div class="w3-container">
								<p class="w3-large">Créditos Completados</p>
							<div class="w3-light-gray w3-card">
								<div id="myBar" class="w3-center w3-padding w3-theme w3-light-blue w3-text-black" style="width:5%">5%</div>
							</div><br>
						</div>
						<div id="piechart" style="width: 400px; height: 500px;"><button class="w3-btn w3-theme" onclick="drawPieChart()">Desglosar</button></div>
						
						<div ></div>
					</dir>
				</div>
				<div class="w3-container">
					<hr>
					<div class="w3-center">
						<p w3-class="w3-large">Constancias registradas</p>
					</div>
					<div class="w3-responsive w3-card-4">
						<table class="w3-table w3-striped w3-bordered">
							<thead>
								<tr class="w3-theme w3-black">
									<th>Constancia</th>
									<th>Actividad</th>
									<th>Horas</th>
									<th>Créditos</th>
									<th>Ver</th>
									<th>Eliminar</th>
									<th>Cita</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Curso Inglés</td>
									<td>78</td>
									<td>4.3</td>
									<td>
										<a href="pathPDF" class="w3-button w3-red">PDF</a>
									</td>
									<td>
										<a href="queryDelete" class="w3-button w3-red">Delete</a>
									</td>
									<td>No requerida</td>
								</tr>
								<tr>
									<td>2</td>
									<td>Diplomado</td>
									<td>25</td>
									<td>2.2</td>
									<td>
										<a href="pathPDF" class="w3-button w3-red">PDF</a>
									</td>
									<td>
										<a href="queryDelete" class="w3-button w3-red">Delete</a>
									</td>
									<td>21/02/19</td>
								</tr>
							</tbody>
						</table>
					</div>
					<hr>
				</div>
			</div>
		</div>

<!-- Fill table with PHP

	<?php
		$connection = mysqli_connect('localhost', 'root', '', 'users');
	?>
	<html>
		<head></head>
		<body>
			<table name = "userDetails">
				<tr>
					<th>User ID</th>
					<th>First Name</th>
					<th>email</th>
				</tr>
				<?php
					$sql = "SELECT id, firstname,email FROM usertable";
					$result = mysqli_query($connection, $sql);
					if(mysqli_num_rows($result) > 0){
					while ($row = mysqli_fetch_assoc($result)) {
				?>
				<tr>
					<td>$row['id'];</td>
					<td>$row['firstname'];</td>
					<td>$row['email'];</td>
				</tr>
				<?php      
					}
					}
					else
					{
				?>
				<tr>
					<td colspan=3>Data is not available</td>
				</tr>
				<?php
					}
				?>
			</table>
		</body>
	<html/>
	
-->

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

		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		
		<script src="../js/main.js"></script>

	</body>
</html>
