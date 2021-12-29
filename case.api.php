<?php
session_start();
include_once('./control/CaseHandler.php');
$cases = new CaseHandler();

if (isset($_POST)){
  if(isset($_POST['case'])){
    if($_POST['case'] == 'get'){
      echo json_encode($cases->getCases());
    }
    if($_POST['case'] == 'del'  && $_SESSION['isadmin'] == TRUE){
      $cases->delCase($_POST['id']);
    }
    if($_POST['case'] == 'add'  && $_SESSION['isadmin'] == TRUE){
      $cases->addCase($_POST['userid'],$_POST['casetext']);
    }
    if($_POST['case'] =='changeState'){
      $cases->changeCaseState($_POST['state'],$_POST['id']);
    }
  }
}
 ?>
