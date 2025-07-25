<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize and get the form data
   $name = htmlspecialchars(strip_tags($_POST["name"]));
$email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
$subject = htmlspecialchars(strip_tags($_POST["subject"]));
$message = htmlspecialchars(strip_tags($_POST["message"]));

    // Check that data was sent
    if ( empty($name) OR empty($subject) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Send a 400 bad request response if data is invalid
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    // Set the recipient email address
    // IMPORTANT: UPDATE THIS TO YOUR EMAIL ADDRESS
    $recipient = "yeewin1011@gmail.com";

    // Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers
    $email_headers = "From: $name <$email>";

    // Send the email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Send a 200 OK response
        http_response_code(200);
        echo "Thank You! Your message has been sent.";
    } else {
        // Send a 500 internal server error response
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }

} else {
    // Not a POST request, set a 403 (forbidden) response code
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>