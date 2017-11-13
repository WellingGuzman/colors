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
    throw new \Exception(sprintf(
      'invalid RGB Value. %s needs to be between 0-255', $value)
    );
  }
}

/**
 * Gets RGB color from hex
 *
 * @param int $hex
 *
 * @return array
 */
function get_color_from_hex($hex)
{
  if ($hex[0] === '#') {
    $hex = substr($hex, 1);
  }

  $len = strlen($hex);
  if ($len !== 3 && $len !== 6) {
    throw new \Exception('invalid hex value length. 3 or 6 digits allowed');
  }

  if ($len === 6) {
    list($r, $g, $b) = sscanf(strtolower($hex), "%2x%2x%2x");
  } else if ($len === 3) {
    list($r, $g, $b) = sscanf(strtolower($hex), "%1x%1x%1x");

    // Convert the 3 figures hex to decimal
    $r = hexdec(str_repeat(dechex($r), 2));
    $g = hexdec(str_repeat(dechex($g), 2));
    $b = hexdec(str_repeat(dechex($b), 2));
  }

  return [$r, $g, $b];
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
 * @param int $hex Color in 6 or 3 figures hexadecimal
 */
function create_image_hex($w, $h, $hex)
{
  list($r, $g, $b) = get_color_from_hex($hex);

  create_image($w, $h, $r, $g, $b);
}
