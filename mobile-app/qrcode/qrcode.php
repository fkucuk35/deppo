<?php

// Include the qrlib file
include 'phpqrcode/qrlib.php';

// $text variable has data for QR 
$text = "150.05.0505.00001";

// QR Code generation using png()
// When this function has only the
// text parameter it directly
// outputs QR in the browser
QRcode::png($text, $text.".png", QR_ECLEVEL_L, 4);
?>