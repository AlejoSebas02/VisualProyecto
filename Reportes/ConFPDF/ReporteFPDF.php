<?php
require('fpdf/fpdf.php');
require('../../Models/db.php'); // Usa tu conexión $conn

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Titulo
$pdf->Cell(0, 10, 'Reporte FPDF', 0, 1, 'C');

// Subtitulo
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Reporte general', 0, 1, 'C');

$pdf->Ln(5); // Espacio extra antes de la tabla

// Encabezados
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(20, 10, 'Cedula', 1);
$pdf->Cell(30, 10, 'Nombre', 1);
$pdf->Cell(30, 10, 'Apellido', 1);
$pdf->Cell(50, 10, 'Direccion', 1);
$pdf->Cell(20, 10, 'Telefono', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);

$sql = "SELECT cedula, nombre, apellido, telefono, direccion FROM estudiantes";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(20, 10, $row['cedula'], 1);
    $pdf->Cell(30, 10, $row['nombre'], 1);
    $pdf->Cell(30, 10, $row['apellido'], 1);
    $pdf->Cell(50, 10, $row['direccion'], 1);
    $pdf->Cell(20, 10, $row['telefono'], 1);
    $pdf->Ln();
}

$pdf->Output();
exit;
