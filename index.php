<?php

$lc = "";

if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
    $lc = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}

// Now we simply evaluate that variable to detect specific languages
if($lc == "es"){
    header("location: /es");
    exit();
}

header("location: /en");

?>