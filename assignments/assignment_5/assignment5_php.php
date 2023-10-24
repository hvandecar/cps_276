<?php

class addingFile{
  public function newAddingFile(){
    $msg = "";
    if(isset($_POST['submitButton'])){
      $newDirLoc = "/home/h/v/hvandecar/public_html/directories/" . $_POST['name'];
      if (file_exists($newDirLoc)){
        $msg = 'A directory already exists with that name.<br><br>';
      }
      else{
        // this is setting the directory
        mkdir($newDirLoc, 0777);
        $temp = $newDirLoc . "/readme.txt";
        touch($temp);
        $contentWrite = fopen($temp, "r+");
        fwrite($contentWrite, $_POST['content']);
        fclose($contentWrite);
        $msg = 'Directory Created<br><p><a href="../../../../~hvandecar/directories/' . $_POST['name'] . '/readme.txt" target="_blank">Path where file is located</a></p>';
      }
    }    
    return $msg;
  }
}
