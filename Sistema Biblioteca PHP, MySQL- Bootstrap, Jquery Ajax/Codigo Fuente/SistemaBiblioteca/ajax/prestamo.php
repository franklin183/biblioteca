<?php
session_start();

require_once "../modelos/Prestamo.php";

$prestamo = new Prestamo();

$idprestamo = isset($_POST["idprestamo"]) ? sanitizeInput($_POST["idprestamo"]) : "";
$idlibro = isset($_POST["idlibro"]) ? sanitizeInput($_POST["idlibro"]) : "";
$idestudiante = isset($_POST["idestudiante"]) ? sanitizeInput($_POST["idestudiante"]) : "";
$fecha_prestamo = isset($_POST["fecha_prestamo"]) ? sanitizeInput($_POST["fecha_prestamo"]) : "";
$fecha_devolucion = isset($_POST["fecha_devolucion"]) ? sanitizeInput($_POST["fecha_devolucion"]) : "";
$cantidad = isset($_POST["cantidad"]) ? sanitizeInput($_POST["cantidad"]) : "";
$observacion = isset($_POST["observacion"]) ? sanitizeInput($_POST["observacion"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($idprestamo)) {
            $rspta = $prestamo->insertar($idlibro, $idestudiante, $fecha_prestamo, $fecha_devolucion, $cantidad, $observacion);
            echo $rspta ? "Prestamo registrado" : "Prestamo no se pudo registrar";
        } else {
            $rspta = $prestamo->editar($idprestamo, $idlibro, $idestudiante, $fecha_prestamo, $fecha_devolucion, $cantidad, $observacion);
            echo $rspta ? "Prestamo actualizado" : "Prestamo no se pudo actualizar";
        }
        break;

    // Other cases...

    case 'SelectLibro':
        require_once "../modelos/Libro.php";
        $libro = new Libro();
        $rspta = $libro->select();
        while ($reg = $rspta->fetch_object()) {
            echo '<option value=' . $reg->idlibro . '>' . $reg->titulo . '</option>';
        }
        break;

    case 'SelectEstudiante':
        require_once "../modelos/Estudiante.php";
        $estudiante = new Estudiante();
        $rspta = $estudiante->select();
        while ($reg = $rspta->fetch_object()) {
            echo '<option value=' . $reg->idestudiante . '>' . $reg->nombre . '</option>';
        }
        break;
}

// Function to sanitize input
function sanitizeInput($input)
{
    // Implement your sanitization logic here
    return $input;
}
?>
