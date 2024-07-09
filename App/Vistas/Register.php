<?php
session_start(); // Start the session

// Check if the user is logged in (you can adjust this condition based on your authentication logic)

$isAdmin = isset($_SESSION['email']);

// Display the form or the admin button accordingly
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registra Usuario</title>
</head>

<body>
    <center>
        <?php if ($isAdmin): ?>
            <!-- Show the admin button -->
            <button>I am admin</button>
            <!-- Show the registration form -->
            <form action="../Controladores/Login/Register.php" method="POST">
                <label>User</label>
                <input type="text" name="user" placeholder="User">
                <br>
                <label>Email</label>
                <input type="text" name="email" placeholder="Email">
                <br>
                <label>Password</label>
                <input type="password" name="pass" placeholder="Password">
                <br>
                <label>Asignar Rol</label>
                <select name="rol">
                    <option value="1">Ayudante</option>
                    <option value="2">Administrador</option>
                </select>
                <button type="submit">Registrar</button>
            </form>
        <?php else: ?>
            <p>No tienes permiso de acceder</p>
        <?php endif; ?>
    </center>
</body>

</html>