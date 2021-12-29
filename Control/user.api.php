<?php
session_start();
include_once('./UserHandler.php');
$users = new UserHandler();
if(isset($_POST)){
  if (isset($_POST['user'])){
    // login logic, login validation, setting session-variables
    if(isset($_POST['passwd'])){
      $uInfo = $users->checkLogin($_POST['user'], $_POST['passwd']);
      if($_POST['user'] == $uInfo['username'] && $_POST['passwd'] == $uInfo['passwd']){
        $_SESSION['isUser'] = TRUE;
        $_SESSION['userid'] = $uInfo['userid'];
        $_SESSION['isadmin'] = $uInfo['isadmin'];
        $_SESSION['LAST_ACTIVITY'] = time();
        $userInfo = array('isadmin'=>$_SESSION['isadmin'], 'isUser'=> $_SESSION['isUser'], 'userid'=> $_SESSION['userid']);
        echo json_encode($userInfo);
      }
    }
    // getting user session data
    if($_POST['user'] == 'get'){
      $userInfo = array(
        'isadmin'=>$_SESSION['isadmin'],
        'isUser'=> $_SESSION['isUser'],
        'userid'=> $_SESSION['userid']
      );
      echo json_encode($userInfo);
    }
    // gettin all user data
    if($_POST['user'] == 'getAll' && $_SESSION['isadmin'] == TRUE){
      echo json_encode($users->getUsers());
    }
    // manual logout
    if($_POST['user'] == 'logout'){
      session_unset();
      session_destroy();
    }
  }
}

?>
