<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
// Test Source
function Test11_13() {
    global $answer;

    /* The Test */
    ob_start();
    $t = microtime(true);
    $i = 0;
    while($i < 1000000) {

     $csp =  "default-src 'none'";
$csp = $csp."; connect-src 'self'";
$csp = $csp."; script-src 'self' https://*.domain.org 'unsafe-inline' 'unsafe-eval'";
$csp = $csp."; style-src 'self' https://*.domain.org 'unsafe-inline'";
$csp = $csp."; img-src 'self' data: https://*.domain.org; font-src 'self' https://*.domain.org";
$csp = $csp.";";

//print $csp;
unset($csp);
        ++$i;
    }
    $tmp = microtime(true) - $t;
    ob_end_clean();

    return $tmp;
}

// Variable Clean-up
function Test11_End() {
    global $answer;
    unset($answer);
}

echo Test11_13();
?>

