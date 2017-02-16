function validateFormRegister() {
	var str = "";
	var dni = document.forms["register-form"]["dni"].value;
	var dniStr = dni.toString();
	var telefono = document.forms["register-form"]["telefono"].value;

	if (isNaN(dni) || dni < 0 || dniStr.charAt(0) == "+" || dniStr.length!=8) {
		str += "El dni debe ser un numero entero positivo de 8 dígitos sin letra\n";
	}
	if (isNaN(telefono) || telefono < 0 || telefono.length < 9) {
		str += "El teléfono debe ser un número entero positivo de como mínimo 9 dígitos\n";
	}

	if (str != "") {
		alert(str);
		return false;
	}
}

function validateFormEmpresa(){
	var str = "";
	var cif = document.forms["register-form"]["cif"].value;
	var cifStr = cif.toString();
	var cifStrNumber = cifStr.substring(1, cifStr.length);
	var telefono = document.forms["register-form"]["telefono_contacto"].value;

	if (!cifStr.charAt(0).match(/[A-Z]/) || isNaN(cifStrNumber) || cifStrNumber <= 0 || cifStrNumber.charAt(0) == "+" || cifStrNumber.length!=8 ) {
		str += "El CFI debe ser una letra mayúscula seguida de 8 digitos\n";
	}
	if (isNaN(telefono) || telefono < 0 || telefono.length < 9) {
		str += "El teléfono debe ser un número entero positivo de como mínimo 9 dígitos\n";
	}

	if (str != "") {
		alert(str);
		return false;
	}
}

function validateFormReport(){
	var str = "";
	var cif = document.forms["report-form"]["cif"].value;
	var cifStr = cif.toString();
	var cifStrNumber = cifStr.substring(1, cifStr.length);

	if (!cifStr.charAt(0).match(/[A-Z]/) || isNaN(cifStrNumber) || cifStrNumber <= 0 || cifStrNumber.charAt(0) == "+" || cifStrNumber.length!=8 ) {
		str += "El CFI debe ser una letra mayúscula seguida de 8 digitos\n";
	}

	if (str != "") {
		alert(str);
		return false;
	}
}

function validateAsignarA(){
	var str = "";
	var dni = document.forms["asignar-empresa-form"]["dni"].value;
	var dniStr = dni.toString();

	if (isNaN(dni) || dni < 0 || dniStr.charAt(0) == "+" || dniStr.length!=8) {
		str += "El dni debe ser un numero entero positivo de 8 dígitos sin letra\n";
	}

	if (str != "") {
		alert(str);
		return false;
	}
}