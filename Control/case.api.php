<?php
session_start();
include_once('./CaseHandler.php');
$cases = new CaseHandler();

if (isset($_POST)){
  if(isset($_POST['case'])){
    if($_POST['case'] == 'get'){
      if($_SESSION['isadmin'] == TRUE){
        echo json_encode($cases->getCases());
      } else {
        echo json_encode($cases->getCasesById($_SESSION['userid']));
      }
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
