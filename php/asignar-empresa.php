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
			$checkDni = mysqli_query($conn,"SELECT * FROM usuarios where dni='$_POST[dni]'");
			$checkCif = mysqli_query($conn,"SELECT * FROM empresas where cif='$_POST[cif]'");
			$rowCheckCif = mysqli_fetch_assoc($checkCif);

			if (mysqli_num_rows($checkDni) == 1 && $rowCheckCif["asignada_a"] == 'No asignada') {
				mysqli_query($conn,"UPDATE empresas SET asignada_a= '$_POST[dni]' where cif='$_POST[cif]'"); ?>
				<div class="mensaje-usuario">
					<div class="row">
						<div class="alert alert-dismissible alert-success col-md-4">
							<h3>Empresa asignada con éxito!</h3>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<div class="mensaje-usuario">
					<div class="row">
						<div class="alert alert-dismissible alert-danger col-md-4">
			    			<h3>El DNI del usuario no existe o esa empresa ya está asignada. Prueba a asignarla de nuevo por favor</h3>
						</div>
					</div>
				</div>
			}
		<?php } ?>	
		<div class="mensaje-usuario">
			<a href="https://iaestevalencia.000webhostapp.com/" class="btn btn-success">Volver a la página principal</a>
			<!--<a href="../firstView.html" class="btn btn-success">Volver a la página principal</a>-->
		</div>
	<?php } mysqli_close($conn);?>

</body>
</html>