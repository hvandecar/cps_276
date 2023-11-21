<?php
require 'classes/Pdo_methods.php';
class Date_time{
  public function checkSubmit(){
    if(isset($_POST['submitButton'])){
      if (array_key_exists('dateTime', $_POST)){
        if(!isset($_POST['dateTime']) | !isset($_POST['note']) | $_POST['note'] == ''){
          return "You must enter a date, time and note";
        }
        else{
          $timestamp = strtotime($_POST['dateTime']);
          $pdo = new PdoMethods();
          $sql = "INSERT INTO notes (note_time, note) VALUES (:note_time, :note)";
          /* THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS */
          $bindings = [
            [':note_time',$timestamp,'str'],
            [':note',$_POST['note'],'str'],
          ];
          /* I AM CALLING THE OTHERBINDED METHOD FROM MY PDO CLASS */
          $result = $pdo->otherBinded($sql, $bindings);
          /* HERE I AM RETURNING EITHER AN ERROR STRING OR A SUCCESS STRING */
          if($result === 'error'){
            return 'There was an error adding the name';
          }
          else {
            return 'Note has been added';
          }
        }
      }


      else{
        if(!isset($_POST['begDate']) | !isset($_POST['endDate'])){
          return "You must enter a date, time and note";
        }
        else{
          $beginning = strtotime($_POST['begDate']);
          $ending = strtotime($_POST['endDate']);

		      $pdo = new PdoMethods();
		      $sql = "SELECT * FROM notes WHERE note_time BETWEEN '{$beginning}' and '{$ending}' ORDER BY note_time DESC";
		      $records = $pdo->selectNotBinded($sql);
		      if($records == 'error'){
			      return 'There has been and error processing your request';
		      }
		      else {
			      if(count($records) != 0){
              $list = '<table class="table table-striped table-bordered">
              <thead><tr>
                <th scope="col">Date and Time</th>
                <th scope="col" class="col-lg-6">Note</th>
              </tr></thead><tbody>';
              foreach ($records as $row){
                $newTimeStamp = date('m/d/Y H:i A', $row['note_time']);
                $list .= "<tr>
                <td>{$newTimeStamp}</td>
                <td>{$row['note']}</td></tr>";
              }
              $list .= '</tbody></table>';
              return $list;
			      }
			      else {
				      return 'Please enter dates';
			      }
		      }
        }
      }
    }
    else{
      return;
    }
  }

}
