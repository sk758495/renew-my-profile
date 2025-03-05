<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Enable remote file access for images
$options = new Options();
$options->set('defaultFont', 'Arial');
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true); // ✅ Allows external images

$dompdf = new Dompdf($options);

// Load HTML content (Make sure this matches your resume page)
$html = file_get_contents('resume.html'); // Load your resume HTML file

$dompdf->loadHtml($html);

// Set page size
$dompdf->setPaper('A4', 'portrait');

// Render PDF
$dompdf->render();

// Output the PDF file for download
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=Web_Developer_Resume.pdf");

echo $dompdf->output();
?>
