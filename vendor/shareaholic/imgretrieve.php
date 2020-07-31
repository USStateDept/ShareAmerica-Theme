<?php

// Get and sanitize incoming image source;
$imgName = filter_input(INPUT_GET, 'src', FILTER_SANITIZE_URL);

// Create Header info
header('Content-Type: image/jpeg');

// Name of image is generic
header('Content-Disposition: attachment; filename="ShareAmerica-Shareable.jpg"');

// Requested image to download
readfile($imgName);

?>