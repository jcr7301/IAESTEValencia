<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="../css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/postDelegadoLogIn.css" rel="stylesheet" />
<script src="../javascript/cerrarSesion.js"></script>
<script src="../javascript/validationForm.js"></script>
<script
	src="https://code.jquery.com/jquery-3.1.1.min.js"
	integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
	crossorigin="anonymous">
</script>
<script src="../javascript/jquery.tablesorter.min.js"></script>
<script>
$(document).ready(function() 
    { 
        $("#base_usuarios").tablesorter(); 
    } 
); 
$(document).ready(function() 
    { 
        $("#base_empresas").tablesorter(); 
    } 
); 
</script>

  
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

	//Conecta con la base de datos para obtener los datos del usuario y logearlo
	$conn = mysqli_connect($servername, $username, $password, $db);

	if(!$conn) { ?>
		<div class="row">
			<div class="alert alert-dismissible alert-danger col-lg-4">
	    		<h3>Ha habido algún problema con la base de datos. Ponte en contacto con el administrador por favor.</h3>
    		</div>
		</div>
	<?php } else {

		$result = mysqli_query($conn,"SELECT nombre, centro, grupo_trabajo, empresas_registradas, empresas_report, puntos, delegado FROM usuarios where dni='$_POST[dni_delegado]' and contrasena='$_POST[password_delegado]' and delegado='Si'");
		$datos_empresas_asignadas = mysqli_query($conn, "SELECT cif, nombre, especialidad, direccion, contacto, email, telefono FROM empresas where asignada_a='$_POST[dni_delegado]' and enviada='No'");
		$datos_usuarios=mysqli_query($conn, "SELECT * FROM usuarios");
		$datos_empresas=mysqli_query($conn, "SELECT * FROM empresas");

		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
	    	
			//Creamos cookies 
			$cookie_name = "pss";
			$cookie_value = "$_POST[password_delegado]";
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
			$cookie_name = "user";
			$cookie_value = "$_POST[dni_delegado]";
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
			setcookie('delegado', 'Si', time() + (86400 * 30), "/");
			?>
				<div container>
					<div class="row">
				      	<div class="col-lg-4 left-col col-lg-offset-1">
				        	<button type="button" class="btn btn-default btn-xs" onclick= "cerrarSesion()">Cerrar Sesión</button>
							<div class="panel panel-info">
				            	<div class="panel-heading">
				              		<h3 class="panel-title"><?php echo $row["nombre"]; ?></h3>
				            	</div>
				            	<div class="panel-body left-panel-body">
				              		<div class="row">
						                <div class=" col-lg-12 "> 
						                  <table class="table table-user-information">
						                    <tbody>
						                      <tr>
						                        <td>Centro:</td>
						                        <td><?php echo $row["centro"]; ?></td>
						                      </tr>
						                      <tr>
						                        <td>Grupo de trabajo:</td>
						                        <td><?php echo $row["grupo_trabajo"]; ?></td>
						                      </tr>
						                      <tr>
						                      	<td>Puntos:</td>
						                        <td><?php echo $row["puntos"]; ?></td>
						                      </tr>
						                      <tr>
						                        <td>Número de empresas registradas:</td>
						                        <td><?php echo $row["empresas_registradas"]; ?></td>
						                      </tr>
						                      <tr>
						                        <td>Número de reports enviados:</td>
						                        <td><?php echo $row["empresas_report"]; ?></td>
						                      </tr>
						                      <tr>
						                        <td>Empresas actualmente asignadas:</td>
						                        <td>
						                        	<div class="scroll-box-left">
														<?php $backgroundColor = '';
														if(mysqli_num_rows($datos_empresas_asignadas) > 0){ 
															while($row_datos_empresas_asignadas = mysqli_fetch_assoc($datos_empresas_asignadas)) {?>
																<div style = background-color:<?php echo $backgroundColor?>;>
																	<p>CIF: <?php echo $row_datos_empresas_asignadas["cif"]; ?></p>
																	<p>Nombre: <?php echo $row_datos_empresas_asignadas["nombre"]; ?></p>
																	<p>Especialidad: <?php echo $row_datos_empresas_asignadas["especialidad"]; ?></p>
																	<p>Persona de contacto: <?php echo $row_datos_empresas_asignadas["contacto"]; ?></p>
																	<p>Telefono: <?php echo $row_datos_empresas_asignadas["telefono"]; ?></p>
																	<p>Email: <?php echo $row_datos_empresas_asignadas["email"]; ?></p>
																	<p>Dirección: <?php echo $row_datos_empresas_asignadas["direccion"]; ?></p>
																</div>
																<p>---------------------------</p>
															<?php if($backgroundColor == ''){
																	$backgroundColor='#dde4e6';
																}else{
																	$backgroundColor='';
																}
															}
														} else {?>
															<p>Actualmente no tienes ninguna empresa asignada</p>
														<?php } ?>
													</div>
												</td>						                     
						                    </tbody>
						                  </table>
						                </div>
						            </div>
						        </div>			            
				            </div>
				        </div>
						<div class="col-lg-3">
							<h5>Registrar una nueva empresa</h5>
							<div class="panel panel-login">
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-12">
											<form id="register-form" action="postRegisterEmpresa_handler.php" onsubmit="return validateFormEmpresa()" method="post" role="form" style="display: block;">
												<div class="form-group">
									   				<input hidden type="text" id="dni" name="dni" value="<?php echo $cookie_value; ?>">
									   			</div>
												<div class="form-group">
													<input required type="text" name="nombre_empresa" id="nombre_empresa" tabindex="1" class="form-control" placeholder="Nombre de la empresa" value="">
												</div>
												<div class="form-group">
													<input required type="text" name="especialidad" id="especialidad" tabindex="1" class="form-control" placeholder="Especialidad que oferta la empresa" value="">
												</div>
												<div class="form-group">
													<input required type="text" name="cif" id="cif" tabindex="2" class="form-control" placeholder="CIF (Ej.: A22334455)" value="">
												</div>
												<div class="form-group">
													<input required type="text" name="direccion" id="direccion" tabindex="2" class="form-control" placeholder="Dirección de la empresa">
												</div>
												<div class="form-group">
													<input required type="text" name="persona_contacto" id="persona_contacto" tabindex="1" class="form-control" placeholder="Persona de contacto" value="">
												</div>
												<div class="form-group">
													<input required type="email" name="email_contacto" id="email_contacto" tabindex="1" class="form-control" placeholder="Email de contacto" value="">
												</div>
												<div class="form-group">
													<input required type="number" name="telefono_contacto" id="telefono_contacto" tabindex="1" class="form-control" placeholder="Teléfono de Contacto" value="">
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-sm-6 col-sm-offset-3">
															<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registrar">
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<h5>Enviar nuevo report de empresa</h5>
							<div class="panel panel-login">
								<div class="panel-body">
									<div class="row scroll-box-right">
										<div class="col-lg-12">
											<form id="report-form" action="postReportEmpresa_handler.php" method="post" onsubmit="return validateFormReport()" role="form" style="display: block;">
												<div class="form-group">
									   				<input hidden type="text" id="dni" name="dni" value="<?php echo $cookie_value; ?>">
									   			</div>
												<div class="form-group">
													<input required type="text" name="cif" id="cif" tabindex="2" class="form-control" placeholder="CIF (Ej.: A22334455)" value="">
												</div>
												<div class="form-group">
													<input required type="text" name="persona_contacto" id="persona_contacto" tabindex="1" class="form-control" placeholder="Persona de contacto" value="">
												</div>
												<div class="form-group">
													<label>Han participado anteriormente en IAESTE?</label>
													<select name="participado" class="form-control">
													    <option value="Si">Si</option>
													    <option value="No">No</option>
													    <option value="Desconocido">No lo sé</option>
													</select>
												</div>
												<div class="form-group">
													<label>Cuanto se ha interesado la empresa?</label>
													<select name="interes" class="form-control">
													    <option value=1>Ningún interés</option>
													    <option value=2>Vagamente interesados</option>
													    <option value=3>Han mostrado cierto interés</option>
													    <option value=4>Parecian bastante interesados</option>
													    <option value=5>Mucho interés</option>
													</select>
												</div>
												<div class="form-group">
													<label>Conceden Practica?</label>
													<select name="conceden" class="form-control">
													    <option value="Si">Si</option>
													    <option value="No">No</option>
													</select>
												</div>
												<div class="form-group">
													<label>En caso de que de que no concedan la práctica. Qué motivos han dado?</label>
													<input type="text" name="motivo_no" id="motivoNo" tabindex="2" class="form-control" value="">
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-sm-6 col-sm-offset-3">
															<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Enviar Report">
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>
						<div class="row">
							<div class="col-lg-12 bases">
								<div class="panel panel-primary">
									<div class="panel-heading">
								    	<h3 class="panel-title">Base de datos de usuarios</h3>
								    </div>
								    <div class="panel-body scroll-box-bases">
								    	<table id="base_usuarios" class="tablesorter table table-striped table-hover">
											  <thead>
											    <tr>
											      <th>Dni</th>
											      <th>Nombre</th>
											      <th>Email</th>
											      <th>Centro</th>
											      <th>Telefono</th>
											      <th>Experiencia en IAESTE</th>
											      <th>Empresas Registradas</th>
											      <th>Reports de empresas rellenados</th>
											      <th>Puntos</th>
											      <th>Grupo de trabajo</th>
											      <th>Es delegado?</th>
											      <th>Asignar nuevo Grupo de trabajo</th>
											      <th>Añadir puntos</th>
											    </tr>
											  </thead>
											  <tbody>
											  	<?php if(mysqli_num_rows($datos_usuarios) > 0){ 
														while($row = mysqli_fetch_assoc($datos_usuarios)) {?>
															<tr>
														      <td><?php echo $row["dni"]; ?></td>
														      <td><?php echo $row["nombre"]; ?></td>
														      <td><?php echo $row["email"]; ?></td>
														      <td><?php echo $row["centro"]; ?></td>
														      <td><?php echo $row["telefono"]; ?></td>
														      <td><?php echo $row["experiencia"]; ?></td>
														      <td><?php echo $row["empresas_registradas"]; ?></td>
														      <td><?php echo $row["empresas_report"]; ?></td>
														      <td><?php echo $row["puntos"]; ?></td>
														      <td><?php echo $row["grupo_trabajo"]; ?></td>
														      <td><?php echo $row["delegado"];

														      		if($row['delegado'] == 'No'){ ?>
														      		<form id="hacer-delegado-form" action="hacer-delegado_handler.php" method="post" role="form">
														      			<input type="hidden" name="dni" value="<?php echo $row['dni']; ?>">
														      			<input type="submit" style="width:95px;" name="hacer-delegado" id="hacer-delegado" value="Hacer delegado">
														      		</form>
														      		<?php } ?>
														      </td>
															  <td>
															  	<form id="asignar-GT-form" action="asignar-GT_handler.php" method="post" role="form">
														      		<input type="hidden" name="dni" value="<?php echo $row['dni']; ?>">
														      		<select name="GT">
																	    <option value="Marketing">Marketing</option>
																	    <option value="Redes Sociales">Redes Sociales</option>
																	    <option value="Summer">Summer</option>
																    </select>
																    <input type="submit" name="asignar-GT" id="asignar-GT" value="Asignar">
																</form>
															  </td>
															  <td>
															  	<form id="anadir-puntos-form" action="anadir-puntos_handler.php" method="post" role="form">
														      		<input type="hidden" name="dni" value="<?php echo $row['dni']; ?>">
																	<input type="text" name="nuevos_puntos" value="">
																    <input type="submit" name="anadir-puntos" id="anadir-puntos" value="Añadir">
																</form>
															  </td>
														    </tr>
													<?php }
												}?>
											  </tbody>
										</table>
								    </div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 bases">
								<div class="panel panel-primary">
									<div class="panel-heading">
								    	<h3 class="panel-title">Base de datos de empresas</h3>
								    </div>
								    <div class="panel-body scroll-box-bases">
								    	<table id="base_empresas" class="tablesorter table table-striped table-hover">
											  <thead>
											    <tr>
											      <th>CIF</th>
											      <th>Nombre</th>
											      <th>Especialidad</th>
											      <th>Direccion</th>
											      <th>Nombre de contacto</th>
											      <th>Email</th>
											      <th>Telefono</th>
											      <th>Registrada por</th>
											      <th>Ya ha sido contactada?</th>
											      <th>Ha participado anteriormente?</th>
											      <th>Nivel de interés que ha mostrado</th>
											      <th>Conceden práctica?</th>
											      <th>Motivo por el que no conceden práctica</th>
											      <th>Asignada a</th>
											      <th>Asignar a</th>
											    </tr>
											  </thead>
											  <tbody>
											  	<?php if(mysqli_num_rows($datos_empresas) > 0){ 
														while($row = mysqli_fetch_assoc($datos_empresas)) {?>
															<tr>
														      <td><?php echo $row["cif"]; ?></td>
														      <td><?php echo $row["nombre"]; ?></td>
														      <td><?php echo $row["especialidad"]; ?></td>
														      <td><?php echo $row["direccion"]; ?></td>
														      <td><?php echo $row["contacto"]; ?></td>
														      <td><?php echo $row["email"]; ?></td>
														      <td><?php echo $row["telefono"]; ?></td>
														      <td><?php echo $row["registrada_por"]; ?></td>
														      <td><?php echo $row["enviada"]; ?></td>
														      <td><?php echo $row["participado"]; ?></td>
														      <td><?php echo $row["interes"]; ?></td>
														      <td><?php echo $row["conceden"]; ?></td>
														      <td><?php echo $row["motivo_no"]; ?></td>
														      <td><?php echo $row["asignada_a"]; ?></td>
														      <td>
														      	<?php if($row['asignada_a'] == 'No asignada'){ ?>
															  	<form id="asignar-empresa-form" action="asignar-empresa_handler.php" onsubmit="return validateAsignarA()" method="post" role="form">
														      		<input type="hidden" name="cif" value="<?php echo $row['cif']; ?>">
																	<input type="number" name="dni" value="">
																    <input type="submit" name="asignar-empresa" id="asignar-empresa" value="Asignar">
																</form>
																<?php } ?>
															  </td>
														    </tr>
													<?php }
												}?>
											  </tbody>
										</table>
								    </div>
								</div>
							</div>
						</div>
					</div>
		    	<?php
			} else { ?>
			<div class="mensaje-usuario">
				<div class="row">
					<div class="alert alert-dismissible alert-danger col-lg-4">
			    		<h3>Usuario no registrado, no delegado o contraseña incorrecta</h3>
		    		</div>
				</div>
				<a href="https://iaestevalencia.000webhostapp.com/" class="btn btn-success">Volver a la página principal</a>
				<!--<a href="../firstView.html" class="btn btn-success">Volver a la página principal</a>-->
			</div>
			<?php } 
		} mysqli_close($conn); ?>
	</div>
</body>
</html>