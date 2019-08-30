<!DOCTYPE html>
<html lang="en">

<head>
<script src="js/jquery-3.4.1.min.js"></script>
<script>
	function validateLogin() {
		// Verifica o usuario
		var username = document.getElementById("username_login").value;
		if (username.length < 6) {
			document.getElementById("username_login_error").innerHTML = "Mínimo 6 caracteres.";
			return false;
		} else {
			document.getElementById("username_login_error").innerHTML = "";
		}
		// Verifica a senha
		var password = document.getElementById("password_login").value;
		if (password.length < 6) {
			document.getElementById("password_login_error").innerHTML = "Mínimo 6 caracteres.";
			return false;
		} else {
			document.getElementById("password_login_error").innerHTML = "";
		}
	}

	function validateSignUp() {
		// Verifica o usuario
		var username = document.getElementById("username_signup").value;
		if (username.length < 6) {
			document.getElementById("username_signup_error").innerHTML = "Mínimo 6 caracteres.";
			return false;
		} else {
			document.getElementById("username_signup_error").innerHTML = "";
		}
		// Verifica a senha
		var password = document.getElementById("password_signup").value;
		if (password.length < 6) {
			document.getElementById("password_signup_error").innerHTML = "Mínimo 6 caracteres.";
			return false;
		} else {
			document.getElementById("password_signup_error").innerHTML = "";
		}

		// Verifica a confirmação de senha
		var confirm_password = document
				.getElementById("confirm_password_signup").value;
		if (confirm_password.length < 6) {
			document.getElementById("confirm_password_signup_error").innerHTML = "Mínimo 6 caracteres.";
			return false;
		} else {
			document.getElementById("confirm_password_signup_error").innerHTML = "";
		}

		// Verifica coincidencia das senhas
		if (confirm_password != password) {
			document.getElementById("confirm_password_signup_error").innerHTML = "As senhas não se coincidem.";
			return false;
		} else {
			document.getElementById("confirm_password_signup_error").innerHTML = "";
		}
	}
</script>


<title>PHP Learning</title>


<link rel='stylesheet prefetch'
	href='https://fonts.googleapis.com/css?family=Open+Sans:600'>

<link rel="stylesheet" href="./assets/css/style.css">


</head>

<body>

<?php

include_once 'api/config/database.php';

// instantiate user object
include_once 'api/objects/user.php';

$database = new Database ();
$db = $database->getConnection ();

$user = new User ( $db );

if (isset($_POST['confirm_password'])){
	// set user property values
	$user->username = $_POST ['username'];
	$user->password = base64_encode ( $_POST ['password'] );
	$user->confirm_password = base64_encode ( $_POST ['confirm_password'] );
	
	if ($user->signup ()) {
		$user_arr = array (
				"status" => true,
				"message" => "Successfully Signup!",
				"id" => $user->id,
				"username" => $user->username
		);
	} else {
		$user_arr = array (
				"status" => false,
				"message" => "Username already exists!"
		);
	}
	var_dump(json_encode($user_arr));
}
?>

	<div class="login-wrap">
		<div class="login-html">

			<input id="tab-1" type="radio" name="tab" class="sign-in" checked>
			<label for="tab-1" class="tab">Entrar</label> 
			<input id="tab-2" type="radio" name="tab" class="sign-up">
			<label for="tab-2" class="tab">Cadastrar</label>

			<div class="login-form">
				<form class="sign-in-htm" action="./api/user/login.php"
					onsubmit="return validateLogin()" method="GET">
					<div class="group">
						<label for="user" class="label"><?php echo utf8_encode("Usuário") ?></label> <input
							id="username_login" name="username" type="text" class="input"
							required maxlength="25"> <span id="username_login_error"
							class="error"></span>
					</div>

					<div class="group">
						<label for="pass" class="label">Senha</label> <input
							id="password_login" name="password" type="password" class="input"
							data-type="password" required maxlength="15"> <span
							id="password_login_error" class="error"></span>
					</div>

					<div class="group">
						<input id="check" type="checkbox" class="check" checked> <label
							for="check"><span class="icon"></span> Salvar credenciais</label>
					</div>

					<div class="group">
						<input type="submit" class="button" value="Entrar">
					</div>

					<div class="hr"></div>
					<div class="foot-lnk">
						<a href="#forgot">Esqueceu a senha?</a>
					</div>
				</form>

				<form class="sign-up-htm" action="index.php"
					onsubmit="return validateSignUp()" method="POST">
					<div class="group">
						<label for="user" class="label"><?php echo utf8_encode("Usuário") ?></label> <input
							id="username_signup" name="username" type="text" class="input"
							required maxlength="25"> <span id="username_signup_error"
							class="error"></span>
					</div>

					<div class="group">
						<label for="pass" class="label">Senha</label> <input
							id="password_signup" name="password" type="password"
							class="input" data-type="password" required maxlength="15">
						<span id="password_signup_error" class="error"></span>
					</div>

					<div class="group">
						<label for="pass" class="label">Confirmar Senha</label> <input
							id="confirm_password_signup" name="confirm_password"
							type="password" class="input" data-type="password" required
							maxlength="15"> <span id="confirm_password_signup_error"
							class="error"></span>
					</div>

					<div class="group">
						<input type="submit" class="button" value="Cadastrar">
					</div>

					<div class="hr"></div>
					<div class="foot-lnk">
						<label for="tab-1"><?php echo utf8_encode("Já possui conta?") ?></label>
					</div>
				</form>
			</div>
		</div>
	</div>



</body>

</html>
