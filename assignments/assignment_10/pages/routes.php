<?php
require_once 'classes/Pdo_methods.php';
$path = "index.php?page=login";

session_start();
if(isset($_SESSION['access'])){
  $pdo = new PdoMethods();
  $sql = "SELECT status FROM finalAdmins WHERE email = :email";
  $bindings = [
    [':email', $_SESSION['email'], 'str']
  ];
    
  $records = $pdo->selectBinded($sql, $bindings);
  $_SESSION['records'] = $records;

  if($records == 'error'){
    return createLogin("<p>There was an error logging it</p>", $elementsArr);
  }
  else{
    if(count($records) != 0){
      if($_SESSION['records'][0]['status'] == "admin"){
        $nav=<<<HTML
          <nav>
            <ul class="nav gx-5">
              <li class="nav-item p-3"><a href="index.php?page=addContact">Add Contact</a></li>
              <li class="nav-item p-3"><a href="index.php?page=deleteContacts">Delete Contact(s)</a></li>
              <li class="nav-item p-3"><a href="index.php?page=addAdmin">Add Admin</a></li>
              <li class="nav-item p-3"><a href="index.php?page=deleteAdmins">Delete Admin(s)</a></li>
              <li class="nav-item p-3"><a href="index.php?page=logout">Logout</a></li>
            </ul>
          </nav>
        HTML;
      }
      else{
        $nav=<<<HTML
          <nav>
            <ul class="nav gx-5">
              <li class="nav-item p-3"><a href="index.php?page=addContact">Add Contact</a></li>
              <li class="nav-item p-3"><a href="index.php?page=deleteContacts">Delete Contact(s)</a></li>
              <li class="nav-item p-3"><a href="index.php?page=logout">Logout</a></li>
            </ul>
          </nav>
        HTML;
      }
    }
  }
}
else {
  $nav = '';
}


if(isset($_GET)){
  if($_GET['page'] === "login" OR !isset($_SESSION['records'][0]['status'])){
    require_once('login.php');
    $result = init();
  }   
  else if($_GET['page'] === "welcome" & ($_SESSION['records'][0]['status'] == "admin" OR $_SESSION['records'][0]['status'] == "staff")){
    require_once('pages/welcome.php');
    $result = init();
  }
  else if($_GET['page'] === "addContact" & ($_SESSION['records'][0]['status'] == "admin" OR $_SESSION['records'][0]['status'] == "staff")){
    require_once('pages/addContact.php');
    $result = init();
  }
  else if($_GET['page'] === "deleteContacts"  & ($_SESSION['records'][0]['status'] == "admin" OR $_SESSION['records'][0]['status'] == "staff")){
    require_once('pages/deleteContacts.php');
    $result = init();
  }
  else if($_GET['page'] === "addAdmin" & $_SESSION['records'][0]['status'] == "admin"){
    require_once('pages/addAdmin.php');
    $result = init();
  }
  else if($_GET['page'] === "deleteAdmins" & $_SESSION['records'][0]['status'] == "admin"){
    require_once('pages/deleteAdmins.php');
    $result = init();
  }
  else if($_GET['page'] === "logout"){
    require_once('logout.php');
    $result = init();
  }
  else {
    header("location: index.php?page=logout");
  }
}
else {
  header('location: '.$path);
}







// <?php
// require_once 'classes/Pdo_methods.php';

// class Admin extends PdoMethods {

// 	public function init($page) {
// 		if($page == "index"){
// 			if(isset($_POST['email'])){
// 				return $this->login();
// 			}
// 		}
// 		else if($page == "home"){
// 			//SECURITY RETURNS TRUE IF USER HAS ACCESS TO PAGE
// 			if($this->security()){
// 				return $this->displayUsernamePassword();
// 			}
			
// 		}
// 		else if($page == "addAdmin"){
// 			//SECURITY RETURNS TRUE IF USER HAS ACCESS TO PAGE
// 			if($this->security()){
// 				//IF THE ADDADMIN BUTTON IS CLICKED THEN RUN THE ADDADMIN METHOD
// 				if(isset($_POST['addAdmin'])){
// 					return $this->addAdmin();
// 				}
// 			}

