<?php
$host = 'localhost'; // o la dirección de tu servidor MySQL
$usuario = 'root'; // tu usuario de MySQL
$contraseña = ''; // tu contraseña de MySQL
$base_datos = 'bd_productos7'; // el nombre de tu base de datos

// Crear conexión
$conexion = new mysqli($host, $usuario, $contraseña, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    //die("Error de conexión: " . $conexion->connect_error);
}
?>
