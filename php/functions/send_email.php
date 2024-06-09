<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $to = "badran.amr2003@gmail.com";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $email_subject = "Contact Us Form: $subject";
    $email_body = "
        <html>
        <head>
            <title>$subject</title>
        </head>
        <body>
            <h2>Contact Us Form Submission</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong><br>$message</p>
        </body>
        </html>
    ";

    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Message sent successfully!";
        header("Location: ../../index.php");
    } else {
        header("Location: ../../index.php");
        echo "Failed to send message.";
    }
    header("Location: ../../index.php");
} else {
    echo "Invalid request.";
}

?>