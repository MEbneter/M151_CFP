<?php

class UserHandler {
  private $user = "root";
  private $pass = "";
  private $pdo;
  private $users = array();

  public function __construct(){
    $this->pdo = new PDO('mysql:host=localhost;dbname=m151cfp', $this->user, $this->pass);
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
