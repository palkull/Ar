<?php

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
        <form action="../Controladores/Login/Register.php" method="POST">
            <label> User </label>
            <input type="text" name="user" id="" placeholder="User">
            <br>
            <label>Email</label>
            <input type="text" name="email" id="" placeholder="Email">
            <br>
            <label for="">Password</label>
            <input type="password" name="pass" id="" placeholder="Password">
            <br>
            <label> Asignar Rol </label>
            <select name="rol" id="">
                <option value="1">Ayudante</option>
                <option value="2">Administrador</option>
            </select>
            <button type="submit">registrar</button>
        </form>
    </center>
</body>

</html>