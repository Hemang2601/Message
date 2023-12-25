<?php
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$userEmail = "";
$successMessage = "";

if (isset($_POST['subscribe'])) {
    $userEmail = $_POST['email'];
    if (filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = 'hemanglakhadiya49@gmail.com'; // Replace with your Gmail address
            $mail->Password = 'tstx towt ggis bvle'; // Replace with your Gmail app password

            $mail->setFrom('hemanglakhadiya49@gmail.com', 'Mr. Hemang Lakhadiya');
            $mail->addAddress($userEmail);

            $mail->isHTML(true);
            $mail->Subject = 'Thank You for Exploring Web Development!';
            $mail->Body = 'Thank you for exploring web development with us! Stay tuned for exciting content on web development, coding, and much more.';

            $mail->send();
            $successMessage = 'Thanks for Subscribing as a Web Developer!';
            $userEmail = "";
        } catch (Exception $e) {
            echo '<div class="alert error-alert">Failed while sending your mail!</div>';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    } else {
        echo '<div class="alert error-alert">' . "$userEmail is not a valid email address!" . '</div>';
    }
}

if (!empty($successMessage)) {
    echo '<script>alert("' . $successMessage . '"); window.location.href = "index.html";</script>';
    
}

?>
