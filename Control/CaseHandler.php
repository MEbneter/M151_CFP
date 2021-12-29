<?php

class CaseHandler {
  private $user = "root";
  private $pass = "";
  private $pdo;
  private $cases = array();

  public function __construct(){
    $this->pdo = new PDO('mysql:host=localhost;dbname=m151cfp', $this->user, $this->pass);
  }

  public function getCases() {
    $this->cases = array();
    $sql = "SELECT * FROM cases";
    foreach ($this->pdo->query($sql) as $row) {
       array_push($this->cases, $row);
    }
    return $this->cases;
  }
  public function getCasesById($id) {
    $this->cases = array();
    $statement = $this->pdo->prepare("SELECT * FROM cases WHERE userid =?");
    $statement->execute(array($id));
    while($row = $statement->fetch()) {
      array_push($this->cases, $row);
    }
    return $this->cases;
  }
  public function changeCaseState($state, $caseid){
    $statement = $this->pdo->prepare("UPDATE cases SET state= ? WHERE caseid=?");
    $statement->execute(array($state, $caseid));
  }
  public function delCase($caseid){
    $statement = $this->pdo->prepare("DELETE FROM cases WHERE caseid=?");
    $statement->execute(array($caseid));
  }
  public function addCase($userid, $casetext){
    $statement = $this->pdo->prepare(
      "INSERT INTO cases (userid, caseText, state)
      VALUES (?, ?, 'todo'); ");
    $statement->execute(array($userid, $casetext));
  }
}
