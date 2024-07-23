<?php
include '../Config/config.php';

$id = $_GET['product_id'];
try {
   $conexion->beginTransaction();
   $sql = 'DELETE FROM products WHERE product_id = :categoria';
   $stmt = $conexion->prepare($sql);
   $stmt->bindParam(":categoria", $id);
   $stmt->execute();
   $conexion->commit(); // Confirma la transacción
   echo "Producto y sus imágenes eliminadas correctamente.";

} catch (PDOException $e) {
   $conexion->rollBack(); // Revierte la transacción en caso de error
   echo "Error al eliminar el producto: " . $e->getMessage();
}


