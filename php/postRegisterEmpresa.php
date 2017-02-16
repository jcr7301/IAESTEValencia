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

	//Conecta con la base de datos para registrar una nueva empresa
	//dni de usuario obtenido mediante post del php 'postLogIn'
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
		<?php } else{
			
			$cif_check = mysqli_query($conn, "SELECT * FROM empresas where cif='$_POST[cif]'");
			if (mysqli_num_rows($cif_check) == 0) {

				mysqli_query($conn,"INSERT INTO empresas (cif, nombre, especialidad, direccion, contacto, email, telefono, registrada_por)
				VALUES ('$_POST[cif]','$_POST[nombre_empresa]','$_POST[especialidad]','$_POST[direccion]','$_POST[persona_contacto]','$_POST[email_contacto]','$_POST[telefono_contacto]','$_POST[dni]')");
				
				mysqli_query($conn,"UPDATE usuarios SET empresas_registradas=empresas_registradas+1, puntos=puntos+1 where dni='$_POST[dni]'");

				mysqli_close($conn);?>
				<div class="mensaje-usuario">
					<div class="row">
						<div class="alert alert-dismissible alert-success col-md-4">
							<h3>Empresa registrada con éxito!</h3>
						</div>
					</div>
				</div>

			<?php }else{ ?>
			<div class="mensaje-usuario">
				<div class="row">
					<div class="alert alert-dismissible alert-danger col-md-4">
						<h3>Empresa ya registrada. Intentalo con otra empresa por favor</h3>
					</div>
				</div>
			</div>
			<?php }
		}?>
		<div class="mensaje-usuario">
			<a href="https://iaestevalencia.000webhostapp.com/" class="btn btn-success">Volver a mi perfil</a>
			<!--<a href="../firstView.html" class="btn btn-success">Volver a mi perfil</a>-->
		</div>
</body>
</html>