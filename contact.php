<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = strip_tags(trim($_POST["name"] ?? ''));
    $email   = filter_var(trim($_POST["email"] ?? ''), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"] ?? ''));
    $message = trim($_POST["message"] ?? '');

    if ($name && $email && $subject && $message) {
        $to      = "yeewin1011@gmail.com"; // ✅ Change to your actual email
        $headers = "From: $name <$email>";
        $body    = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";

        if (mail($to, $subject, $body, $headers)) {
            echo "success";
            exit;
        } else {
            echo "error";
            exit;
        }
    } else {
        echo "error";
        exit;
    }
}
