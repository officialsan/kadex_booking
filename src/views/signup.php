<?php use Kadex\app\Auth; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="FooYes - Quality delivery or takeaway food">
	<meta name="author" content="Ansonika">
	<title>Kadex</title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="assets/img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="assets/img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="assets/img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="assets/img/apple-touch-icon-144x144-precomposed.png">

	<!-- GOOGLE WEB FONT -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/style.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
	<link href="assets/css/order-sign_up.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="assets/css/custom.css" rel="stylesheet">

</head>

<body id="register_bg">
	<input type="hidden" id="app-url" value="<?= APP_URL; ?>">
	<input type="hidden" id="login" value="<?= Auth::user() ? 1 : 0 ?>">
	<div id="register">
		<aside>
			<figure>
				<a href="<?= APP_URL; ?>">
					<img src="assets/img/logo_sticky.svg" width="140" height="35" alt="">
				</a>
			</figure>
			<!-- 
                <div class="access_social">
					<a href="#0" class="social_bt facebook">Register with Facebook</a>
					<a href="#0" class="social_bt google">Register with Google</a>
				</div>
            -->
			<!-- <div class="divider"><span>Or</span></div> -->
			<form action="<?= APP_URL; ?>/register" id="register-form" method="post" autocomplete="off">
				<input class="form-control" type="text" name="phone" value="<?= $_GET['m'] ??'' ?>">
				<div class="form-group">
					<input class="form-control" type="text" name="fname" placeholder="First Name">
				</div>
				<div class="form-group">
					<input class="form-control" type="text" name="lname" placeholder="Last Name">
				</div>
				<div class="form-group">
					<input class="form-control" type="email" name="email" placeholder="Email">
				</div>
				<div class="form-group">
					<label>Country</label>
					<select class="form-control" name="country">
						<option> Select a country</option>
						<?php foreach($countries  as $country) { ?>
						<option value="<?= $country['id'] ?>">
							<?= $country['country'] ?>
						</option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<input class="form-control" type="text" name="city" placeholder="City">
				</div>

				<div class="form-group">
					<input class="form-control" type="text" name="landmark" placeholder="Landmark">
				</div>
				<div class="form-group">
					<textarea class="form-control" type="text" name="address" placeholder="Address"></textarea>
				</div>
				<p class="error" id="register-submit-error"></p>
				<div id="pass-info" class="clearfix"></div>
				<div class="form-group text-center">
					<input type="submit" class="btn_1 gradient" value="Register Now!" id="submit-register">
				</div>
				<!-- <div class="text-center mt-2">
					<small>Already have an acccount?
						<strong>
							<a href="#0">Sign In</a>
						</strong>
					</small>
				</div> -->
			</form>
		</aside>
	</div>
	<!-- /login -->

	<!-- COMMON SCRIPTS -->
	<script src="assets/js/common_scripts.min.js"></script>
	<script src="assets/js/common_func.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

	<script src="assets/assets/validate.js"></script>

	<!-- SPECIFIC SCRIPTS -->
	<script src="assets/js/pw_strenght.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
	<script src="assets/js/san.js"></script>


</body>

</html>