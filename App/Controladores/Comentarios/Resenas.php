<?php 
session_start();

include_once '../Config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar el valor del comentario del formulario
    $comentario = $_POST['comentario'];

    // Verificar si el comentario está vacío
    if (empty($comentario)) {
        echo 'No se pudo ejecutar';
        echo $comentario;
    } else {
        // Preparar la consulta SQL para eliminar el comentario
        $consulta = "DELETE FROM comments WHERE comment_id = :comentario";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(":comentario", $comentario, PDO::PARAM_INT); // Asegurarse de que el parámetro es un entero
        $stmt->execute();

        // Redirigir al usuario a index.php después de la eliminación
        header("Location: ../../../Index.php");
        exit(); // Asegurarse de que el script se detiene después de redirigir
    }
}
