<?php

class CaseHandler {
  private $cfgData;
  private $pdo;
  private $cases = array();

  public function __construct(){
    $cfgData = json_decode(file_get_contents("./config.json"), true);
    $this->pdo = new PDO('mysql:host='.$cfgData['host'].';dbname='.$cfgData['dbname'], $cfgData['user'], $cfgData['pass']);
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

$blub = new CaseHandler();
