<?php

class UserHandler {
  private $cfgData;
  private $pdo;
  private $users = array();

  public function __construct(){
    $cfgData = json_decode(file_get_contents("./config.json"), true);
    $this->pdo = new PDO('mysql:host='.$cfgData['host'].';dbname='.$cfgData['dbname'], $cfgData['user'], $cfgData['pass']);
  }

  public function checkLogin($name, $passwd) {
    $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username = :name');
    $stmt->execute(['name' => $name]);
    $user = $stmt->fetch();
    return $user;
  }
  public function getUsers() {
    $this->users = array();
    $sql = "SELECT userid, username FROM users";
    foreach ($this->pdo->query($sql) as $row) {
       array_push($this->users, $row);
    }
    return $this->users;
  }
}
