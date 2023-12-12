<?php
require_once 'classes/Pdo_methods.php';
require_once 'classes/StickyForm.php';
$stickyForm = new StickyForm();

function init() {
  global $elementsArr, $stickyForm;;
  if(isset($_POST['email'])){
    $postArr = $stickyForm->validateForm($_POST, $elementsArr);
    if($postArr['masterStatus']['status'] == "noerrors"){
      return login();
    }
    else{
      return ["<h1>Login</h1>", createLogin($postArr)];
    }
  }
  else {
    return ["<h1>Login</h1>", createLogin($elementsArr)];
  } 
}

$elementsArr = [
  "masterStatus"=>[
    "status"=>"noerrors",
    "type"=>"masterStatus"
  ],
  "email"=>[
    "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Email cannot be blank and must be written as a proper email</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"hvandecar@admin.com",
    "regex"=>"email"
  ],
  "password"=>[
    "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Password cannot be blank and must be valid</span>",
    "errorOutput"=>"",
    "type"=>"password",
    "value"=>"password",
    "regex"=>"password"
  ]
];

function login(){
  global $elementsArr;
  $pdo = new PdoMethods();
  $sql = "SELECT email, password, name FROM finalAdmins WHERE email = :email";
  
  $bindings = [
    [':email', $_POST['email'], 'str']
  ];
  
  $records = $pdo->selectBinded($sql, $bindings);

  /** IF THERE WAS AN RETURN ERROR STRING */
  if($records == 'error'){
    return createLogin("<p>There was an error logging it</p>", $elementsArr);
  }
  else{
    if(count($records) != 0){    
      /** IF THE PASSWORD IS NOT VERIFIED USING PASSWORD_VERIFY THEN RETURN FAILED, OTHERWISE RETURN SUCCESS, IF NO RECORDS ARE FOUND RETURN NO RECORDS FOUND. */
      if(password_verify($_POST['password'], $records[0]['password'])){
        session_start();
        $_SESSION['access'] = "accessGranted";
        $_SESSION['email'] = $_POST["email"];
        #print($records['name']);
        header("location: index.php?page=welcome");
      }
      else {
        return ["<h1>Login</h1><p>Login credentials incorrect</p>", createLogin($elementsArr)];
      }
    }
    else{
      return ["<h1>Login</h1><p>Login credentials incorrect</p>", createLogin($elementsArr)];
    }
  }
}

function createLogin($elementsArr){
  $form = <<<HTML
    <form action="index.php?page=login" method="post">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="email">Email {$elementsArr['email']['errorOutput']}</label>
          <input type="text" class="form-control" name="email" value="{$elementsArr['email']['value']}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="password">Password {$elementsArr['password']['errorOutput']}</label>
          <input type="password" class="form-control" name="password" value="{$elementsArr['password']['value']}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <input type="submit" class="btn btn-primary" name="login" value="Login">
        </div>
      </div>
    </div>
    </form>
  HTML;
  return $form;
  
}
