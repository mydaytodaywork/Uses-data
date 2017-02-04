<?php
function customError($errno, $errstr) {
  echo "<center><img src=\"images/error.png\"/></center>";
  die();
}
set_error_handler("customError");
?>