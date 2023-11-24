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
$dni = $_SESSION['dniUsuario'];

// Consulta parametrizada
$query = "SELECT nombre, descripcion, creditos, convocatorias_usadas, año FROM asignaturas WHERE id=? AND dni=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $asignatura_id, $dni);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    $asignatura = mysqli_fetch_assoc($result);
} else {
    echo ("No se ha podido obtener los valores");
    header('Location: dashboard.php?error=modify_asignatura_failed');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Asignatura - Plataforma de Asignaturas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1>Editar una asignatura</h1>
    <form action="modify_asignatura.php" method="post">
        <input type="hidden" name="asignatura_id" value="<?php echo htmlspecialchars($asignatura_id); ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required value="<?php echo htmlspecialchars($asignatura['nombre']); ?>">
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" required value="<?php echo htmlspecialchars($asignatura['descripcion']); ?>">
        <label for="creditos">Créditos:</label>
        <input type="text" id="creditos" name="creditos" required value="<?php echo htmlspecialchars($asignatura['creditos']); ?>">
        <label for="convocatorias_usadas">Convocatorias Usadas:</label>
        <input type="text" id="convocatorias_usadas" name="convocatorias_usadas" required value="<?php echo htmlspecialchars($asignatura['convocatorias_usadas']); ?>">
        <label for="año">Año:</label>
        <input type="text" id="año" name="año" required value="<?php echo htmlspecialchars($asignatura['año']); ?>">
        <button type="submit">Editar</button>
    </form>
</div>
</body>
</html>
