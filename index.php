<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Developer Subscription Form</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <input type="checkbox" id="toggle">
    <label for="toggle" class="show-btn">Subscribe Now</label>
    <div class="wrapper">
        <label for="toggle">
            <i class="cancel-icon fas fa-times"></i>
        </label>
        <div class="icon"><i class="far fa-envelope"></i></div>
        <div class="content">
            <header>Join Our Web Developer Community</header>
            <p>Subscribe to our blog and stay updated with the latest web development trends, tips, and tutorials straight to your inbox.</p>
        </div>
        <form action="index.php" method="POST">
            <?php
            require 'src/Exception.php';
            require 'src/PHPMailer.php';
            require 'src/SMTP.php';
            
            use PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;
            
            $userEmail = "";
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
                        echo '<div class="alert success-alert">Thanks for Subscribing as a Web Developer!</div>';
                        $userEmail = "";
                    } catch (Exception $e) {
                        echo '<div class="alert error-alert">Failed while sending your mail!</div>';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    }
                } else {
                    echo '<div class="alert error-alert">' . "$userEmail is not a valid email address!" . '</div>';
                }
            }
            ?>
            <div class="field">
                <input type="text" class="email" name="email" placeholder="Your Email Address" required value="<?php echo $userEmail ?>">
            </div>
            <div class="field btn">
                <div class="layer"></div>
                <button type="submit" name="subscribe">Subscribe</button>
            </div>
        </form>
        <div class="text">We do not share your information. Unsubscribe anytime.</div>
    </div>
</body>
</html>
