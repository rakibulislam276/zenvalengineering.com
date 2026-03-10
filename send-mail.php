<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $to = "engineeringzenval@gmail.com";

    $name = strip_tags($_POST["name"]);
    $email = strip_tags($_POST["email"]);
    $phone = strip_tags($_POST["phone"]);
    $item = strip_tags($_POST["item"]);
    $subject = strip_tags($_POST["subject"]);
    $message = strip_tags($_POST["message"]);

    $email_content = "
    Name: $name
    Email: $email
    Phone: $phone
    Item: $item
    Subject: $subject

    Message:
    $message
    ";

    $headers = "From: Zenval Website <no-reply@zenvalengineering.com>\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $subject, $email_content, $headers)) {
        echo "<script>alert('Message Sent Successfully!'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.'); window.location.href='contact.html';</script>";
    }
}
?>
