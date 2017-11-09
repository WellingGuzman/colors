<?php

function create_image($w, $h, $r, $g, $b)
{
  $img = imagecreate($w, $h);
  $background = imagecolorallocate($img, $r, $g, $b);

  header('Content-Type: image/png');
  imagepng($img);
  imagecolorallocate($background);
  imagedestroy($img);
}
