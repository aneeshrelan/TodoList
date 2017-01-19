$(document).ready(function(){

	// $("#login").show().addClass('animated flipInY');



	$("#registerBtn").click(function(){

		console.log('registerClicked');
		$("#login").hide();
		$("#register").show().addClass('animated flipInY');
		// $("#login").addClass('animated flipOutY',$("#register").show());
		
	
	});

	$("#loginBtn").click(function(){

		console.log('loginClicked');
		$("#register").hide();
		$("#login").show().addClass('animated flipInY');

	});


	$(".todo_delete").click(function(event){
		var parent = $(this).parents('li:first');
		var id = parent.data('id');

		console.log("Del: " + id);

		parent.hide('slow');
		event.stopPropagation();
	})

});
