<?php
echo "Checking WebP Support...\n";

// Check GD
if (function_exists('gd_info')) {
    $gd_info = gd_info();
    echo "GD WebP Support: " . (isset($gd_info['WebP Support']) && $gd_info['WebP Support'] ? 'Enabled' : 'Disabled') . "\n";
} else {
    echo "GD extension is not installed.\n";
}

// Check Imagick
if (class_exists('Imagick')) {
    $formats = Imagick::queryFormats();
    echo "Imagick WebP Support: " . (in_array('WEBP', $formats) ? 'Enabled' : 'Disabled') . "\n";
} else {
    echo "Imagick extension is not installed.\n";
}
?>
