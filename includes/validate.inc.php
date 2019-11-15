<?php

/**
 * Validation class
 */
class ValidateInteger
{
  var $int;

  function __construct($num)
  {
    if(preg_match("/^[0-9]+$/", $num, $matches))
    {
      $this->int = $num;
    }
    else
    {
      $this->int = false;
    }
  }

  function getInt()
  {
    return $this->int;
  }
}


 ?>
