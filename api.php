<?php 

function sanitize_my_email($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

$myjson = json_decode( file_get_contents( 'php://input' ), true );
$myjson = json_decode(json_encode($myjson));

$to_email = 'contact@telicsolutions.com';
$subject =  "Message from Telic Solutions Website";
$message = $myjson->message;
$headers = 'From: ' . $myjson->email;

//check if the email address is invalid $secure_check

$secure_check = sanitize_my_email($to_email);

if ($secure_check == false)
{
    echo "Invalid input";
}
else
{    //send email 
    if(mail($to_email, $subject, $message, $headers)) {
        echo "Sent successfully";
    } else {
        echo "Error";
    }
}

?>