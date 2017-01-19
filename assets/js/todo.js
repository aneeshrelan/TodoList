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

	function update()
	{
		$.ajax({
			url: base_url,
			dataType: 'json',
			beforeSend: function(){$('.loader').show();},
			complete: function(){$('.loader').hide();},
			success: function(data)
			{
				var ul = $('#todo_list');
				ul.html("");
				if(data.length > 0)
				{
					$.each(data,function(index,element){

						var li = "<li data-id='" + element.id + "'>";
						li += '<div class="collapsible-header">';
						li += '<input type="checkbox" id="' + index + '" />';
						li += '<label for="' + index + '">&nbsp;</label>';
						li += '<span class="todo_name">' + element.title + '</span>';
						li += '<span class="red-text todo_delete">';
						li += '<i class="material-icons">clear';
						li += '</i></span></div>';
						li += '<div class="collapsible-body"><p>' + element.description + '</p></div>';
						li += '</li>';


						addToList('todo_list',li);

					});
				}
				else
				{
					$('#footer-text').text("Empty TODO List");
					$('.card-footer').addClass('animated bounceIn').show();
				}
			}
		});
	}

	function addToList(listName, listItemHTML)
	{
		$(listItemHTML).hide().appendTo('#' + listName).addClass('animated fadeIn').show();
	}

	// update();



});
