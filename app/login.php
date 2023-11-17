<?php
session_start();

$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";

$conn = mysqli_connect($hostname, $username, $password, $db);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT email, password, dni FROM usuarios WHERE email = ?";
$state = $conn->prepare($query);
$state->bind_param("s", $email);
$state->execute();
$result = $state->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $storedPassword = $row['password'];

    // Verifica la contraseña ingresada utilizando password_verify
    if (password_verify($password, $storedPassword)) {
        // Contraseña válida, inicia la sesión
        $_SESSION['loggedIn'] = true;
        $_SESSION['dniUsuario'] = $row['dni'];
        header('Location: dashboard.php');
        exit;
    } else {
        // Contraseña incorrecta
        echo '<script type="text/javascript">window.alert("Contraseña incorrecta"); window.location.href = "inicio.html";</script>';
        exit;
    }
} else {
    // Correo electrónico incorrecto
    echo '<script type="text/javascript">window.alert("Correo electrónico incorrecto."); window.location.href = "inicio.html";</script>';
    exit;
}

$conn->close();
?>

