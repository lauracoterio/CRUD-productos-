<?php
include 'conexion_P.php'; // Archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['insertar_vendedor'])) {
        // Insertar vendedor
        $identificacion_vendedor = mysqli_real_escape_string($conexion, $_POST['identificacion_vendedor']);
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $apellidos = mysqli_real_escape_string($conexion, $_POST['apellidos']);

        $sql = "INSERT INTO tbl_vendedor (identificacion_vendedor, nombre, apellidos) VALUES (NULL, '$nombre', '$apellidos')";
        if ($conexion->query($sql) === TRUE) {
            echo "Vendedor añadido correctamente";
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }
    } elseif (isset($_POST['insertar_unidad_de_medida'])) {
        // Insertar unidad de medida
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $sql = "INSERT INTO tbl_unidad_de_medida (id_unidad_de_medida, nombre) VALUES (NULL, '$nombre')";
        if ($conexion->query($sql) === TRUE) {
            echo '<script>swal("¡Unidad de medida!", "Agregada correctamente", "success");</script>';
        } else {
            echo '<script>swal("¡Unidad de medida!", "Error al insertar la unidad de medida", "error");</script>';
        }
    } elseif (isset($_POST['insertar_categoria'])) {
        // Insertar categoría
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $sql = "INSERT INTO tbl_categoria (id_categoria, nombre) VALUES (NULL, '$nombre')";
        if ($conexion->query($sql) === TRUE) {
            echo '<script>swal("¡Categoría!", "Agregada correctamente", "success");</script>';
        } else {
            echo '<script>swal("¡Categoría!", "Error al insertar la categoría", "error");</script>';
        }
    } elseif (isset($_POST['insertar_sub_categoria'])) {
        // Insertar subcategoría
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $id_categoria = mysqli_real_escape_string($conexion, $_POST['id_categoria']);
        $sql = "INSERT INTO tbl_sub_categoria (nombre, id_categoria) VALUES ('$nombre', '$id_categoria')";
        if ($conexion->query($sql) === TRUE) {
            echo '<script>swal("¡Subcategoría!", "Subcategoría insertada exitosamente", "success");</script>';
        } else {
            echo '<script>swal("¡Subcategoría!", "Error al insertar la subcategoría", "error");</script>';
        }
    } elseif (isset($_POST['insertar_producto'])) {
        // Insertar producto
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $precio_costo = mysqli_real_escape_string($conexion, $_POST['precio_costo']);
        $precio_venta = mysqli_real_escape_string($conexion, $_POST['precio_venta']);
        $id_sub_categoria = mysqli_real_escape_string($conexion, $_POST['id_sub_categoria']);
        $existencia = mysqli_real_escape_string($conexion, $_POST['existencia']);
        $id_unidad_de_medida = mysqli_real_escape_string($conexion, $_POST['id_unidad_de_medida']);
        $identificacion_vendedor = mysqli_real_escape_string($conexion, $_POST['identificacion_vendedor']);
        $fecha_de_ultima_venta = mysqli_real_escape_string($conexion, $_POST['fecha_de_ultima_venta']);

        $sql = "INSERT INTO tbl_productos (nombre, precio_costo, precio_venta, id_sub_categoria, existencia, id_unidad_de_medida, identificacion_vendedor, fecha_de_ultima_venta) 
                VALUES ('$nombre', '$precio_costo', '$precio_venta', '$id_sub_categoria', '$existencia', '$id_unidad_de_medida', '$identificacion_vendedor', '$fecha_de_ultima_venta')";

        if ($conexion->query($sql) === TRUE) {
            echo '<script>swal("¡Producto!", "Creado exitosamente", "success");</script>';
        } else {
            echo '<script>swal("¡Producto!", "Error al crear producto", "error");</script>';
        }
    } elseif (isset($_POST['eliminar_producto'])) {
        // Eliminar producto
        $codigo_producto = mysqli_real_escape_string($conexion, $_POST['codigo_producto']);
        $sql = "DELETE FROM tbl_productos WHERE codigo_producto = '$codigo_producto'";
        if ($conexion->query($sql) === TRUE) {
            echo '<script>swal("¡Producto Eliminado!", "El producto ha sido eliminado correctamente", "success");</script>';
        } else {
            echo '<script>swal("Error", "No se pudo eliminar el producto", "error");</script>';
        }
    }
}

$conexion->close();
?>

<?php
include 'conexion_P.php';
$sql = "SELECT identificacion_vendedor , nombre FROM tbl_vendedor";
$resultado_vendedor = $conexion -> query($sql);
?>

<?php
include 'conexion_P.php';
$sql = "SELECT id_unidad_de_medida , nombre FROM tbl_unidad_de_medida";
$resultado_unidad = $conexion -> query($sql);
?>


<?php
include 'conexion_P.php';
$sql = "SELECT id_categoria, nombre FROM tbl_categoria";
$resultado_categoria = $conexion -> query($sql);
?>

