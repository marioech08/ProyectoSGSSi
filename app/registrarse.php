<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Plataforma de Asignaturas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Registro en la Plataforma de Asignaturas</h1>
        
        <form id="registerForm" action="register.php" method="POST">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required placeholder="Escriba su nombre" required>
       

            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" placeholder="Escriba su apellido" required>


            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" placeholder="Ejemplo: 33974043F" required>


            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" placeholder="Ejemplo: 999999999" required pattern= "[0-9]{9}">


            <label for="fechaNacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fechaNacimiento" name="fechaNacimiento" placeholder="Escriba su fecha nacimiento en formato aaaa-mm-dd" required pattern= "\d{4}-\d{2}-\d{2}">


            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Escriba su correo en formato ejemplo@servidor.extensión" required pattern= "[a-zA-Z0-9]+@[a-zA-Z0-9]+.[a-zA-Z]{2.4}">


            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="Escriba una contraseña" required>

            <input type="hidden" name="csrf_token" value="<?php session_start(); echo $_SESSION['csrf_token']; ?>">
            
            <button type="submit">Registrarse</button>  
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>