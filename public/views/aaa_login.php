<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Aplikasi Ujian Online</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="description" content="Aplikasi Ujian Online berbasis web. Lebih Mudah dan Hemat, kayak AlfaMart">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<!-- <link href="<?php echo base_url(); ?>___/css/bootstrap.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="<?php echo base_url(); ?>___/css/style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Signika+Negative" rel="stylesheet">
	<style>
		body {
			font-family: 'Signika Negative', sans-serif;
		}
	</style>
</head>

<body>

	<div class="container">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<form action="" method="post" name="fl" id="f_login" onsubmit="return login();">
				<div class="panel panel-default top150">
					<div style="text-align:center; padding:10px; margin-bottom:20px;"><img src="https://i0.wp.com/smpit.nurulfikri.sch.id/wp-content/uploads/2015/10/logo-unit-SMP.png?fit=706%2C303&ssl=1" alt="NF" Width="200"></div>
					<div class="panel-heading" style="background-color:#2980b9; color:#fff;border-radius:0;">
						<h4 style="margin: 5px; text-align:center;">Login Aplikasi</h4>
					</div>
					<div class="panel-body">
						<div id="konfirmasi"></div>
						<div class="input-group">
							<span class="input-group-addon">@</span>
							<input type="text" id="username" name="username" autofocus value="" placeholder="Username" class="form-control" />
						</div> <!-- /field -->

						<div class="input-group top15">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="password" id="password" name="password" value="" placeholder="Password" class="form-control" />
						</div> <!-- /password -->
						<div class="login-actions">
							<button class="button btn btn-success btn-large col-lg-12 top15" style="padding:10px;">LOGIN</button>
						</div> <!-- .actions -->
					</div>
				</div> <!-- /login-fields -->


			</form>
		</div>
		<div class="col-md-4"></div>
	</div>

	<div class="ctr">
		<a href="<?php echo base_url(); ?>adm"><?php echo $this->config->item('nama_aplikasi') . " " . $this->config->item('versi'); ?></a>
	</div>

	<!-- <script src="<?php echo base_url(); ?>___/js/jquery-1.11.3.min.js"></script> 
<script src="<?php echo base_url(); ?>___/js/bootstrap.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js" integrity="sha512-ju6u+4bPX50JQmgU97YOGAXmRMrD9as4LE05PdC3qycsGQmjGlfm041azyB1VfCXpkpt1i9gqXCT6XuxhBJtKg==" crossorigin="anonymous"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript">
		base_url = "<?php echo base_url(); ?>";
		uri_js = "<?php echo $this->config->item('uri_js'); ?>";
	</script>
	<script src="<?php echo base_url(); ?>___/js/aplikasi.js"></script>
</body>

</html>