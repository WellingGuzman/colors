<?php

/**
 * Throws an exception if the value is not between 0-255
 *
 * @param int $value
 *
 * @throws \Exception
 */
function check_color($value)
{
  if ($value < 0 || $value > 255) {
    throw \Exception(sprintf(
      'invalid RGB Value. %s needs to be between 0-255', $value)
    );
  }
}

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
  check_color($r);
  check_color($g);
  check_color($b);

  $img = imagecreate($w, $h);
  $background = imagecolorallocate($img, $r, $g, $b);

  header('Content-Type: image/png');
  imagepng($img);
  imagecolordeallocate($img, $background);
  imagedestroy($img);
}

/**
 * Dump a image data
 *
 * @param int $w Width
 * @param int $h Height
 * @param int $hex Color in 6 figures hexadecimal
 */
function create_image_hex($w, $h, $hex)
{
  if ($hex[0] === '#') {
    $hex = substr($hex, 1);
  }

  // TODO: Support 3 figures hexadecimal
  list($r, $g, $b) = sscanf(strtolower($hex), "%2x%2x%2x");

  create_image($w, $h, $r, $g, $b);
}
