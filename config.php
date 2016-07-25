<?php
require_once(__DIR__.'/inc/dotenv/Exception/ExceptionInterface.php');
require_once(__DIR__.'/inc/dotenv/Exception/InvalidPathException.php');
require_once(__DIR__.'/inc/dotenv/Loader.php');
require_once(__DIR__.'/inc/dotenv/Dotenv.php');
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

/* =====================================================
Subscribe Options
===================================================== */

// Mailchimp API KEY
$Mailchimp_API_Key = $_ENV['MC_API'];

// Mailchimp List ID
$Mailchimp_List_ID = $_ENV['MC_LID'];

// Mailchimp Double Opt In
$Mailchimp_Double_OptIn = false;

// Mailchimp Send Welcome Message
$Mailchimp_Welcome = false;

/* =====================================================
Contact Form
===================================================== */

// Email address
$Email_Address = 'info@ticowebmedia.cr';

// Subject for Contact Form
$Contact_Form_Subject = 'Fullstack Day Contact Form';

// Subject for Registration Form
$Registration_Form_Subject = 'Fullstack Day Registration Form';
?>
