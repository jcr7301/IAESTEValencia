$(function() {

	function getCookie(cname) {
	    var name = cname + "=";
	    var ca = document.cookie.split(';');
	    for(var i = 0; i < ca.length; i++) {
	        var c = ca[i];
	        while (c.charAt(0) == ' ') {
	            c = c.substring(1);
	        }
	        if (c.indexOf(name) == 0) {
	            return c.substring(name.length, c.length);
	        }
	    }
	    return "";
	};

	var user = getCookie("user");
	user = unescape(user);
	var pss = getCookie("pss");
	pss = unescape(pss);
	var delegado = getCookie("delegado");

	if(user!="" && pss!="" & delegado=='Si'){

		$("#dni_delegado").val(user);
		$("#password_delegado").val(pss);
		$("#login-submit_delegado").click();
	}
	else if(user!="" && pss!="" & delegado=='No'){
		$("#dni").val(user);
		$("#password").val(pss);
		$("#login-submit").click();
	};
});