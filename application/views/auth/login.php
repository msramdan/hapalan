
<!doctype html>
<html lang="en" class="fullscreen-bg">
	
<!-- Mirrored from demo.thedevelovers.com/dashboard/klorofilpro-v1.6/html/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Feb 2019 02:56:33 GMT -->
<head>
		<title>Login | <?= $app_setting->nama_aplikasi ?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<!-- VENDOR CSS -->
		<link rel="stylesheet" href="<?= base_url() ?>admin/assets/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>admin/assets/vendor/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>admin/assets/vendor/themify-icons/css/themify-icons.css">
		<!-- MAIN CSS -->
		<link rel="stylesheet" href="<?= base_url() ?>admin/assets/css/main.min.css">
		<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
		<link rel="stylesheet" href="<?= base_url() ?>admin/assets/css/demo.min.css">
		<!-- ICONS -->
		<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>admin/assets/img/apple-icon.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url() ?>admin/assets/img/favicon.png">
	</head>
	<body>
		<!-- WRAPPER -->
		<div id="wrapper">
			<div class="vertical-align-wrap">
				<div class="vertical-align-middle">
					<div class="auth-box ">
						<div class="left">
							<div class="content">
								<div class="header">
									<div class="logo text-center">
										<img style="width: 100%" src="<?= base_url() ?>admin/assets/img/salam.png" alt="">
									</div>
									<p class="lead">Login to your account</p>
								</div>
								<form class="form-auth-small" action="<?= base_url() ?>auth/process" method="POST">
									<div class="form-group">
										<label for="signin-email" class="control-label sr-only">Username</label>
										<input type="text" class="form-control" id="signin-email" name="username" value="" placeholder="Username">
									</div>
									<div class="form-group">
										<label for="signin-password" class="control-label sr-only">Password</label>
										<input type="password" class="form-control" name="password" id="signin-password" value="" placeholder="Password">
									</div>
									<!-- <div class="form-group clearfix">
										<label class="fancy-checkbox element-left custom-bgcolor-blue">
											<input type="checkbox">
											<span class="text-muted">Show Password</span>
										</label>
									</div> -->
									<button type="submit" name="login" class="btn btn-primary btn-lg btn-block">LOGIN</button>
								</form>
							</div>
						</div>
						<div class="right">
							<div class="content text">
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- END WRAPPER -->
	</body>

<!-- Mirrored from demo.thedevelovers.com/dashboard/klorofilpro-v1.6/html/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Feb 2019 02:56:33 GMT -->
</html>