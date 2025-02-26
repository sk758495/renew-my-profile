<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Enable remote file access
$options = new Options();
$options->set('defaultFont', 'Arial');
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true); // ✅ This allows external images

$dompdf = new Dompdf($options);

// Load HTML content
ob_start();
include 'resume.html';
$html = ob_get_clean();

$dompdf->loadHtml($html);

// Set page size
$dompdf->setPaper('A4', 'portrait');

// Render PDF
$dompdf->render();

// Output as download
$dompdf->stream("Singapore_Tour_Package.pdf", ["Attachment" => true]);
?>
