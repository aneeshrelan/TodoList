$(document).ready(function(){



	$("#registerBtn").click(function(){



		$("p[class='red-text']").hide();
		$(document).attr("title", "Register | TODOer");
		$("#login").hide();
		$("#register").show().addClass('animated flipInY');
		
	
	});

	$("#loginBtn").click(function(){

		$(document).attr("title", "Login | TODOer");
		$("#register").hide();
		$("#login").show().addClass('animated flipInY');

	});

});