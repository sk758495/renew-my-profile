<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    // Admin Details (Your Email)
    $admin_email = "sk758495@gmail.com"; 
    $admin_name  = "Your Name"; // Change to your name
    $logo_url = "https://techno.web4design.in/img/logo/Techno.png"; // Your logo (optional)

    // SMTP Configuration
    $smtp_host = "smtp.gmail.com"; // Change if using Outlook/Yahoo
    $smtp_username = "sk758495@gmail.com"; // Your SMTP email
    $smtp_password = "bnjnqakrxrfxwmty"; // Gmail App Password (Not your normal password)
    $smtp_port = 587; // 465 for SSL, 587 for TLS
    $smtp_secure = "tls"; // "ssl" or "tls"

    try {
        // **Send Subscription Email to Admin**
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_username;
        $mail->Password = $smtp_password;
        $mail->SMTPSecure = $smtp_secure;
        $mail->Port = $smtp_port;

        $mail->setFrom($smtp_username, "New Subscriber");
        $mail->addAddress($admin_email, $admin_name);

        $mail->isHTML(true);
        $mail->Subject = "📩 New Subscriber";
        $mail->Body = "
            <div style='background: #f8f8f8; padding: 20px; font-family: Arial, sans-serif;'>
                <h2 style='color: #333;'>New Subscriber</h2>
                <p>A new user has subscribed with the following email:</p>
                <p><strong>Email:</strong> $email</p>
                <p style='color: #777; font-size: 12px;'>This is an automated message from your website.</p>
            </div>";

        $mail->send();

        // **Send Auto-reply to User**
        $replyMail = new PHPMailer(true);
        $replyMail->isSMTP();
        $replyMail->Host = $smtp_host;
        $replyMail->SMTPAuth = true;
        $replyMail->Username = $smtp_username;
        $replyMail->Password = $smtp_password;
        $replyMail->SMTPSecure = $smtp_secure;
        $replyMail->Port = $smtp_port;

        $replyMail->setFrom($smtp_username, "Support Team");
        $replyMail->addAddress($email);
        $replyMail->isHTML(true);
        $replyMail->Subject = "🎉 Thank You for Subscribing!";
        $replyMail->Body = "
            <div style='background: #f8f8f8; padding: 20px; font-family: Arial, sans-serif;'>
                <center>
                    <img src='$logo_url' alt='Logo' width='120' style='margin-bottom: 15px;'>
                </center>
                <h2 style='color: #333;'>Welcome to Our Community!</h2>
                <p>Thank you for subscribing to our updates. Stay tuned for the latest news and offers!</p>
                <p>If you have any questions, feel free to <a href='mailto:$admin_email'>contact us</a>.</p>
                <p style='color: #777; font-size: 12px;'>Best Regards,<br><strong>Support Team</strong></p>
            </div>";

        $replyMail->send();

        echo "success"; // AJAX response
    } catch (Exception $e) {
        echo "Subscription failed! Try again.";
    }
} else {
    echo "Invalid request!";
}
?>
