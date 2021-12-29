<?php

class UserHandler {
  private $cfgData;
  private $pdo;
  private $users = array();

  public function __construct(){
    // gets the settings from the config and makes a db-connection
    $cfgData = json_decode(file_get_contents("./config.json"), true);
    $this->pdo = new PDO('mysql:host='.$cfgData['host'].';dbname='.$cfgData['dbname'], $cfgData['user'], $cfgData['pass']);
  }
  // gets the entry of e specific user
  public function checkLogin($name, $passwd) {
    $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username = :name');
    $stmt->execute(['name' => $name]);
    $user = $stmt->fetch();
    return $user;
  }
  // gets userid and username of alle entry's
  public function getUsers() {
    $this->users = array();
    $sql = "SELECT userid, username FROM users";
    foreach ($this->pdo->query($sql) as $row) {
       array_push($this->users, $row);
    }
    return $this->users;
  }
}
