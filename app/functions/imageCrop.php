<?php

function resizeAndCrop($srcPath, $destPath, $size = 250)
{
    [$w, $h] = getimagesize($srcPath);

    if ($w * $h > 12_000_000) {
        die('Зображення занадто велике');
    }

    if ($w > 2000 || $h > 2000) {
        $ratio = min(2000 / $w, 2000 / $h);
        $newW = (int)($w * $ratio);
        $newH = (int)($h * $ratio);

        $src = imagecreatefromjpeg($srcPath);
        $tmp = imagecreatetruecolor($newW, $newH);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newW, $newH, $w, $h);
        imagejpeg($tmp, $srcPath, 85);

        imagedestroy($src);
        imagedestroy($tmp);

        [$w, $h] = getimagesize($srcPath);
    }

    $src = imagecreatefromjpeg($srcPath);

    $min = min($w, $h);
    $x = ($w - $min) / 2;
    $y = ($h - $min) / 2;

    $dst = imagecreatetruecolor($size, $size);
    imagecopyresampled($dst, $src, 0, 0, $x, $y, $size, $size, $min, $min);

    imagejpeg($dst, $destPath, 90);

    imagedestroy($src);
    imagedestroy($dst);
}
