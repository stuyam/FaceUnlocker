<?php

function image_fix_orientation($image, $filename) {
    $image2 = imagerotate($image, array_values([0, 0, 0, 180, 0, 0, -90, 0, 90])[@exif_read_data($filename)['Orientation'] ?: 0], 0);
    return $image2;
}
