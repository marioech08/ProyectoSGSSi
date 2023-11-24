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

$asignatura_id = $_POST['asignatura_id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$creditos = $_POST['creditos'];
$convocatorias_usadas = $_POST['convocatorias_usadas'];
$año = $_POST['año'];
$dni = $_SESSION['dniUsuario'];

$query = "UPDATE asignaturas SET nombre=?, descripcion=?, creditos=?, convocatorias_usadas=?, año=? WHERE id=? AND dni=?";
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sssssss", $nombre, $descripcion, $creditos, $convocatorias_usadas, $año, $asignatura_id, $dni);
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
