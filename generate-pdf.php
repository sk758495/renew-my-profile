<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Enable options
$options = new Options();
$options->set('defaultFont', 'Helvetica');
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true); // Enable external URLs
$dompdf = new Dompdf($options);

// Load HTML from file
$html = file_get_contents('resume.html');

// Convert image to base64
$imagePath = 'https://techno.web4design.in/img/my-image.jpeg'; // Path to your image
$type = pathinfo($imagePath, PATHINFO_EXTENSION);
$data = file_get_contents($imagePath);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

// Replace the image source with base64
$html = str_replace('https://techno.web4design.in/img/my-image.jpeg', $base64, $html);

// Remove the download button for PDF output
$html = preg_replace('/<div class="download-btn">.*?<\/div>/s', '', $html);

// Load HTML into Dompdf
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Download PDF
$dompdf->stream("sunny-kumar.pdf", ["Attachment" => true]);
?>
