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
	<?php }
	else{
		$cif_check = mysqli_query($conn, "SELECT * FROM empresas where cif='$_POST[cif]' and asignada_a='$_POST[dni]'");
		if (mysqli_num_rows($cif_check) == 1) {
			$row = mysqli_fetch_assoc($cif_check);
			if($row["enviada"]=='No'){
				mysqli_query($conn,"UPDATE empresas SET contacto='$_POST[persona_contacto]', participado='$_POST[participado]', interes='$_POST[interes]', conceden='$_POST[conceden]', motivo_no='$_POST[motivo_no]', enviada='Si' where cif='$_POST[cif]'");

				mysqli_query($conn,"UPDATE usuarios SET empresas_report=empresas_report+1, puntos=puntos+2 where dni='$_POST[dni]'");

				mysqli_close($conn);?>
				<div class="mensaje-usuario">
					<div class="row">
						<div class="alert alert-dismissible alert-success col-md-4">
							<h3>Report enviado con éxito!</h3>
						</div>
					</div>
				</div>	

			<?php }else{ ?>
				<div class="mensaje-usuario">
					<div class="row">
						<div class="alert alert-dismissible alert-danger col-md-4">
							<h3>Ya has enviado este report antes</h3>
						</div>
					</div>	
				</div>	
				<?php } ?>

		<?php }else{ ?>
			<div class="mensaje-usuario">
				<div class="row">
					<div class="alert alert-dismissible alert-danger col-md-4">
						<h3>El CIF es incorrecto o la empresa no te ha sido asignada</h3>
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