<?php

include 'conexion_P.php';

if (isset($_POST['actualizar'])) { // Si se encuentra el método POST, capturar las variables

        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $precio_costo = mysqli_real_escape_string($conexion, $_POST['precio_costo']);
        $precio_venta = mysqli_real_escape_string($conexion, $_POST['precio_venta']);
        $id_sub_categoria = mysqli_real_escape_string($conexion, $_POST['id_sub_categoria']);
        $existencia = mysqli_real_escape_string($conexion, $_POST['existencia']);
        $id_unidad_de_medida = mysqli_real_escape_string($conexion, $_POST['id_unidad_de_medida']);
        $identificacion_vendedor = mysqli_real_escape_string($conexion, $_POST['identificacion_vendedor']);
        $fecha_de_ultima_venta = mysqli_real_escape_string($conexion, $_POST['fecha_de_ultima_venta']);

    // Consulta de actualización
    $sql = "UPDATE tbl_productos
            SET nombres = '$nombre', precio_costo = '$precio_costo', precio_venta = '$precio_venta',id_subcategoria = '$id_subcategoria', existencia = '$existencia', id_unidad_de_medida = '$id_unidad_de_medida',
            identificacion_vendedor = '$identificacion_vendedor', fecha_de_ultima_venta = '$fecha_de_ultima_venta'
            WHERE tbl_producto.codigo_producto = '$codigo_producto'";

    // Ejecutar la consulta y verificar si fue exitosa
    if ($conexion->query($sql) === TRUE) {
        echo "Actualizado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

if (isset($_GET['codigo_producto'])) {

    $codigo_producto = $_GET['codigo_producto'];

    // Consulta para obtener el estudiante
    $sql = "SELECT * FROM tbl_productos WHERE codigo_producto = '$codigo_producto'";
    $resultado = $conexion->query($sql);

    // Verificar si se encontró el estudiante
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
    } else {
        echo "Producto no encontrado";
        exit; // Detener la ejecución si no se encuentra
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Estudiante</title>
    <style>
        .container {
            background-color: rgb(184, 137, 227);
            padding: 20px;
            margin: 20px auto;
            width: 300px;
            text-align: center;
        }
        .titulo {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .estudiantes {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="container estudiantes">
    <p class="titulo">Actualizar Estudiante</p>

    <form action="" method="post">

        <!-- Campo oculto de identificación -->
        <input type="hidden" name="identificacion" value="<?php echo $fila['identificacion']; ?>">

        <!-- Campo de Nombres -->
        <label for="nombres">Nombres:</label><br>
        <input type="text" id="nombres" name="nombres" value="<?php echo $fila['nombres']; ?>" required><br><br>

        <!-- Campo de Apellidos -->
        <label for="apellidos">Apellidos:</label><br>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo $fila['apellidos']; ?>" required><br><br>

        <!-- Campo de Semestre -->
        <label for="semestre">Semestre:</label><br>
        <input type="number" id="semestre" name="semestre" value="<?php echo $fila['semestre']; ?>" required><br><br>
        
        <input type="submit" name="actualizar" value="Actualizar Estudiante">
    </form>
</div>
</body>
</html>
