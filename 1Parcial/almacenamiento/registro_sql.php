<?php 
if (isset($_POST["registrar"])) {
	if (empty($_POST["correo_electronico"])) {
		echo "Favor de ingresar su correo para usarlo como usuario";
	}else{

		$usuario = filter_var(strtolower($_POST["correo_electronico"]), FILTER_SANITIZE_EMAIL);
		$password = (empty($_POST["password"])) ? "1234" : $_POST["password"];

		try {
			$conexion = new PDO('mysql:host=localhost;dbname=modelo','root','');
			$insercion = $conexion->prepare('INSERT INTO usuario (usuario,password) VALUES (:usuario, :password)');
			$insercion->execute(array(
				':usuario' => $usuario,
				':password' => $password
			));
			echo "Nuevo registro realizado con éxito";
		} catch (Exception $e) {
			echo "Error: ".$e->getMessage();
		}
	}
}
?>
