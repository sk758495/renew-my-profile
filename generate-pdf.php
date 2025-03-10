<?php
require 'vendor/autoload.php'; // Load domPDF via Composer

use Dompdf\Dompdf;
use Dompdf\Options;

// Enable options
$options = new Options();
$options->set('defaultFont', 'Helvetica');
$dompdf = new Dompdf($options);

// Load HTML from resume.html
$html = file_get_contents('resume.html');

// Remove the download button from the PDF output
$html = preg_replace('/<div class="download-btn">.*?<\/div>/s', '', $html);

// Load HTML into domPDF
$dompdf->loadHtml($html);

// Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF (force download)
$dompdf->stream("resume.pdf", ["Attachment" => true]);
?>
