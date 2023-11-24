<?php
// phpinfo();
$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";


$conn = mysqli_connect($hostname, $username, $password, $db);
if (!$conn) {
	die("Database connection failed: " . mysqli_connect_error());
}

#function esPasswordSegura($password) {
    #return strlen($password) >= 8 && 
           #preg_match('/[A-Z]/', $password) && 
           #preg_match('/[a-z]/', $password) && 
           #preg_match('/[0-9]/', $password) && 
           #preg_match('/[\W]/', $password);
#}

#function esPasswordComun($password) {
    #$comunPasswords = file('WorstPasswordList.txt', FILE_IGNORE_NEW_LINES);
    #return in_array($password, $comunPasswords);
#}



$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$dni = $_POST['dni'];
$telefono = $_POST['telefono'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$email = $_POST['email'];
$password = $_POST['password'];


if (!(strlen($password) >= 8 && 
preg_match('/[A-Z]/', $password) && 
preg_match('/[a-z]/', $password) && 
preg_match('/[0-9]/', $password) && 
preg_match('/[\W]/', $password))) {
	#echo '<script type="text/javascript">window.alert("La contraseña debe tener al menos 8 caracteres y debe incluir al menos una letra mayúscula, una letra minúscula, un número y al menos un carácter especial");window.location.href = "register.html";</script>';
	echo "no es segura";
  }
 # if (esPasswordComun($password)) {
	  #echo '<script type="text/javascript">window.alert("La contraseña es muy común");window.location.href = "register.html";</script>';
	  #exit;
  #}
//GENERACIÓN DE HASH Y SALT PARA CADA REGISTRO DE USUARIO




$hashPassword = password_hash($password, PASSWORD_BCRYPT);

$consulta_dni = "SELECT * FROM usuarios WHERE dni = '$dni'";
$result_dni = mysqli_query($conn, $consulta_dni);

$consulta_email = "SELECT * FROM usuarios WHERE email = '$email'";
$result_email = mysqli_query($conn, $consulta_email);


if (mysqli_num_rows($result_dni) > 0 ) {
	echo "El DNI ya está en uso.";
	#echo '<script type="text/javascript">window.alert("El dni ya está en uso por otro usuario."); window.location.href = "register.html?error=email_in_use";</script>';
} elseif (mysqli_num_rows($result_email) > 0) {
	echo "El email ya está en uso.";
	#echo '<script type="text/javascript">window.alert("El correo electrónico ya está en uso por otro usuario."); window.location.href = "register.html?error=email_in_use";</script>';
	header('Location: register.html?error=email_in_use');
} else {


	$sql = "INSERT INTO usuarios (nombre, apellidos, dni, telefono, fechaNacimiento, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sssisss", $nombre, $apellidos, $dni, $telefono, $fechaNacimiento, $email, $hashPassword);



	if ($stmt->execute()) {
		#echo '<script type="text/javascript">window.alert("Registro exitoso"); window.location.href = "inicio.html";</script>';
		
		header('Location: inicio.html');
	} else {
		echo "No se consiguió el registro: " . $stmt->error;

	}

	$stmt->close();
}

$conn->close();
?>