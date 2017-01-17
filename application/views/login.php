<?php $this->load->helper('form'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login | TODO LISTer</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url();  ?>js/materialize.js"></script>
<script type="text/javascript" src="<?php echo asset_url(); ?>js/todo.js"></script>
<style type="text/css">


</style>
</head>
<body class="container teal lighten-1">
	<div class="row">
		<div class="col s6 offset-s3">
			<div class="login-form card-panel white center-align">
				<div id="login" class="card-content center-align">
				<h1 class="flow-text teal-text">Hi, Login to Continue</h1>
					<img src="<?php echo asset_url();?>img/login.png" width="128" />
					<?php echo form_open('home/login'); ?>
					<!-- <div class="row">
						<p class="red-text center-align">Invalid Email/Password combination.</p>
					</div> -->
					<div class="row left-align">
						<div class="input-field col s12">
							<i class="material-icons prefix">email</i>
							<input id="icon_prefix" name="email" type="email" class="validate" required="required">
							<label for="icon_prefix" data-error="That doesn't look like an Email Address" data-success="">Email</label>
						</div>
					</div>

					<div class="row left-align">
						<div class="input-field col s12">
							<i class="material-icons prefix">vpn_key</i>
							<input id="icon_prefix" name="password" type="password" class="validate" required="required">
							<label for="icon_prefix" data-error="A password is a must" data-success="">Password</label>
						</div>
					</div>

					<div class="row center-align">
						<p class="center-align">New User? Register</p>
					</div>
				<div class="row center-align">
				<button class="col s6 offset-s3 btn waves-effect waves-light" type="submit" name="login">Login</button>
				</div>
				<?php echo form_close(); ?>
				</div>

			</div>
		</div>
	</div>
    
</body>
</html>