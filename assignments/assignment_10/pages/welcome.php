<?php
require_once 'classes/Pdo_methods.php';
function init(){
  $pdo = new PdoMethods();
  $sql = "SELECT name FROM finalAdmins WHERE email = :email";
  $bindings = [
    [':email', $_SESSION['email'], 'str']
  ];
  
  $records = $pdo->selectBinded($sql, $bindings);

  /** IF THERE WAS AN RETURN ERROR STRING */
  if($records == 'error'){
    return ["<p>There was an error logging it</p>", "<p>a bad one</p>"];
  }
  else{
    if(count($records) != 0){
      return ["<h1>Welcome</h1>", "<p>Welcome {$records[0]['name']}</p>"];
    }
    else{
      return ["<p>There was an error logging it</p>", "<p>a bad one</p>"];
    }
  }
}

?>