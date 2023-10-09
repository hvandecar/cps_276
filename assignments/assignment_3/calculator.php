<?php
class Calculator {
  public function calc($oper="error", $num1="error", $num2="error"){
    if (!(is_string($oper)) or !(is_int($num1)) or !(is_int($num2))) {
      return "You must enter a string and two numbers<br>";
    }
    switch ($oper){
      case "+":
        return "The sum of the numbers is " . $num1 + $num2 . "<br>";
        break;
      case "-":
        return "The difference of the numbers is " . $num1 - $num2 . "<br>";
        break;
      case "/":
        if ($num2 == 0) {
          return "Cannot divide by zero<br>";
        }
        return "The division of the numbers is " . $num1 / $num2 . "<br>";
        break;
      case "*":
        return "The product of the numbers is " . $num1 * $num2 . "<br>";
        break;
    }
  }
}

?>