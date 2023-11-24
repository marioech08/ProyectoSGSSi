<?php
$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";

$conn = mysqli_connect($hostname, $username, $password, $db);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$dni = $_POST['dni'];

// Utilizando consultas preparadas para evitar inyección SQL
$query = "UPDATE usuarios SET nombre=?, apellidos=?, telefono=?, fechaNacimiento=? WHERE dni=?";
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sssss", $nombre, $apellidos, $telefono, $fechaNacimiento, $dni);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        header('Location: dashboard.php');
    } else {
        header('Location: dashboard.php?error=modify_asignatura_failed');
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error in preparing statement: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
