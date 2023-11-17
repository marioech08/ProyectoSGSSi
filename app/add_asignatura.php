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

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$creditos = $_POST['creditos'];
$convocatorias_usadas = $_POST['convocatorias_usadas'];
$dni = $_SESSION['dniUsuario'];
$año = $_POST['año'];

// Consulta parametrizada para insertar asignatura
$query = "INSERT INTO asignaturas (nombre, descripcion, creditos, convocatorias_usadas, año, dni) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssissi", $nombre, $descripcion, $creditos, $convocatorias_usadas, $año, $dni);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    header('Location: dashboard.php');
} else {
    echo "Error al añadir: " . $stmt->error;
}

$stmt->close();
mysqli_close($conn);
?>
