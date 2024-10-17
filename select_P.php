<?php
include 'conexion_P.php';

// Consulta SQL usando alias para evitar conflicto entre columnas con el mismo nombre
$sql = "SELECT tbl_productos.codigo_producto, tbl_productos.nombre, tbl_productos.precio_costo, tbl_productos.precio_venta, 
               tbl_sub_categoria.nombre AS subcategoria_nombre, tbl_productos.existencia, 
               tbl_unidad_de_medida.nombre AS unidad_nombre, 
               tbl_vendedor.nombre AS vendedor_nombre, tbl_productos.fecha_de_ultima_venta
        FROM tbl_productos
        JOIN tbl_sub_categoria ON tbl_productos.id_sub_categoria = tbl_sub_categoria.id_sub_categoria
        JOIN tbl_unidad_de_medida ON tbl_productos.id_unidad_de_medida = tbl_unidad_de_medida.id_unidad_de_medida
        JOIN tbl_vendedor ON tbl_productos.identificacion_vendedor = tbl_vendedor.identificacion_vendedor";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title> <!-- Cambiado a "Lista de Productos" -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #000000 ;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #000000;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .no-data {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h1>Lista de Productos</h1> <!-- Cambiado a "Lista de Productos" -->

<?php
if ($resultado->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Precio costo</th>
                <th>Precio venta</th>
                <th>Subcategoría</th>
                <th>Existencia</th>
                <th>Unidad de medida</th>
                <th>Vendedor</th>
                <th>Fecha de última venta</th>
            </tr>";
    
    // Recorrer el resultado y mostrar cada fila
    while ($row = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["codigo_producto"] . "</td>
                <td>" . $row["nombre"] . "</td>
                <td>" . $row["precio_costo"] . "</td>
                <td>" . $row["precio_venta"] . "</td>
                <td>" . $row["subcategoria_nombre"] . "</td>
                <td>" . $row["existencia"] . "</td>
                <td>" . $row["unidad_nombre"] . "</td>
                <td>" . $row["vendedor_nombre"] . "</td>
                <td>" . $row["fecha_de_ultima_venta"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<div class='no-data'>No existen productos.</div>";
}

$conexion->close();
?>

</body>
</html>
