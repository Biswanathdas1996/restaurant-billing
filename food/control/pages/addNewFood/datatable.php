<?php
include("../../src/config/includes.php");
include("../../src/config/connection.php");
echo Layout::APILayout();




$limit = $_REQUEST['length'];
$offset = $_REQUEST['start'];


$totalData = [];

if(isset($_REQUEST["search"]['value']) && $_REQUEST["search"]['value'] !=null){
                    
    $search=$_REQUEST["search"]['value'];
    
    $sql = "SELECT * FROM food_demo WHERE title LIKE '%$search%' LIMIT $limit OFFSET $offset"; 

    $sql_count = "SELECT * FROM food_demo WHERE title LIKE '%$search%'";
    $retval_count = mysqli_query($conn, $sql_count);


} else {

    $sql = "SELECT * FROM `food_demo` ORDER BY `food_demo`.`id` DESC LIMIT $limit OFFSET $offset  ";
    $sql_count = "SELECT * FROM food_demo ";
    $retval_count = mysqli_query($conn, $sql_count);
}

$retval = mysqli_query($conn, $sql);

if (mysqli_num_rows($retval) > 0) {
    while ($row = mysqli_fetch_assoc($retval)) {

        $nestedData = [];

        // onError="this.onerror=null;this.src='default.jpg'"
        
        $nestedData[] = "<img src='./food_demo_img/".$row['img'] ."' style='width: 60px;height: 60px;' onError='this.onerror=null;this.src='default.jpg';' />";
        $nestedData[] = $row['title'];

        $get_category=select("food_category",[
            "conditions"=>[
                "id"=>$row['category']
            ]
        ]);

        

        $nestedData[] = $get_category[0]["name"];
        $nestedData[] = "₹" . $row['price'];

        $get_menu_type=select("food_menu_type",[
            "conditions"=>[
                "id"=>$row['menu_type']
            ]
        ]);
        $nestedData[] = $get_menu_type[0]["name"];
        // $nestedData[] = $row['status'];

      

        
            $nestedData[] = "
            
            <a href='../add-ons/?food_id=" . $row['id'] . "' >
                <button type='button' class='btn' style='border-radius: 0px; background-color: #d9534f00; border-color:#d43f3a00; '>
                    <span style='color:#0046b3eb;font-size: 20px;cursor: pointer;' class='glyphicon glyphicon-plus'></span>
                </button>
            </a>
            

            <a href='edit.php?id=" . $row['id'] . "' >
                <button type='button' class='btn' style='border-radius: 0px; background-color: #d9534f00; border-color:#d43f3a00; '>
                    <span style='color:#0046b3eb;font-size: 20px;cursor: pointer;' class='glyphicon glyphicon-edit'></span>
                </button>
            </a>
            
            <a href='delete.php?id=" . $row['id'] . "' >
            <button type='button' class='btn'  style='border-radius: 0px; background-color: #d9534f00; border-color:#d43f3a00; '>
                <span   style='color:#e60000;font-size: 20px;cursor: pointer;' class='glyphicon glyphicon-trash'></span></button>
                </a>
            ";
  
            
        


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
?>

