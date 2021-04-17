<?php

    // Get the form fields, removes html tags and whitespace.
    /* There are three variables which will have the (name, email address and message) that the users enter into the form */
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Check the data.
    /* These variables will be check, if the name, message are empty and the email address is not valid then the user will be redirected to the website with the error message */
    if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: http://www.webdesigncourse.co/omnifood/index.php?success=-1#form");
        exit;
    }

    // Set the recipient email address. Update this to YOUR desired email address.
    /* In this variable, we can add the email address that we want the form to be sent to */
    $recipient = "jqemarmae123@gmail.com";

    // Set the email subject.
    /* The next step will be to define the subject of the message that wil be sent */ 
    $subject = "New contact from $name";

    // Build the email content.
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers.
    $email_headers = "From: $name <$email>";

    // Send the email.
    /* This is very important since this is the php function which is "mail" and it takes our email address, subject, email content and the email headers. */
    mail($recipient, $subject, $email_content, $email_headers);
    
    // Redirect to the index.html page with success code
    /* After sending the email, the users will be redirect to our website, this time with a success code and not the error message. */
    header("Location: http://www.webdesigncourse.co/omnifood/index.php?success=1#form");

?>