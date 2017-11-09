<?php

/**
 * Dump a image data
 *
 * @param int $w Width
 * @param int $h Height
 * @param int $r Red (0-255)
 * @param int $g Green (0-255)
 * @param int $b Blue (0-255)
 */
function create_image($w, $h, $r, $g, $b)
{
  $img = imagecreate($w, $h);
  $background = imagecolorallocate($img, $r, $g, $b);

  header('Content-Type: image/png');
  imagepng($img);
  imagecolordeallocate($img, $background);
  imagedestroy($img);
}
