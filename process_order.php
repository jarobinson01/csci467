<?php
    function process_order($quote_id, /*$associate,*/ $cust_id, $price) {
        $url = 'http://blitz.cs.niu.edu/PurchaseOrder/';

        $data = array(
            'order' => $quote_id, 
            'associate' => 'RE-676732',
            'custid' => $cust_id, 
            'amount' => $price);
                
        $options = array(
            'http' => array(
                'header' => array('Content-type: application/json', 'Accept: application/json'),
                'method'  => 'POST',
                'content' => json_encode($data)
            )
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        echo($result."<br>");
    }
?>