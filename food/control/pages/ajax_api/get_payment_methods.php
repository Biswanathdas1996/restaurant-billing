<?php

    include('../../src/query/query.php'); 
        
    $payment_method=select('payment_methods');
        
        
        
        
    echo json_encode($payment_method);  
        
        

                             
?>