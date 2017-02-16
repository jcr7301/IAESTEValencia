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
			$GTArray = mysqli_query($conn,"SELECT grupo_trabajo FROM usuarios where dni='$_POST[dni]'");
			if (mysqli_num_rows($GTArray) == 1) {
				$rowGTArray = mysqli_fetch_assoc($GTArray);
				$GTString = $rowGTArray["grupo_trabajo"];

				if($GTString=='Sin asignar. Solicita un grupo de trabajo a tu Centro'){
					mysqli_query($conn,"UPDATE usuarios SET grupo_trabajo= '$_POST[GT]' where dni='$_POST[dni]'");
				}
				else{
					$GTString = $GTString . ', ' . $_POST['GT'];
					mysqli_query($conn,"UPDATE usuarios SET grupo_trabajo= '$GTString' where dni='$_POST[dni]'");
				} ?>
				<div class="mensaje-usuario">
					<div class="row">
						<div class="alert alert-dismissible alert-success col-md-4">
							<h3>Nuevo Grupo de Trabajo asignado con éxito!</h3>
						</div>
					</div>
				</div>
			<?php } ?>	
			<div class="mensaje-usuario">
				<a href="https://iaestevalencia.000webhostapp.com/" class="btn btn-success">Volver a la página principal</a>
				<!--<a href="../firstView.html" class="btn btn-success">Volver a la página principal</a>-->
			</div>
	<?php } mysqli_close($conn);?>

</body>
</html>