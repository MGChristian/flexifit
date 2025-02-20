<?php

use chillerlan\QRCode\{QRCode, QROptions};

require_once __DIR__ . '/vendor/autoload.php';

$data   = '2';
$options = new QROptions;
$options->version      = 7;
$options->outputBase64 = false; // output raw image instead of base64 data URI

header('Content-type: image/svg+xml'); // the image type is SVG by default


echo (new QRCode($options))->render($data);
