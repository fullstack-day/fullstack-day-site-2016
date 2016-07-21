<?php
// Get some important variables
require_once( '../config.php' );


// Add your email address below
$TO_EMAIL = $Email_Address;


// Subject for emails
$SUBJECT = $Contact_Form_Subject;


if( !isset($_POST['registration-name']) || !isset($_POST['registration-email']) || !isset($_POST['registration-phone']) ) {
    $output = json_encode(
        array(
            'type'=>'error',
            'text' => 'Input fields are empty!'
        )
    );
    die($output);
}

$name     = filter_var($_POST["registration-name"], FILTER_SANITIZE_STRING);
$email    = filter_var($_POST["registration-email"], FILTER_SANITIZE_EMAIL);
$phone  = filter_var($_POST["registration-phone"], FILTER_SANITIZE_STRING);
$type  = filter_var($_POST["registration-type"], FILTER_SANITIZE_STRING);


// Validate email
if( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
    $output = json_encode(array('type'=>'error', 'text' => 'Please enter a valid email!'));
    die($output);
}

$body = 'Name: ' . $name . "\n\n" . 'Email address: ' . $email . "\n\n" . 'Phone: ' . $phone . "\n\n" . 'Registration Type: ' . $type;

$headers = array(
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8',
    'Content-Transfer-Encoding: 7bit',
    'Date: ' . date('r', $_SERVER['REQUEST_TIME']),
    'Message-ID: <' . $_SERVER['REQUEST_TIME'] . md5($_SERVER['REQUEST_TIME']) . '@' . $_SERVER['SERVER_NAME'] . '>',
    'From: ' . mb_encode_mimeheader($name) . '" <' . $TO_EMAIL . '>',
    'Reply-To: ' . $email,
    'X-Mailer: PHP v' . phpversion(),
    'X-Originating-IP: ' . $_SERVER['SERVER_ADDR'],
);

mail($TO_EMAIL, '=?UTF-8?B?' . base64_encode($SUBJECT) . '?=', $body, implode("\r\n", $headers));