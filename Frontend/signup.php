<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "museum";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $plain_password = $_POST['password']; // Store the plain password
    $hashed_password = password_hash($plain_password, PASSWORD_BCRYPT); // Hash the password

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        // PHPMailer configuration
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth   = true;
            $mail->Username   = 'bhilwalamaulik07@gmail.com'; // SMTP username
            $mail->Password   = 'rjdy vttb wuqf uarm'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('bhilwalamaulik07@gmail.com', 'Museum Team');
            $mail->addAddress($email, $username);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Welcome to the Museum';
            $mail->Body    = "Hello $username,<br><br>Thank you for signing up!<br><br>Your username is: $username<br>Your password is: $plain_password<br><br>Best regards,<br>Museum Team";
            $mail->AltBody = "Hello $username,\n\nThank you for signing up!\n\nYour username is: $username\nYour password is: $plain_password\n\nBest regards,\nMuseum Team";

            $mail->send();
            echo 'New record created successfully. An email has been sent to ' . $email;
        } catch (Exception $e) {
            echo "New record created successfully, but the email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        header("Location: login.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