<?php
include 'conexion_P.php';
$sql = "SELECT id_sub_categoria, nombre FROM tbl_sub_categoria";
$resultado_subcategoria = $conexion -> query($sql);
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <title>Formularios</title>
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
        .productos {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<!-- Formulario para insertar vendedor -->
<div class="container productos">
    <p class="titulo">Insertar vendedor:</p>
    <form action="" method="post">
        <label for="identificacion_vendedor">Identificación vendedor:</label><br>
        <input type="number" id="identificacion_vendedor" name="identificacion_vendedor" required><br><br>
        <label for="nombre">Nombre del vendedor:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <label for="apellidos">Apellido del vendedor:</label><br>
        <input type="text" id="apellidos" name="apellidos" required><br><br>
        <input type="submit" name="insertar_vendedor" value="Insertar vendedor">
    </form>
</div>

<!-- Formulario para insertar unidad de medida -->
<div class="container productos">
    <p class="titulo">Insertar unidad de medida</p>
    <form action="" method="post">
        <label for="nombre">Unidad de medida:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <input type="submit" name="insertar_unidad_de_medida" value="Crear unidad de medida">
    </form>
</div>

<!-- Formulario para insertar categoría -->
<div class="container productos">
    <p class="titulo">Insertar categoría:</p>
    <form action="" method="post">
        <label for="nombre">Categoría:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <input type="submit" name="insertar_categoria" value="Crear categoría">
    </form>
</div>

<!-- Formulario para insertar subcategoría -->
<div class="container productos">
    <p class="titulo">Insertar subcategoría:</p>
    <form action="" method="post">
        <label for="nombre">Subcategoría:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <label for="id_categoria">Categoría:</label><br>
        <select name="id_categoria" required>
            <option value="">Seleccione una categoría:</option>
            <?php
            // Lista de categorías
            if ($resultado_categoria->num_rows > 0) {
                while ($fila = $resultado_categoria->fetch_assoc()) {
                    echo '<option value="'.$fila['id_categoria'].'">'.$fila['nombre'].'</option>';
                }
            } else {
                echo '<option value="">No hay categorías</option>';
            }
            ?>
        </select><br><br>
        <input type="submit" name="insertar_sub_categoria" value="Crear subcategoría">
    </form>
</div>

<!-- Formulario para insertar producto -->
<div class="container productos">
    <p class="titulo">Insertar producto</p>
    <form action="" method="post">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <label for="precio_costo">Precio costo:</label><br>
        <input type="text" id="precio_costo" name="precio_costo" required><br><br>
       
        <label for="precio_venta">Precio venta:</label><br>
        <input type="text" id="precio_venta" name="precio_venta" required><br><br>
        <label for="id_sub_categoria">Subcategoría:</label><br>
        <select name="id_sub_categoria" required>
            <option value="">Seleccione una subcategoría:</option>
            <?php
            // Lista de subcategorías
            if ($resultado_subcategoria->num_rows > 0) {
                while ($fila = $resultado_subcategoria->fetch_assoc()) {
                    echo '<option value="'.$fila['id_sub_categoria'].'">'.$fila['nombre'].'</option>';
                }
            } else {
                echo '<option value="">No hay subcategorías</option>';
            }
            ?>
        </select><br><br>
        <label for="existencia">Existencia:</label><br>
        <input type="number" id="existencia" name="existencia" required><br><br>
        <label for="id_unidad_de_medida">Unidad de medida:</label><br>
        <select name="id_unidad_de_medida" required>
            <option value="">Seleccione una unidad de medida:</option>
            <?php
            // Lista de unidades de medida
            if ($resultado_unidad->num_rows > 0) {
                while ($fila = $resultado_unidad->fetch_assoc()) {
                    echo '<option value="'.$fila['id_unidad_de_medida'].'">'.$fila['nombre'].'</option>';
                }
            } else {
                echo '<option value="">No hay unidades de medida</option>';
            }
            ?>
        </select><br><br>
        <label for="identificacion_vendedor">Vendedor:</label><br>
        <select name="identificacion_vendedor" required>
            <option value="">Seleccione un vendedor:</option>
            <?php
            // Lista de vendedores
            if ($resultado_vendedor->num_rows > 0) {
                while ($fila = $resultado_vendedor->fetch_assoc()) {
                    echo '<option value="'.$fila['identificacion_vendedor'].'">'.$fila['nombre'].' '.$fila['apellidos'].'</option>';
                }
            } else {
                echo '<option value="">No hay vendedores</option>';
            }
            ?>
        </select><br><br>
        <label for="fecha_de_ultima_venta">Fecha de última venta:</label><br>
        <input type="date" id="fecha_de_ultima_venta" name="fecha_de_ultima_venta"><br><br>
        <input type="submit" name="insertar_producto" value="Crear producto">
    </form>
</div>

<!-- Formulario para eliminar producto -->
<div class="container productos">
    <p class="titulo">Eliminar producto:</p>
    <form action="" method="post">
        <label for="codigo_producto">Código del producto:</label><br>
        <input type="number" id="codigo_producto" name="codigo_producto" required><br><br>
        <input type="submit" name="eliminar_producto" value="Eliminar producto">
    </form>
</div>

<!-- SweetAlert2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>
</html>
