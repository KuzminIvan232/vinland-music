<?php

function resizeAndCrop($srcPath, $destPath, $size = 250)
{
    [$w, $h, $type] = getimagesize($srcPath);

    $src = imagecreatefromjpeg($srcPath);

    $min = min($w, $h);
    $x = ($w - $min) / 2;
    $y = ($h - $min) / 2;

    $dst = imagecreatetruecolor($size, $size);

    imagecopyresampled(
        $dst, $src,
        0, 0,
        $x, $y,
        $size, $size,
        $min, $min
    );

    imagejpeg($dst, $destPath, 90);

    imagedestroy($src);
    imagedestroy($dst);
}