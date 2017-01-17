<?php $this->load->helper('form'); ?><!DOCTYPE html>
<html>
<head>
	<title>Login | TODO LISTer</title>

	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

    <script type="text/javascript" src="<?php echo asset_url(); ?>js/todo.js"></script>


</head>
<body class="container teal lighten-1">
	<div class="row">
		<div class="col s6 offset-s3">
			<div class="login-form card-panel white center-align">
				<div class="card-content center-align">
				<h1 class="flow-text teal-text">Hi, Login to Continue</h1>
					<img src="<?php echo asset_url();?>img/login.png" width="128" />
					
					<div class="row left-align">
						<div class="input-field col s12">
							<i class="material-icons prefix">account_circle</i>
							<input id="icon_prefix" type="text" class="validate">
							<label for="icon_prefix">First Name</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>