// 		}
// 	}

// 	//BECAUSE THE HOME, ADMIN, AND LOGOUT PAGES ARE BY ACCESS ONLY WE HAVE TO RUN THE SECURITY SCRIPT FIRST.
// 	private function security(){
// 		session_start();
// 		if($_SESSION['access'] !== "accessGranted"){
// 		  header('location: index.php');
// 		}
// 		else {
// 			return true;
// 		}
		
// 	}
	
// 	private function login(){
	   
// 	    $pdo = new PdoMethods();
// 	    $sql = "SELECT email, password FROM admin WHERE email = :email";
		
// 		$bindings = [
// 			[':email', $_POST['email'], 'str']
// 		];
		
// 		$records = $pdo->selectBinded($sql, $bindings);

// 		/** IF THERE WAS AN RETURN ERROR STRING */
// 		if($records == 'error'){
// 			return "There was an error logging it";
// 		}
		
// 		else{
// 			if(count($records) != 0){
// 	            /** IF THE PASSWORD IS NOT VERIFIED USING PASSWORD_VERIFY THEN RETURN FAILED, OTHERWISE RETURN SUCCESS, IF NO RECORDS ARE FOUND RETURN NO RECORDS FOUND. */
// 	            if(password_verify($_POST['password'], $records[0]['password'])){
// 	                session_start();
// 	                $_SESSION['access'] = "accessGranted";
// 	                header("location: home.php");
// 	            }
// 	            else {
// 	                return "There was a problem logging in with those credentials";
// 	            }
// 			}
// 			else {
// 				return "There was a problem logging in with those credentials";
// 			}
// 		}
// 	}

// 	private function addAdmin(){
// 	    $pdo = new PdoMethods();

// 		if($_POST['username'] == "" || $_POST['password'] == ""){
// 			return "You must enter a username and password";
// 		}

// 	    $sql = "SELECT username FROM admin WHERE username = :username";
		
// 		$bindings =  [
// 			[':username', $_POST['username'], 'str']
// 		];
		
// 	    $records = $pdo->selectBinded($sql, $bindings);

// 		/** IF THERE WAS AN RETURN ERROR STRING */
// 		if($records == 'error'){
// 			return 'There was an error processing your request';
// 		}
		
// 		/** CHECK FOR A DUPLICATE USERNAME IF FOUND THEN RETURN DUPLICATE OTHERWISE ADD USERNAME AND PASSWORD TO DATABASE */
// 		else{
// 			if(count($records) != 0){
// 	            return "There is already someone with that username";
// 			}
// 			else {
// 				/** ENCRYPT THE PASSWORD USING PASSWORD_HASH */
// 				$password = password_hash($_POST['password'], PASSWORD_DEFAULT);


// 				$sql = "INSERT INTO admin (username, password) VALUES (:username, :password)";

// 				$bindings = [
// 					[':username', $_POST['username'], 'str'],
// 					[':password', $password, 'str']
// 				];
				
// 				$result = $pdo->otherBinded($sql, $bindings);
// 				if($result = 'noerror'){
// 					return 'Admin added';
// 				}
// 				else {
// 					return 'There was a problem adding this administrator';
// 				}
// 			}
// 		}
// 	}

// 	private function displayUsernamePassword(){
// 		$pdo = new PdoMethods();
// 		$sql = "SELECT username, password FROM admin";
// 		$records = $pdo->selectNotBinded($sql);
// 		$result = '';

// 		/* IF THERE WAS AN ERROR DISPLAY MESSAGE*/
// 		if($records == 'error'){
// 		    return 'There has been and error processing this request';
// 		}

// 		/** IF USERNAMES AND PASSWORDS ARE FOUND DISPLAY THEM OTHERWISE DISPLAY NO RECORDS FOUND MESSAGE */
// 		else{
// 		    if(count($records) != 0){
// 		        $result = "<ul>";
// 		        foreach($records as $row){
// 		            $result .= "<li>{$row['username']} -- {$row['password']}</li>";
// 		        }
// 		        $result .= "</ul>";

// 		        return $result;
// 		    }
// 		    else {
// 		        return "No records found";
// 		    }
// 		}
// 	}
// }

// ?>