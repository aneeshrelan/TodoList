$(document).ready(function(){

	// $("#login").show().addClass('animated flipInY');

	
	$('.modal-trigger').leanModal();

	 $('.datepicker').pickadate({
	 	container: 'body',
	 	selectMonths: true,
	 	selectYears: true,
	 	close : 'Ok',
	 	min: true
	 });

	$("#registerBtn").click(function(){

		$("p[class='red-text']").hide();
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

	});

	$(".todo_new_link").click(function(){

		$("#nutrition-facts").modal('open');

	});

	$("#todo_clear").click(function(){
		$("#newTodoForm")[0].reset();
	})

});
