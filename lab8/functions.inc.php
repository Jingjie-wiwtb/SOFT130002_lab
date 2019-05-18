<?php

   
    function outputOrderRow($file, $title, $quantity, $price) {
		
		$amount = $quantity * $price;
		
        echo "<tr>";
     
        echo "<td><img src=".$file."</td><td>".$title."</td><td>".$quantity."</td><td>$".number_format($price,2)."</td><td>$".number_format($amount,2)."</td>";
		
		echo "</tr>";
		
		global $subtotal;
		
		$subtotal += $quantity * $price;
    }
?>