  <?php
  include("../../src/config/includes.php");
  include("../../src/config/connection.php");
  echo Layout::APILayout();




  $limit = $_REQUEST['length'];
  $offset = $_REQUEST['start'];


  $totalData = [];

  if(isset($_REQUEST["search"]['value']) && $_REQUEST["search"]['value'] !=null){

    
    $search=$_REQUEST["search"]['value'];
    $get_inventory_items="SELECT * FROM `food_inventory_items` WHERE `name` LIKE '%$search%' ";
    $retval_get_inventory_items = mysqli_query($conn, $get_inventory_items);
      $id_collection =0;
      while ($row_get_inventory_items = mysqli_fetch_assoc($retval_get_inventory_items)) {
        $id_collection = $id_collection.",".$row_get_inventory_items['id'];
      }
    

      $sql = "SELECT * FROM `food_inventory_add` WHERE `item` IN ($id_collection) ORDER BY `food_inventory_add`.`id` DESC LIMIT $limit OFFSET $offset  ";
      $sql_count = "SELECT * FROM `food_inventory_add` WHERE `item` IN ($id_collection) ORDER BY `food_inventory_add`.`id` DESC";
   
   
    // SELECT * FROM `food_inventory_add` WHERE `item` IN (1,2,16) 
  }else if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
    $sdate = $_GET['startDate'];
    $edate = $_GET['endDate'];
    $sql = "SELECT * FROM food_inventory_add 
                            WHERE created between '$sdate'
                        AND '$edate' ORDER BY `food_inventory_add`.`id` DESC LIMIT $limit OFFSET $offset";

    $sql_count = "SELECT * FROM food_inventory_add 
                         WHERE created between '$sdate'
                     AND '$edate' ORDER BY `food_inventory_add`.`id` DESC";
                    
  } else {
    $sql = "SELECT * FROM food_inventory_add ORDER BY `food_inventory_add`.`id` DESC LIMIT $limit OFFSET $offset  ";
    $sql_count = "SELECT * FROM food_inventory_add ORDER BY `food_inventory_add`.`id` DESC";

  }




  $retval_count = mysqli_query($conn, $sql_count);
  $retval = mysqli_query($conn, $sql);
  if (mysqli_num_rows($retval) > 0) {
    while ($row = mysqli_fetch_assoc($retval)) {

      $nestedData = [];
      $get_items = select("food_inventory_items", [
        'conditions' => array(
          "id" => $row['item'],
        ),
        'join' => array(
          'units' => 'unit',
        )
      ]);



      $nestedData[] = $get_items[0]['name'];

      $nestedData[] = $row['qty'] . " " . $get_items[0]["units"]['unit_name'];
      $nestedData[] = $row['amount'];
      $nestedData[] = $row['created'];

      // if ($_SESSION['superaccess'] == 1) {
        $nestedData[] = "<button class='btn btn-danger delete' data='" . $row['id'] . "' ><span class='glyphicon glyphicon-trash'></span></button>";
      // } else {
      //   $nestedData[] = "---";
      // }

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