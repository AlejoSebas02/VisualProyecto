<?php
require('fpdf/fpdf.php');
require('../../Models/db.php');

if (!isset($_GET['cedula'])) {
    die("Cedula no proporcionada.");
}

$cedula = mysqli_real_escape_string($conn, $_GET['cedula']);

$sql = "SELECT cedula, nombre, apellido, direccion, telefono FROM estudiantes WHERE cedula = '$cedula'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 0) {
    die("No se encontro un estudiante con esa cedula.");
}

$row = mysqli_fetch_assoc($result);

$pdf = new FPDF();
$pdf->AddPage();

// Titulo
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Reporte FPDF', 0, 1, 'C');

// Subtitulo
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Reporte por cedula', 0, 1, 'C');

$pdf->Ln(5); // Espacio antes de la tabla

// Encabezados
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(20, 10, 'Cedula', 1);
$pdf->Cell(30, 10, 'Nombre', 1);
$pdf->Cell(30, 10, 'Apellido', 1);
$pdf->Cell(50, 10, 'Direccion', 1);
$pdf->Cell(30, 10, 'Telefono', 1);
$pdf->Ln();

// Datos
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 10, $row['cedula'], 1);
$pdf->Cell(30, 10, $row['nombre'], 1);
$pdf->Cell(30, 10, $row['apellido'], 1);
$pdf->Cell(50, 10, $row['direccion'], 1);
$pdf->Cell(30, 10, $row['telefono'], 1);
$pdf->Ln();

$pdf->Output();
exit;
