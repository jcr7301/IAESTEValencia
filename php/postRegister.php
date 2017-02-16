<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="../css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/firstViewCss.css" rel="stylesheet" />

</head>
<body>
	<?php
	$servername = "localhost";
	$username = "id208703_root";
	$password = "escarabajo44";
	$db = "id208703_iaestevalencia";

	//$servername = "localhost";
	//$username = "root";
	//$password = "";
	//$db = "iaeste";

	//Conecta con la base de datos para registrar al nuevo socio
	$conn = mysqli_connect($servername, $username, $password, $db);

	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());?>
	    <div class="mensaje-usuario">
		    <div class="row">
				<div class="alert alert-dismissible alert-danger col-md-4">
	    			<h3>Ha habido algún error al conectar con la base de datos. Ponte en contacto con el administrador por favor.</h3>
				</div>
			</div>	
		</div>
		<?php }else{
			$check_dni = mysqli_query($conn,"SELECT * FROM usuarios where dni='$_POST[dni]'");
			if(mysqli_num_rows($check_dni) > 0){?>
				<div class="mensaje-usuario">
					<div class="row">
						<div class="alert alert-dismissible alert-danger col-md-4">
			    			<h3>Ese usuario ya está registrado</h3>
						</div>
					</div>
				</div>
			<?php }else{
				mysqli_query($conn,"INSERT INTO usuarios (dni,nombre,email,centro,telefono,experiencia,contrasena) 
				VALUES ('$_POST[dni]','$_POST[username]','$_POST[email]','$_POST[centro]','$_POST[telefono]','$_POST[experiencia]','$_POST[password]')");?>
				<div class="mensaje-usuario">
					<div class="row">
						<div class="alert alert-dismissible alert-success col-md-4">
							<h3>Registro completado con éxito!</h3>
						</div>
					</div>
				</div>
				<?php }?>
				<div class="mensaje-usuario">
					<a href="https://iaestevalencia.000webhostapp.com/" class="btn btn-success">Volver a la página principal</a>
					<!--<a href="../firstView.html" class="btn btn-success">Volver a la página principal</a>-->
					</div>
	<?php } mysqli_close($conn);?>

</body>
</html>