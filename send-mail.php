<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ── reCAPTCHA verification ──────────────────────────────────────────
    $recaptcha_secret = "6LcnIaEsAAAAAERk1AKei_IQPkj2faUpBt6LTB4g";
    $recaptcha_response = $_POST["g-recaptcha-response"] ?? "";

    if (empty($recaptcha_response)) {
        echo "<script>alert('Please complete the reCAPTCHA.'); window.location.href='contact.html';</script>";
        exit;
    }

    $verify = file_get_contents(
        "https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}"
    );
    $captcha_data = json_decode($verify);

    if (!$captcha_data->success) {
        echo "<script>alert('reCAPTCHA verification failed. Please try again.'); window.location.href='contact.html';</script>";
        exit;
    }
    // ───────────────────────────────────────────────────────────────────

    $to = "engineeringzenval@gmail.com";

    $name    = strip_tags(trim($_POST["name"]    ?? ""));
    $email   = strip_tags(trim($_POST["email"]   ?? ""));
    $phone   = strip_tags(trim($_POST["phone"]   ?? ""));
    $item    = strip_tags(trim($_POST["item"]    ?? ""));
    $subject = strip_tags(trim($_POST["subject"] ?? ""));
    $message = strip_tags(trim($_POST["message"] ?? ""));

    // Basic field validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "<script>alert('Please fill in all required fields.'); window.location.href='contact.html';</script>";
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please enter a valid email address.'); window.location.href='contact.html';</script>";
        exit;
    }

    $email_content = "
    Name:    $name
    Email:   $email
    Phone:   $phone
    Item:    $item
    Subject: $subject

    Message:
    $message
    ";

    $headers  = "From: Zenval Website <no-reply@zenvalengineering.com>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $email_content, $headers)) {
        echo "<script>alert('Message Sent Successfully!'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.'); window.location.href='contact.html';</script>";
    }
}
?>
