<?php
session_start();
// session destroyed with timer
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
}
// view retrun conditional on session variables
if (isset($_SESSION['isUser']) && $_SESSION['isUser'] == TRUE){
  if($_SESSION['isadmin'] == TRUE){
    echo file_get_contents('./view/adminView.html');
  } else {
    echo file_get_contents('./view/userView.html');
  }
} else {
  echo file_get_contents('./view/login.html');
}
?>
