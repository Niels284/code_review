<?php
function rapportage($subjects) {
    echo '<table>
    <tr><th class="header">subject</th><th class="header">average grade</th></tr>';
    foreach($subjects as $subject => $grades) {
        $average = number_format(array_sum($grades) / count($grades), 1, ',', ' ');
        echo "<tr><td>${subject}</td><td>${average}</td></tr>";
    }
    echo '</table>';
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebTech - rapportage</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .header {
            border-bottom: 1px solid black;
        }

        th, td {
            padding: 0 10px 0 10px;
        }
    </style>
</head>
<body>
    <?php $rapport = rapportage(["Nederlands"=>[5,9,7.2,4.3], "Engels"=>[3,8.2,6.8,4.9], "Wiskunde"=>[8.2,6,9]]); ?>
</body>
</html>

