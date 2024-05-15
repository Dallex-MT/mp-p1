<?php
	if (session_status() == PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['CSRF'])) $_SESSION['CSRF'] = bin2hex(random_bytes(32));
	include_once("../security/Security.php");
    if(isset($_SESSION['role'])) Security::verifyUserType('login','');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
	<link href="../assets/img/logos/iconPage.webp" rel="icon">
    <link rel="stylesheet" href="../assets/css/loginStyle.css">
	<!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css'>
	<script src="../assets/js/phone.js"></script>
	<script src="../assets/js/password.js"></script>
</head>
<body>
    <div class="main">  	
		<input type="checkbox" checked id="chk" aria-hidden="true">
		<div class="signup">
			<form  id="register" method="post" action="../security/CRUD/Rest.php">
				<label for="chk" aria-hidden="true" class="register">REGISTRO</label>
				<input type="text" name="user"  id="user" placeholder="Usuario" required>
				<input type="email" name="email"  id="email" placeholder="E-Mail" required>
                <input type="tel" name="phone"  id="phone" maxlength="10" placeholder="Telefono" required>
				<input type="password" name="password" maxlength="16" id="password" placeholder="Contraseña" required>
				<span class="toggle-password0" onclick="togglePasswordVisibility(this)"><i class="fa fa-eye-slash"></i></span>
				<input type="password" name="password2" maxlength="16" id="password2" placeholder="Repita su contraseña" required>
				<span class="toggle-password2" onclick="togglePasswordVisibility(this)"><i class="fa fa-eye-slash"></i></span>
				<div class="mismatch">
					<p id="passwordMismatch">Las contraseñas no coinciden.</p>
				</div>
				<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['CSRF']; ?>">
				<input type="hidden" name="opcion" value="1">
				<button type="submit" id="btnRegister">Registrarse</button>
			</form>
		</div>
		
		<div class="login">
			<form id="login" method="POST" action="../security/CRUD/Rest.php">
				<label for="chk" aria-hidden="true">INGRESO</label>
				<input type="text" name="user" id="userLogin" placeholder="Usuario" required>
				<input type="password" name="password" maxlength="16" id="passwordLogin" placeholder="Contraseña" required>
				<span class="toggle-password0" onclick="togglePasswordVisibility(this)"><i class="fa fa-eye-slash"></i></span>
				<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['CSRF']; ?>">
				<input type="hidden" name="opcion" value="2">
				<button id="btnLogin" type="submit">Ingresar</button>
			</form>
		</div>
	</div>
</body>
</html>