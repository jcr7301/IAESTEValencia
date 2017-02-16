function cerrarSesion(){
	document.cookie = "user=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
	document.cookie = "pss=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
	document.cookie = "delegado=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
	document.location = "https://iaestevalencia.000webhostapp.com"
	//document.location = "https://iaestevalencia.000webhostapp.com/"
}