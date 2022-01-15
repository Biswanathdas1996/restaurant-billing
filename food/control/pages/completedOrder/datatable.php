<?php
include("../../src/config/includes.php");
include("../../src/config/connection.php");
echo Layout::APILayout();




$limit = $_REQUEST['length'];
$offset = $_REQUEST['start'];


$totalData = [];

if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
    $sdate = $_GET['startDate'];
    $edate = $_GET['endDate'];
    $sql = "SELECT * FROM food_order 
                            WHERE done = 1 AND date between '$sdate'
                        AND '$edate' ORDER BY `food_order`.`date` DESC LIMIT $limit OFFSET $offset ";

    $sql_count = "SELECT * FROM food_order 
                            WHERE done = 1 AND date between '$sdate'
                        AND '$edate' ";


    $retval_count = mysqli_query($conn, $sql_count);
} else if (isset($_GET['filter']) && $_GET['filter'] != null) {
    $filter = $_GET['filter'];
    if ($filter != "all") {
        $sql = "SELECT * FROM `food_order` WHERE done = 1 AND `payment_method` = $filter ORDER BY `food_order`.`date` DESC LIMIT $limit OFFSET $offset  ";
        $sql_count = "SELECT * FROM food_order WHERE done = 1 AND `payment_method` = $filter";
        $retval_count = mysqli_query($conn, $sql_count);
    } else {
        $sql = "SELECT * FROM `food_order` WHERE done = 1 ORDER BY `food_order`.`date` DESC LIMIT $limit OFFSET $offset  ";
        $sql_count = "SELECT * FROM food_order WHERE done = 1";
        $retval_count = mysqli_query($conn, $sql_count);
    }
} else {
    $sql = "SELECT * FROM `food_order` WHERE done = 1 ORDER BY `food_order`.`date` DESC LIMIT $limit OFFSET $offset  ";
    $sql_count = "SELECT * FROM food_order WHERE done = 1";
    $retval_count = mysqli_query($conn, $sql_count);
}

$retval = mysqli_query($conn, $sql);

if (mysqli_num_rows($retval) > 0) {
    while ($row = mysqli_fetch_assoc($retval)) {

        $nestedData = [];

        $nestedData[] = $row['id'];
        // $nestedData[] = $row['rating'];
        // $nestedData[] = $row['table_no'];
        
        $nestedData[] = "-₹" . $row['indivisual_discount'];
        $nestedData[] = "₹" .$row['packing_charges'];
        $nestedData[] = "₹" .$row['total_charges'];
        $nestedData[] = "₹" . ($row['total']);
        $get_payment_method = select('payment_methods', [
            "conditions" => [
                "id" => $row['payment_method']
            ]
        ]);
        $nestedData[] = $get_payment_method[0]["name"];

        $nestedData[] = $row['date'] . " - " . $row['time'];

        if ($_SESSION['superaccess'] == 1) {
            $nestedData[] = "<form action='../ajax_api/send_invoice.php' class='form-inline'>
                                    <div class='form-group'>
                                        <input type='email' style='width:150px' name='email' placeholder='Enter Email'required/>
                                        <input type='hidden' name='id' value=" . $row['id'] . "'/>
                                    </div>
                                    <button type='submit' class='btn btn-primary'><i class='glyphicon glyphicon-send'></i></button>
                                    
                                    <a href='../../../invoice/download.php?id=" . $row['id'] . "' target='_blank'> <button type='Button' class='btn btn-success'><i class='glyphicon glyphicon-save-file'></i></button></a>
                                
                            
                              
                                <button title='Delete Order' type='button' class='btn btn-danger delete' data='" . $row['id'] . "' table='" . $row['table_no'] . "'><span class='glyphicon glyphicon-trash' style='color: white !important;'></span></button>
                                </form>
                                ";
        } else {
            $nestedData[] = "<form action='../ajax_api/send_invoice.php' class='form-inline'>
                                <div class='form-group'>
                                    <input type='email' style='width:150px' name='email' placeholder='Enter Email'required/>
                                    <input type='hidden' name='id' value=" . $row['id'] . "'/>
                                </div>
                                <button type='submit' class='btn btn-primary'><i class='glyphicon glyphicon-send'></i></button>
                                
                                <a href='../../../invoice/download.php?id=" . $row['id'] . "' target='_blank'> <button type='Button' class='btn btn-success'><i class='glyphicon glyphicon-save-file'></i></button></a>
                            
                        
                            <a href='../order/index.php?id=" . $row['id'] . "'>
                            <button type='button' class='btn btn-warning'><i class='fa fa-eye'></i></button>
                            </a>
                            </form>
                            ";
        }


        $totalData[] = $nestedData;
    }
} else {
}
mysqli_close($conn);



$responce = [];
$responce["draw"] = $_REQUEST['draw'];
$responce["recordsTotal"] = mysqli_num_rows($retval_count);
$responce["recordsFiltered"] = mysqli_num_rows($retval_count);
$responce["data"] = $totalData;
echo json_encode($responce);
