<?php
session_start();
require_once '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // ✅ Store session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // ✅ Send email to user only (no admin email)
            echo "
            <script src='https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js'></script>
            <script>
                emailjs.init('wyAGlTmzkHWKGcbto'); // Replace with your actual public key

                // Send the email to the user who logged in
                emailjs.send('service_asr497l', 'template_30rrbuu', {
                    username: '" . $user['username'] . "',
                    email: '" . $user['email'] . "',
                    time: new Date().toLocaleString()
                }).then(function(response) {
                    console.log('Email sent!', response.status, response.text);
                }, function(error) {
                    console.log('Email failed:', error);
                });

                // Redirect to dashboard after short delay
                setTimeout(() => {
                    window.location.href = '../dashboard.php';
                }, 1000);
            </script>
            ";
            exit;
        } else {
            echo "Invalid credentials. <a href='../index.html'>Try again</a>";
        }
    } catch (PDOException $e) {
        echo "Login failed: " . $e->getMessage();
    }
}
?>
