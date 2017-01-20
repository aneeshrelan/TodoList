<?php $this->load->helper('form');

 ?>
<!DOCTYPE html>
<html>
<head>
<title>Login | TODOer</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>


  <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/todo.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">


  <script src="<?php echo asset_url(); ?>js/todo.js"></script>
<style type="text/css">

<?php echo ($this->session->flashdata('register')) ? "#login" : "#register"; ?>
{
	display: none;
}

</style>
<?php if($this->session->flashdata('success')){ ?>
<script type="text/javascript">
	$(document).ready(function(){

		Materialize.toast('Registration Successful',2000,'green');

	});
</script>
<?php } ?>
</head>
<body class="container teal lighten-1">
	<div class="row">
		<div class="col s6 offset-s3">
			<div id="login" class="login-form card-panel white center-align">
				<div  class="card-content center-align">
				<h1 class="flow-text teal-text">Hi, Login to Continue</h1>
					<img src="<?php echo asset_url();?>img/login.png" width="128" />
					<?php echo form_open('home/login'); ?>
					<?php if($this->session->flashdata('error')){ ?>
					<div class="row">
						<?php echo $this->session->flashdata('msg'); ?>
					</div>
					<?php } ?>
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
				<p class="center-align"><a class="teal-text waves-effect waves-light btn-flat" id="registerBtn">New User? Register</a></p>
				<button class="col s6 offset-s3 btn waves-effect waves-light" type="submit" name="login" value="login">Login</button>
				</div>
				<?php echo form_close(); ?>
				</div>

			</div>
		


		<div id="register" class="login-form card-panel white center-align">
				<div  class="card-content center-align">
				<h1 class="flow-text teal-text">Register to Start TODOing</h1>
					<img src="<?php echo asset_url();?>img/register.png" width="128" />
					<?php echo form_open('home/register'); ?>
					<div class="row left-align">
					<?php if($this->session->flashdata('register') && $this->session->flashdata('msg')){
						echo "<p class='red-text center-align'>" . $this->session->flashdata('msg') . "</p>";
						} ?>
					<?php if($this->session->flashdata('register') && $this->session->flashdata('register')){ echo $this->session->flashdata('fname');}?>	
						<div class="input-field col s12">
							<i class="material-icons prefix">account_circle</i>
							<input id="icon_prefix" name="fname" type="text" class="validate" required="required">
							<label for="icon_prefix">First Name</label>
						</div>
					

					<?php if($this->session->flashdata('register') && $this->session->flashdata('register')){ echo $this->session->flashdata('lname');}?>	
						<div class="input-field col s12">
							<i class="material-icons prefix">account_circle</i>
							<input id="icon_prefix" name="lname" type="text" class="validate" required="required">
							<label for="icon_prefix">Last Name</label>
						</div>
					

					<?php if($this->session->flashdata('register') && $this->session->flashdata('register')){ echo $this->session->flashdata('email');}?>	
						<div class="input-field col s12">
							<i class="material-icons prefix">email</i>
							<input id="icon_prefix" name="email" type="email" class="validate" required="required">
							<label for="icon_prefix" data-register="That doesn't look like an Email Address">Email</label>
						</div>
					

					<?php if($this->session->flashdata('register') && $this->session->flashdata('register')){ echo $this->session->flashdata('password');}?>	
						<div class="input-field col s12">
							<i class="material-icons prefix">vpn_key</i>
							<input id="icon_prefix" name="password" type="password" class="validate" required="required">
							<label for="icon_prefix">Password</label>
						</div>
					
					<?php if($this->session->flashdata('register') && $this->session->flashdata('register')){ echo $this->session->flashdata('cnfPassword');}?>	
						<div class="input-field col s12">
							<i class="material-icons prefix">vpn_key</i>
							<input id="icon_prefix" name="cnfPassword" type="password" class="validate" required="required">
							<label for="icon_prefix">Retype Password</label>
						</div>


				
				<p class="center-align"><a class="teal-text waves-effect waves-light btn-flat" id="loginBtn">Returning User? Login</a></p>
				<button class="col s6 offset-s3 btn waves-effect waves-light" type="submit" name="register" value="register">Register</button>
				</div>
				<?php echo form_close(); ?>
				
			</div>
		</div>

		</div>

	</div>
    
</body>
</html>