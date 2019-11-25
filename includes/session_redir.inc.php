<?php

/*
  error.php
  This file contains functions that deal with the processing of errors.
  It also contains the redirection function which redirects to the chosen page or url when desired.
*/

function redirect_session_msg($url, $sess_name, $msg, $arr = true)
{
  /* redirects to the specified url with the name for the session variable stored in $sess_name, and the value of session's variableis stored in $msg
    passing the error to the page.
  */
  if($arr === true)
  {
    $_SESSION["$sess_name"][] = $msg;
    header("Location: $url");
    return;
  }
  else
  {
    $_SESSION["$sess_name"] = $msg;
    header("Location: $url");
    return;
  }
}

 ?>
