<?php
require 'vendor/autoload.php';  // Include DOMPDF via Composer

use Dompdf\Dompdf;
use Dompdf\Options;

// Create instance of Dompdf
$dompdf = new Dompdf();

// Load HTML content (make sure to pass the full path to the HTML file)
$html = file_get_contents('resume.html');

// Options for DOMPDF (for handling images and large files)
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set('isHtml5ParserEnabled', true);
$options->set('isJavascriptEnabled', true);  // Enable JavaScript (optional, only if necessary)
$options->set("isHtml5ParserEnabled", true);

// Enable external image support (if using absolute URLs)
$options->set('isPhpEnabled', true);
$options->set('isHtml5ParserEnabled', true);
$options->set("isHtml5ParserEnabled", true);
$options->set("isJavascriptEnabled", true);

$dompdf->setOptions($options);

// Load HTML content
$dompdf->loadHtml($html);

// Set paper size (A4 by default)
$dompdf->setPaper('A4', 'portrait');

// Render PDF (first pass)
$dompdf->render();

// Output the generated PDF to browser or save it as a file
$dompdf->stream("resume.pdf", array("Attachment" => 0)); // 0 for displaying in browser
// or to save the PDF
// $dompdf->stream("resume.pdf", array("Attachment" => 1)); // 1 for downloading
?>
