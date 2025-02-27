<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = nl2br(htmlspecialchars($_POST['message'])); // Preserve line breaks

    // Your details
    $admin_email = "sk758495@gmail.com";
    $admin_name  = "Your Name"; // Change to your name
    $logo_url = "https://techno.web4design.in/img/logo/Techno.png"; // Replace with your logo URL

    // SMTP Configuration
    $smtp_host = "smtp.gmail.com";
    $smtp_username = "sk758495@gmail.com";
    $smtp_password = "bnjnqakrxrfxwmty"; // Use your App Password
    $smtp_port = 587;
    $smtp_secure = "tls";

    try {
        // **Admin Email (Notification)**
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_username;
        $mail->Password = $smtp_password;
        $mail->SMTPSecure = $smtp_secure;
        $mail->Port = $smtp_port;

        $mail->setFrom($smtp_username, "Contact Form");
        $mail->addAddress($admin_email, $admin_name);
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = "📩 New Contact Form Submission - $subject";
        $mail->Body = "
            <div style='background: #f5f5f5; padding: 20px; font-family: Arial, sans-serif;'>
                <div style='background: #ffffff; padding: 20px; border-radius: 8px;'>
                    <center>
                        <img src='$logo_url' alt='Company Logo' width='120' style='margin-bottom: 15px;'>
                    </center>
                    <h2 style='color: #333; text-align: center;'>New Contact Form Submission</h2>
                    <hr style='border: 1px solid #ddd;'>
                    <p><strong>Name:</strong> $name</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Subject:</strong> $subject</p>
                    <p><strong>Message:</strong></p>
                    <div style='background: #f9f9f9; padding: 15px; border-radius: 5px;'>
                        <p>$message</p>
                    </div>
                    <hr style='border: 1px solid #ddd;'>
                    <p style='text-align: center; color: #666; font-size: 12px;'>This email was sent automatically from your website.</p>
                </div>
            </div>";

        $mail->send();

        // **Auto-reply to User**
        $replyMail = new PHPMailer(true);
        $replyMail->isSMTP();
        $replyMail->Host = $smtp_host;
        $replyMail->SMTPAuth = true;
        $replyMail->Username = $smtp_username;
        $replyMail->Password = $smtp_password;
        $replyMail->SMTPSecure = $smtp_secure;
        $replyMail->Port = $smtp_port;

        $replyMail->setFrom($smtp_username, "Support Team");
        $replyMail->addAddress($email, $name);
        $replyMail->isHTML(true);
        $replyMail->Subject = "📩 Thank you for contacting us!";
        $replyMail->Body = "
            <div style='background: #f5f5f5; padding: 20px; font-family: Arial, sans-serif;'>
                <div style='background: #ffffff; padding: 20px; border-radius: 8px;'>
                    <center>
                        <img src='$logo_url' alt='Company Logo' width='120' style='margin-bottom: 15px;'>
                    </center>
                    <h2 style='color: #333; text-align: center;'>Thank You for Contacting Us!</h2>
                    <hr style='border: 1px solid #ddd;'>
                    <p>Hello <strong>$name</strong>,</p>
                    <p>We appreciate you reaching out. Your message has been received, and we will get back to you soon.</p>
                    <p><strong>Your Message:</strong></p>
                    <div style='background: #f9f9f9; padding: 15px; border-radius: 5px;'>
                        <p>$message</p>
                    </div>
                    <hr style='border: 1px solid #ddd;'>
                    <p>If you need urgent assistance, you can contact us directly at <a href='mailto:$admin_email'>$admin_email</a>.</p>
                    <p style='text-align: center; color: #666; font-size: 12px;'>Best Regards,<br><strong>Your Support Team</strong></p>
                </div>
            </div>";

        $replyMail->send();

        echo "<script>alert('Message Sent Successfully!'); window.location.href='index.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Please try again later.'); window.location.href='index.html';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='index.html';</script>";
}
?>
