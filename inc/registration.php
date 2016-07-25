<?php
// Get some important variables
require_once( '../config.php' );


// Add your email address below
$TO_EMAIL = $Email_Address;


// Subject for emails
$SUBJECT = $Registration_Form_Subject;


if( !isset($_POST['registration-name']) || !isset($_POST['registration-email']) || !isset($_POST['registration-message']) ) {
    $output = json_encode(
        array(
            'type'=>'error',
            'text' => 'Input fields are empty!'
        )
    );
    die($output);
}

$NAME     = filter_var($_POST['registration-name'], FILTER_SANITIZE_STRING);
$EMAIL    = filter_var($_POST['registration-email'], FILTER_SANITIZE_EMAIL);
$SUBJECT_FORM  = filter_var($_POST['registration-subject'], FILTER_SANITIZE_STRING);
$MESSAGE  = filter_var($_POST['registration-message'], FILTER_SANITIZE_STRING);


// Validate email
if( !filter_var($EMAIL, FILTER_VALIDATE_EMAIL) ) {
    $output = json_encode(array('type'=>'error', 'text' => 'Please enter a valid email!'));
    die($output);
}

$body = '---REGISTRATION---' . "\n\n" . 'Name: ' . $NAME . "\n\n" . 'Email address: ' . $EMAIL . "\n\n" . 'Subject: ' . $SUBJECT_FORM . "\n\n" . 'Message: ' . $MESSAGE;

$headers = array(
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8',
    'Content-Transfer-Encoding: 7bit',
    'Date: ' . date('r', $_SERVER['REQUEST_TIME']),
    'Message-ID: <' . $_SERVER['REQUEST_TIME'] . md5($_SERVER['REQUEST_TIME']) . '@' . $_SERVER['SERVER_NAME'] . '>',
    'From: ' . mb_encode_mimeheader($NAME) . ' <' . $TO_EMAIL . '>',
    'Reply-To: ' . $EMAIL,
    'X-Mailer: PHP v' . phpversion(),
    'X-Originating-IP: ' . $_SERVER['SERVER_ADDR'],
);

mail($TO_EMAIL, '=?UTF-8?B?' . base64_encode($SUBJECT) . '?=', $body, implode("\r\n", $headers));