<?php


$responce = [];

if ($_GET["last_7_days"]) {

    $sdate = date('Y-m-d', strtotime("-5 days"));
    $edate = date('Y-m-d');
    $edate . "<br>";
    $sql = "SELECT * FROM food_order WHERE `food_order`.`date` between '$sdate'
    AND '$edate' GROUP BY `food_order`.`date`";
    $retval = mysqli_query($conn, $sql);
    if (mysqli_num_rows($retval) > 0) {
        $graphData = [];
        $head["date"] = "Opening Move";
        $head["totals"] = "Percentage";
        $graphData[] = $head;
        while ($row = mysqli_fetch_assoc($retval)) {
            $temp = [];
            $temp_date = $row['date'];
            $sqlSum = mysqli_query($conn, "SELECT SUM(`food_order`.`total`) as totals FROM food_order WHERE `food_order`.`date` = '$temp_date'");
            $rowSum = mysqli_fetch_array($sqlSum);
            $temp["date"] = $row['date'];
            $temp['totals'] = (float) $rowSum['totals'];
            $graphData[] = $temp;
        }
    } else {
        echo "0 results";
    }

    echo $last_7_days = json_encode($graphData);
}
