<?php

function html($text)
{
  return htmlspecialchars($text, ENT_QUOTES);
}

function htmlout($text)
{
  echo html($text);
}

function sanitize($text)
{
  $text = html($text);
  $text = trim($text);
  $text= ltrim($text);
  $text = rtrim($text);
  return $text;
}

function sanitizeProductName($pn) {
  // ensure that the product has its name length at least 1 character
  if(mb_strlen($pn) >= 1) {
    return sanitize($pn);
  } else {
    return FALSE;
  }
}


?>
