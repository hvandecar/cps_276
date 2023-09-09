<?php
require_once 'PdoMethods.php';
class Crud {

    public function getCustomers(){
        $pdo = new PdoMethods();
        
        $sql = "SELECT * FROM customers";

        $records = $pdo->selectNotBinded($sql);

        /* IF THERE WAS AN ERROR DISPLAY MESSAGE */
        if($records == 'error'){
            return 'There has been and error processing your request';
        }
        else {
            if(count($records) != 0){
                return $this->makeTable($records);	
            }
            else {
                return 'no customers found';
            }
        }
    }

    private function makeTable($records){
        $output = "<table class='table table-bordered table-striped'><thead><tr>";
		$output .= "<th>Name</th><th>Address</th><th>City</th><th>State</th><th>Zip</th><th>Country</th><th>Contact</th><th>Email</th></tr><tbody>";
		foreach ($records as $row){
            $output .= "<tr><td>{$row['cust_name']}</td>";
            
            $output .= "<td>{$row['cust_address']}</td>";

            $output .= "<td>{$row['cust_city']}</td>";

            $output .= "<td>{$row['cust_state']}</td>";

            $output .= "<td>{$row['cust_zip']}</td>";

            $output .= "<td>{$row['cust_country']}</td>";

            $output .= "<td>{$row['cust_contact']}</td>";

            $output .= "<td>{$row['cust_email']}</td></tr>";
		}
		
		$output .= "</tbody></table></form>";
		return $output;
    }
}

?>