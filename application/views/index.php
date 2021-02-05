<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
	<title><?php echo COMPANY_INTRANET;?></title>
	<link rel="shortcut icon" href="<?php echo base_url() ?>public/imgs/favicon.png" />
	<link rel="stylesheet" href="<?php echo base_url() ?>public/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>public/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>public/css/login.css">
	<style>
		.login
		{
			<?php 
				//$num = rand(1,9); 
				$num = 1;
			
			?>
			background-image: url(<?php echo base_url();?>public/imgs/login/bg0<?php echo $num;?>.jpeg);
			background-size: cover;
			background-position: center center;
			min-height:600px;
			padding:8% 13% 16.5%;
		}
	</style>
</head>
<body>
	<div class="row login">
		<div class="container">
			<div class="row">
				<div class="container-form col-md-offset-4 col-sm-4 col-xs-12 text-center">
					<h3 class="text-center portal-main text-button-shadow"><?php echo COMPANY_INTRANET;?></h3>
					<img src="<?php echo base_url(); ?>public/imgs/my-logo.jpeg" alt="<?php echo COMPANY_INTRANET;?>" width="75%">
					<form action="<?php echo base_url(); ?>login/checkLogin" method="POST" style="margin-top:50px;">
						<div class="form-group">
							<input type="text" name="login" class="form-control input-form login-input" placeholder="Login">
						</div>
						<div class="form-group">
							<input type="password" name="password" class="form-control input-form login-input" placeholder="Password">
						</div>
						<input type="submit" value="Login" class="text-button-shadow btn btn-primary btn-login btn-block">
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<p class="text-button-shadow" style="margin-top:10px;font-size:10px;color:rgba(255,255,255,0.75); text-align:center">
						<?php echo COMPANY_COPY; ?>
					</p>
				</div>
			</div>
		</div>
	</div>
</body>