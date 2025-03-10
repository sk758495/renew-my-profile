<?php
require 'vendor/autoload.php'; // Include Composer autoload (for domPDF)

// Reference the domPDF namespace
use Dompdf\Dompdf;
use Dompdf\Options;

// Enable options for better font rendering
$options = new Options();
$options->set('defaultFont', 'Helvetica');
$dompdf = new Dompdf($options);

// Resume HTML
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #fff; padding: 20px; }
        .resume-container { max-width: 800px; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header img { width: 120px; height: 120px; border-radius: 50%; margin-bottom: 10px; }
        .header h1 { font-size: 28px; margin-bottom: 5px; }
        .header p { font-size: 16px; color: gray; }
        .section-title { font-size: 20px; font-weight: bold; border-bottom: 2px solid black; margin-top: 20px; padding-bottom: 5px; }
        .section-content { margin-top: 10px; }
    </style>
</head>
<body>
    <div class="resume-container">
        <div class="header">
            <img src="img/my-image.jpeg" alt="Profile Picture">
            <h1>Adeline Palmerston</h1>
            <p>Office Assistant</p>
            <p>📍 123 Anywhere St., Any City | 📞 +123-456-7890 | ✉️ hello@reallygreatsite.com</p>
        </div>
        <div class="section">
            <div class="section-title">Career Overview</div>
            <p class="section-content">I manage secretarial duties like sorting and sending mail as a professional. To keep the office tidy and clean for guests or clients, I maintain an inventory of office supplies and place fresh orders as necessary.</p>
        </div>
        <div class="section">
            <div class="section-title">Education</div>
            <p class="section-content">Bachelor of Business Administration - Rimberio University | 2019</p>
        </div>
        <div class="section">
            <div class="section-title">Skills</div>
            <ul class="section-content">
                <li>Basic computer literacy skills</li>
                <li>Organizational skills</li>
                <li>Strategic planning and scheduling skills</li>
                <li>Time-management skills</li>
                <li>Verbal and written communication skills</li>
            </ul>
        </div>
        <div class="section">
            <div class="section-title">Experience</div>
            <p><strong>Office Staff</strong> - Borcelle | January - Present</p>
            <ul>
                <li>Help colleagues and set up the office in a way that streamlines processes</li>
                <li>Sort and distribute correspondence as soon as possible</li>
                <li>Ensure information is accurate and valid by creating and updating records</li>
                <li>Plan and schedule meetings and appointments</li>
            </ul>
            <p><strong>Office Clerk</strong> - Larana Inc. | May 2019 - June 2021</p>
            <ul>
                <li>Help colleagues and set up the office in a way that streamlines processes</li>
                <li>Sort and distribute correspondence as soon as possible</li>
                <li>Ensure information is accurate and valid by creating and updating records</li>
            </ul>
        </div>
        <div class="section">
            <div class="section-title">Reference</div>
            <p>Juliana Silva - CEO | Liceria & Co.</p>
            <p>✉️ hello@reallygreatsite.com | 📞 +123-456-7890</p>
        </div>
    </div>
</body>
</html>
';

// Load HTML into domPDF
$dompdf->loadHtml($html);

// Set paper size and orientation (A4, portrait)
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF (force download)
$dompdf->stream("resume.pdf", ["Attachment" => true]); // Change to false to preview in browser
?>
