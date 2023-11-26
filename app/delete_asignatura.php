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
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {


    $asignatura_id = $_POST['asignatura_id'];
    $dni = $_SESSION['dniUsuario'];

    // Consulta parametrizada para eliminar la asignatura
    $query = "DELETE FROM asignaturas WHERE id = ? AND dni = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $asignatura_id, $dni);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        header('Location: dashboard.php');
    } else {
        header('Location: dashboard.php?error=delete_asignatura_failed');
    }

    $stmt->close();

} else {
    echo 'error en el token';
}
mysqli_close($conn);
?>