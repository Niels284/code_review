<?php
    function generateBill(array $orders) {
        $header = ['productsname', 'quantity', 'price'];
        // functions
        function generateHeader($header) {
            echo "<tr>";
            foreach($header as $element) {
                echo "<th class='border_bottom'>${element}</th>";
            }
            echo "</tr>";
        }
        
        function showOrders(array $orders) {
            foreach($orders as $order => $value) {
                echo "<tr><th>${order}</th><td>{$value[1]}</td><td>€" . number_format($value[1] * $value[0], 2, ',', ' ') . "</td></tr>";
            }
        }
        
        function showTotalPrice(array $orders, array $header) {
            $total = 0;
            foreach ($orders as $order) {
                $total += $order[0] * 100 * $order[1];
            }
            echo "<tr><th class='border_top'>Total price</th><td class='border_top'></td>";
            echo "<th class='border_top'>€" . number_format($total / 100, 2, ',', ' ') . "</th></tr>";
        }
        
        // returns bill
        echo "<table>";
        generateHeader($header);
        showOrders($orders);
        showTotalPrice($orders, $header);
        echo "</table>";
    }
    ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebTech - kassabon</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .border_bottom {
            border-bottom: 1px solid black;
        }

        .border_top {
            border-top: 1px solid black;
        }
    </style>
</head>
<body>
    <?php     
        generateBill(['cola'=>[2.9, 3], 'kaasplankje'=>[12, 1], 'kroket'=>[2.40, 2], 'unox'=>[2.70, 6], 'calvé'=>[3.40, 1], 'kruimelvlaai'=>[3.50, 1]]); 
    ?>
</body>
</html>


  
