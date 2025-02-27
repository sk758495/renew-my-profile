<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Your email where you receive messages
    $admin_email = "sk758495@gmail.com"; 
    $admin_name  = "Your Name"; // Change to your name

    // SMTP Configuration
    $smtp_host = "smtp.gmail.com"; // Change for different providers
    $smtp_username = "sk758495@gmail.com"; // Your SMTP email
    $smtp_password = "bnjnqakrxrfxwmty"; // Generate app password in Gmail
    $smtp_port = 587; // 465 for SSL, 587 for TLS
    $smtp_secure = "tls"; // "ssl" or "tls"

    try {
        // Send email to admin
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_username;
        $mail->Password = $smtp_password;
        $mail->SMTPSecure = $smtp_secure;
        $mail->Port = $smtp_port;

        $mail->setFrom($smtp_username, $name);
        $mail->addAddress($admin_email, $admin_name);
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission - $subject";
        $mail->Body = "<h3>New Message from Contact Form</h3>
                       <p><b>Name:</b> $name</p>
                       <p><b>Email:</b> $email</p>
                       <p><b>Subject:</b> $subject</p>
                       <p><b>Message:</b></p>
                       <p>$message</p>";

        $mail->send();

        // Auto-reply to user
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
        $replyMail->Subject = "Thank you for contacting us!";
        $replyMail->Body = "<h3>Dear $name,</h3>
                            <p>Thank you for reaching out to us. We have received your message and will get back to you soon.</p>
                            <p><b>Your Message:</b></p>
                            <p>$message</p>
                            <p>Best Regards,<br>Your Support Team</p>";

        $replyMail->send();

        echo "<script>alert('Message Sent Successfully!'); window.location.href='index.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Please try again later.'); window.location.href='index.html';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='index.html';</script>";
}
?>
