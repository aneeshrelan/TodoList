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


	$("ul#todo_list").delegate(".todo_delete","click",function(e){

		
		var parent = $(this).parents('li:first');

		$(parent).find('#collapsible-body').hide();
		var id = parent.data('id');
		
		$.ajax({
			url: base_url + "deleteTodo",
			type: 'post',
			dataType: 'text',
			data : {'id' : id},
			beforeSend: function(){$('.loader').show();},
			complete: function(){$('.loader').hide();},
			success: function(data)
			{
				if(data == 1)
				{
					
					parent.hide('slow').remove();
					
					var items = $("#todo_list li");
					var count = 0;
					items.each(function(){
						var li = $(this);
						if(li.is(':visible'))
						{
							count++;
						}
					});

					setTotal(count);
				}

				if($("#todo_list li").length == 0)
				{
					$('.card-options').hide();
					$('#footer-text').text("Empty TODO List");
					$('.card-footer').addClass('animated bounceIn').show();

				}


			}

		});		



	});

	$(document.body).on('change','.complete_check',function(event){

		var parent = $(this).parents('li:first');
		var id = parent.data('id');
		var value = 0;

		if ($(this).is(':checked'))
		{
			value = 1;
		}
		else
		{
			value = 0;
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
				
				if(data != 1)
				{
					Materialize.toast('Invalid Request',2000,'red');
				}
				else if(data == 1)
				{
					if(value == 1)
					{
						parent.addClass('completed');
					}
					else
					{
						parent.removeClass('completed');
					}
				}
				

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

						var date = new Date(element.deadline);
						var monthNames = ["January", "February", "March", "April", "May", "June",
  										  "July", "August", "September", "October", "November", "December"];
						var deadline = date.getDate() + " " + monthNames[date.getMonth()]  + ", " + date.getFullYear();
						var li = '<li ' + ((element.completed == 1) ? "class='completed'" : "") +  'data-id="' + element.id + '">';
						li += '<div class="collapsible-header">';
						li += '<input type="checkbox" ' + ((element.completed == 1) ? "checked='checked'" : "") + ' id="' + index + '" class="complete_check"/>';
						li += '<label for="' + index + '">&nbsp;</label>';
						li += '<span class="todo_name">' + element.title + '</span>';
						li += '<span class="red-text todo_delete">';
						li += '<i class="material-icons">clear';
						li += '</i></span></div>';
						li += '<div class="collapsible-body"><p>' + element.description + '</p>';
						li += '<div class="todo_options">';
						li += '<span class="options_deadline">Deadline: ' + deadline + '</span><span class="options_edit"><a>Edit</a></span></div>';
						li += '</div></li>';

						
						$(li).hide().appendTo(ul).addClass('animated slideInDown').show();

					});
					setTotal(data.length);
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



	$('.show_options span').on('click',function(){

		var option = $(this);

		if(option.hasClass('show_all'))
		{
			option.addClass('active');
			$('.show_pending').removeClass('active');
			$('.show_completed').removeClass('active');
			showAllItems();
		}
		else if(option.hasClass('show_pending'))
		{
			option.addClass('active');
			$('.show_all').removeClass('active');
			$('.show_completed').removeClass('active');
			showPendingItems();
		}
		else if(option.hasClass('show_completed'))
		{
			option.addClass('active');
			$('.show_all').removeClass('active');
			$('.show_pending').removeClass('active');
			showCompleted();
		}

	});

	function showAllItems()
	{
		var items = $("#todo_list li");

		items.each(function(){
			var li = $(this);
			li.show(500);
		})

		setTotal(items.length);
		
	}

	function showPendingItems()
	{
		var items = $('#todo_list li');
		var count = 0;
		items.each(function(){
			var li = $(this);

			if(li.hasClass('completed'))
			{
				li.hide(500);
			}
			else
			{
				count++;
				li.show(500);
			}

		});

		setTotal(count);
		countItems();
	}

	function showCompleted()
	{
		var items = $('#todo_list li');
		var count = 0;
		items.each(function(){
			var li = $(this);

			if(!li.hasClass('completed'))
			{
				li.hide(500);
			}
			else
			{
				count++;
				li.show(500);
			}

		});
		setTotal(count)
	}

	function setTotal(val)
	{
		$('.total_value').text(val + ' item' + ((val > 1) ? "s" : ""));
	}



	$(document.body).on('click','.options_edit',function(){

		var parent = $(this).parents('li:first');
		var id = parent.data('id');

		var title = $(parent).find('.todo_name').text();
		var descr = $(parent).find('.collapsible-body p').text();
		var deadline = $(parent).find('.options_deadline').text();

		var modal = $("#todo_edit");

		$(modal).find("#todo_id").val(id);
		$(modal).find('#todo_title').val(title);
		$(modal).find("#todo_descr").val(descr);
		$(modal).find("#todo_deadline").val(deadline.split(':')[1].trim());
		Materialize.updateTextFields();

		modal.openModal();

	});


	$('.logout a').click(function(){

		window.location.href = base_url + "logout";

	});

	$('.mark_all').click(function(){
		alert('h');

	});


});
