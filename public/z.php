<?php

// Test Source
function Test11_13() {
    global $answer;

    /* The Test */
    ob_start();
    $t = microtime(true);
    $i = 0;
    while($i < 1000000) {

     print "default-src 'none'; connect-src 'self; script-src 'self' https://*.domain.org 'unsafe-inline' 'unsafe-eval'; style-src 'self' https://*.domain.org 'unsafe-inline'; img-src 'self' data: https://*.domain.org; font-src 'self' https://*.domain.org;";

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
