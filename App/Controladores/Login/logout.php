<?php
session_start();
// Destruye todas las variables de sesión
$_SESSION = array();
// Borra la cookie de sesión si se utiliza
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}
// Finalmente, destruye la sesión
session_destroy();
// Redirige al usuario a index.php
header("Location: ../../../Index.php");
exit;
