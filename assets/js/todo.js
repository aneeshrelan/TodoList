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


	$(document.body).on('click','.todo_delete',function(event){


		var parent = $(this).parents('li:first');
		var id = parent.data('id');

		console.log("Del: " + id);

		parent.hide('slow');
		event.stopPropagation();

	});

	$(document.body).on('change','.complete_check',function(event){

		var parent = $(this).parents('li:first');
		var id = parent.data('id');
		var value = 0;

		if ($(this).is(':checked'))
		{
			parent.addClass('completed');
			value = 1;
		}
		else
		{
			parent.removeClass('completed');
		}


		$.ajax({
			url: base_url + "completeToggle",
			type: 'post',
			dataType: 'text',
			data: {"id" : id, "val" : value},
			beforeSend: function(){$('.loader').show();},
			complete: function(){$('.loader').hide();},
			success: function(data)
			{
				console.log(data);
			}
		});


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
			url: base_url + "getTodo",
			dataType: 'json',
			beforeSend: function(){$('.loader').show();},
			complete: function(){$('.loader').hide();},
			success: function(data)
			{
				var ul = $('#todo_list');
			
				if(data.length > 0)
				{
					$('.card-options').addClass('animated bounceIn').show();
					$.each(data,function(index,element){

						var li = '<li ' + ((element.completed == 1) ? "class='completed'" : "") +  'data-id="' + element.id + '">';
						li += '<div class="collapsible-header">';
						li += '<input type="checkbox" id="' + index + '" class="complete_check"/>';
						li += '<label for="' + index + '">&nbsp;</label>';
						li += '<span class="todo_name">' + element.title + '</span>';
						li += '<span class="red-text todo_delete">';
						li += '<i class="material-icons">clear';
						li += '</i></span></div>';
						li += '<div class="collapsible-body"><p>' + element.description + '</p></div>';
						li += '</li>';

						
						$(li).hide().appendTo(ul).addClass('animated slideInDown').show();

					});

					ul.collapsible();
				}
				else
				{
					$('#footer-text').text("Empty TODO List");
					$('.card-footer').addClass('animated bounceIn').show();
				}
			}
		});
	}

	update();



});
