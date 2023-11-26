<?php
session_start();
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: index.html');
    exit;
}

$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";

$conn = mysqli_connect($hostname, $username, $password, $db);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

#if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

$dni = $_SESSION['dniUsuario'];

// Consulta parametrizada para obtener asignaturas
$queryAsignaturas = "SELECT * FROM asignaturas WHERE dni = ?";
$stmtAsignaturas = $conn->prepare($queryAsignaturas);
$stmtAsignaturas->bind_param("s", $dni);
$stmtAsignaturas->execute();
$resultAsignaturas = $stmtAsignaturas->get_result();

if (!$resultAsignaturas) {
    die("Query failed: " . mysqli_error($conn));
}

// Consulta parametrizada para obtener datos del usuario
$queryUsuario = "SELECT nombre, apellidos FROM usuarios WHERE dni = ?";
$stmtUsuario = $conn->prepare($queryUsuario);
$stmtUsuario->bind_param("s", $dni);
$stmtUsuario->execute();
$resultUsuario = $stmtUsuario->get_result();

if ($resultUsuario) {
    $usuario = mysqli_fetch_assoc($resultUsuario);
} else {
    echo ("No se ha podido obtener los valores del usuario");
    header('Location: dashboard.php?error=modify_asignatura_failed');
    exit;
}

$asignaturas = array();
while ($row = mysqli_fetch_assoc($resultAsignaturas)) {
    $asignaturas[] = $row;
}

#} #else {
    #echo 'error en el token';
#}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Asignaturas</title>
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <div class="container-perfil">
        <span class="perfil">
            <?php echo $usuario['nombre']; ?>
            <?php echo $usuario['apellidos']; ?>
        </span>
    </div>

    <form action="logout.php">
        <button class="cerrar-sesion">Cerrar Sesion</button>
    </form>
    <!-- Formulario para Editar Usuario -->
    <form action="editar_usuario.php" method="POST">
        <button type="submit" class="edit-usuario">Editar Usuario</button>
    </form>

    <!-- Formulario para Añadir Asignatura -->
    <form action="anadir_asignatura.php" method="POST">
        <button type="submit" class="add-asignatura">Añadir Asignatura</button>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    </form>

    <div class="asignaturas-list">
        <?php foreach ($asignaturas as $asignatura): ?>
            <div class="container-asignatura">
                <span class="asignatura-name">
                    <?php echo htmlspecialchars($asignatura['nombre']); ?>
                </span>
                <span class="asignatura-description">
                    <?php echo htmlspecialchars($asignatura['descripcion']); ?>
                </span>
                <span class="text-creditos">Creditos:</span>
                <div class="container-creditos">
                    <span class="asignatura-creditos">
                        <?php echo htmlspecialchars($asignatura['creditos']); ?>
                    </span>
                </div>
                <span class="text-convocatorias">Convocatorias usadas:</span>
                <div class="container-convocatorias">
                    <span class="asignatura-convocatorias">
                        <?php echo htmlspecialchars($asignatura['convocatorias_usadas']); ?>
                    </span>
                </div>
                <span class="asignatura-actions">
                    <form action="edit_asignatura.php" method="post" class="edit_asignatura">
                        <input type="hidden" name="asignatura_id"value="<?php echo htmlspecialchars($asignatura['id']); ?>">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <button type="submit" class="edit-asignatura">
                            <img class="edit-icon" src="edit.png">
                        </button>
                    </form>
                    <form action="delete_asignatura.php" method="POST" class="delete-form"
                        onsubmit="return confirm('¿Seguro que quieres eliminar esta asignatura?');">
                        <input type="hidden" name="asignatura_id"
                            value="<?php echo htmlspecialchars($asignatura['id']); ?>">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <button type="submit" class="delete-asignatura"></button>
                    </form>
                </span>
            </div>
        <?php endforeach; ?>
    </div>
    <script src="script.js"></script>
</body>

</html>