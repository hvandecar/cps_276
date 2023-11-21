<?php
require 'Pdo_methods.php';
class FileProc{
  public function init(){
    if(count($_POST) > 0){
      return [$this->errorMess(), $this->displayList()];
    }
    else{
      return ['', $this->displayList()];
    }
  }

  public function errorMess(){
    if(isset($_POST['submitButton'])){
      if(!isset($_POST['name']) | $_POST['name'] == ''){
        return 'No file name was entered';
      }
      elseif($_FILES['formFile']['error'] == 4){
        return 'No file was uploaded. Make sure you choose a file to upload.';
      }
      elseif($_FILES['formFile']['size'] > 1000000 || $_FILES['formFile']['error'] == 1){
        return 'The file is too large';
      }
      elseif ($_FILES['formFile']['type'] != 'application/pdf') {
        return 'PDF files only';
      }
      elseif (!move_uploaded_file($_FILES['formFile']['tmp_name'], "/home/h/v/hvandecar/public_html/pdf_files/{$_POST['name']}.pdf")){
        return 'There was an error adding the record';
      }
      else{
        $pdo = new PdoMethods();
        $sql = "INSERT INTO pdfs (file_name, file_address) VALUES (:name, :fileLoc)";
        /* THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS */
        $bindings = [
          [':name',$_POST['name'],'str'],
          [':fileLoc', '/~hvandecar/pdf_files/' . $_POST['name'] . '.pdf','str'],
        ];
        /* I AM CALLING THE OTHERBINDED METHOD FROM MY PDO CLASS */
        $result = $pdo->otherBinded($sql, $bindings);
        /* HERE I AM RETURNING EITHER AN ERROR STRING OR A SUCCESS STRING */
        if($result === 'error'){
          return 'There was an error adding the name';
        }
        else {
          return 'File has been added';
        }
      }
    }
    return $errorMsg;    
  }

  public function displayList(){
		$pdo = new PdoMethods();
		$sql = "SELECT * FROM pdfs";
		//PROCESS THE SQL AND GET THE RESULTS
		$records = $pdo->selectNotBinded($sql);
		/* IF THERE WAS AN ERROR DISPLAY MESSAGE */
		if($records == 'error'){
			return 'There has been and error processing your request';
		}
		else {
			if(count($records) != 0){
				return $this->createList($records);
			}
			else {
				return 'There are no files to display';
			}
		}
  }

  private function createList($records){
		$list = '<ul>';
    $count = 1;
		foreach ($records as $row){
			$list .= "<li><a target='_blank' href='{$row['file_address']}'>File {$count}</a></li>";
      $count = $count + 1;
		}
		$list .= '</ul>';
		return $list;
	}
}
