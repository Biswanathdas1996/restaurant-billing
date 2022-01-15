<?php

$completed_order = select('food_order', [
    "conditions" => [
        "done" => 1
    ]
]);

$pending_order = select('food_order', [
    "conditions" => [
        "done" => 0
    ]
]);


$total_sales = 0;
foreach ($completed_order as $data) {
    $total_sales += $data['total'];
}


$total_active_food_item = select('food_demo', [
    "conditions" => [
        "status" => 1
    ]
]);


$total_qr_scan = select('food_scan_report');

$levelSet = [];
$dataSet = [];



foreach ($total_qr_scan as $date) {
    // echo date('m', $date['time'])."<br>";

    if (date('m', $date['time']) == 1) {
        array_push($levelSet, "January");
    } else if (date('m', $date['time']) == 2) {
        array_push($levelSet, "February");
    } else if (date('m', $date['time']) == 3) {
        array_push($levelSet, "March");
    } else if (date('m', $date['time']) == 4) {
        array_push($levelSet, "April");
    } else if (date('m', $date['time']) == 5) {
        array_push($levelSet, "May");
    } else if (date('m', $date['time']) == 6) {
        array_push($levelSet, "June");
    } else if (date('m', $date['time']) == 7) {
        array_push($levelSet, "July");
    } else if (date('m', $date['time']) == 8) {
        array_push($levelSet, "August");
    } else if (date('m', $date['time']) == 9) {
        array_push($levelSet, "September");
    } else if (date('m', $date['time']) == 10) {
        array_push($levelSet, "October");
    } else if (date('m', $date['time']) == 11) {
        array_push($levelSet, "November");
    } else if (date('m', $date['time']) == 12) {
        array_push($levelSet, "December");
    }
}

$levelSet = array_unique($levelSet);
$levelSet = array_values($levelSet);

$dataGraph = [];

foreach ($levelSet as $month) {

    $tempDataGraph = [];

    $filterBy = date('m', strtotime($month));;

    $tempDataGraph  = array_filter($total_qr_scan, function ($var) use ($filterBy) {
        return (date('m', $var['time']) == $filterBy);
    });

    $dataGraph[] = count($tempDataGraph);
}









$get_all_inv_data = select('food_inventory_add');
$total_expance = 0;
foreach ($get_all_inv_data as $data) {
    $total_expance += $data["amount"];
}


$completed_order_c = select('food_order', [
    "conditions" => [
        "done" => 1
    ]
]);

$total_sales_c = 0;
$total_online_sales=0;
$total_offline_sales=0;


foreach ($completed_order_c as $data_c) {
    $total_sales_c += ($data_c['total'] );

    if($data_c['order_type']==1){
        $total_offline_sales += $data_c['total'];
    }else{
        $total_online_sales+= $data_c['total'] ;
    }

}


// pr($completed_order_c);

