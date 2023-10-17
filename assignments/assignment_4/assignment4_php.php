<?php
/*SET THE VALUE OF OUTPUT TO EMPTY STRING SO NOTHING SHOWS WHEN THE PAGE FIRST LOADS*/
class addingNames{
  public function addClearNames(){
    if(isset($_POST['submitButton'])){
      if (str_contains(($_POST['name']), ' ')){
        $workingName = explode(" ", $_POST['name']);
        $currentNames = $_POST['nameCol'] . "\n" . $workingName[1] . ", " . $workingName[0];
        $currentNames = explode("\n", $currentNames);
        for($i = 0; $i < count($currentNames); ++$i){
          sort($currentNames, SORT_STRING | SORT_FLAG_CASE); 
        }
        $output = implode("\n", $currentNames);
      }
      else{
        $output = $_POST['nameCol'];
      }
    }
    else{
      $output = "";
    }
    return $output;
  }
}
