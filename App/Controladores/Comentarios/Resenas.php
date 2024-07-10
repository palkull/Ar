<?php 
session_start();

include_once '../Config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comentario = $_POST['comentario'];

    if ($comentario == '') {
        echo'No se puedo ejecutar';
        echo $comentario;
    }else
    {
        $consulta = "DELETE FROM comments WHERE comment_id = :comentario";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(":comentario", $comentario);
        $stmt->execute();}

        header("../../../Index.php");

}