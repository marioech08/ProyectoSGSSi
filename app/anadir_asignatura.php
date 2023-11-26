<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Asignatura - Plataforma de Asignaturas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Añadir una asignatura</h1>
        
        <form action="add_asignatura.php" method="POST" enctype="multipart/form-data">   
           
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="descripcion">Descripcion:</label>
            <input type="text" id="descripcion" name="descripcion" required>

            <label for="creditos">Creditos:</label>
            <input type="text" id="creditos" name="creditos" required>

            <label for="convocatorias_usadas">Convocatorias Usadas:</label>
            <input type="text" id="convocatorias_usadas" name="convocatorias_usadas" required>
            
            <label for="año">Año:</label>
            <input type="text" name="año" id="año" required>

            <input type="hidden" name="csrf_token" value="<?php session_start(); echo $_SESSION['csrf_token']; ?>">

        
            <button type="submit">Añadir</button>
        </form>
    </div>
</body>
</html>

