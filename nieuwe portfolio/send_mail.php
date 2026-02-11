<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        // Jouw echte e-mailadres
        $recipient = "chatoorangthie@gmail.com";
        $email_subject = "Nieuw contactformulier bericht: $subject";

        $email_content = "Naam: $name\n";
        $email_content .= "E-mail: $email\n\n";
        $email_content .= "Bericht:\n$message\n";

        $email_headers = "From: $name <$email>\r\n";
        $email_headers .= "Reply-To: $email\r\n";

        if (mail($recipient, $email_subject, $email_content, $email_headers)) {
            http_response_code(200);
            echo "Bedankt! Je bericht is verzonden.";
        } else {
            http_response_code(500);
            echo "Oeps! Er is iets misgegaan. Probeer het later opnieuw.";
        }
    } else {
        http_response_code(400);
        echo "Vul alle velden in en probeer opnieuw.";
    }
} else {
    http_response_code(403);
    echo "Er was een probleem met je verzending, probeer opnieuw.";
}
?>
