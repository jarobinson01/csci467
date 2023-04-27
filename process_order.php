<?php
    function process_order($quote_id, $associate, $cust_id, $price) {
        include('config.php');
        
        $url = 'http://blitz.cs.niu.edu/PurchaseOrder/';

        $data = array(
            'order' => $quote_id, 
            'associate' => $associate,
            'custid' => $cust_id, 
            'amount' => $price);
                
        $options = array(
            'http' => array(
                'header' => array('Content-type: application/json', 'Accept: application/json'),
                'method'  => 'POST',
                'content' => json_encode($data)
            )
        );

        // Add to external processing system
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        // Grab comission from JSON array
        $data = json_decode($result,true);
        $commission = $data['commission'];

        $commission = str_replace('%', '', $commission) / 100.00;
        $commission = (int)$commission;
        
        // Update process comission percent
        $sql = "SELECT * FROM Processed_Quote WHERE foreign_quote_id = ?;";
        $prepared = $db1->prepare($sql);
        $success = $prepared->execute(array($_SESSION['QUOTE_ID']));
        $processed_quote = $prepared->fetch();

        $sql = "SELECT * FROM Processed WHERE process_id = ?;";
        $prepared = $db1->prepare($sql);
        $success = $prepared->execute(array($processed_quote['foreign_process_id']));
        $processed = $prepared->fetch();

        $sql = "UPDATE Processed SET commission_percent=:pct WHERE process_id=:id;";
        $prepared = $db1->prepare($sql);
        $prepared->execute(array('pct' => $commission, 'id' => $processed['process_id']));

        $sql = "SELECT * FROM Processed WHERE process_id = ?;";
        $prepared = $db1->prepare($sql);
        $success = $prepared->execute(array($processed_quote['foreign_process_id']));
        $processed = $prepared->fetch();

        print_r($processed);

        echo($result."<br>");
    }
?>