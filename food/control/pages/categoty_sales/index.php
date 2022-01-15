<?php
include("../../src/config/includes.php");
include("../../src/config/connection.php");
echo Layout::APILayout();

$sdate = $_GET["sdate"];
$edate = $_GET["enddate"];
$category_id = $_GET["category"];




$sql = "SELECT * FROM food_order_item  WHERE item_category_id ='$category_id' AND date between '$sdate'
  AND '$edate' GROUP BY item_id";
$retval = mysqli_query($conn, $sql);

?>
<center>
<table style="width:100%">
    <tr>
        <td style="font-weight: bold;border: 1px solid black;padding:10px;">Item Name</td>
        <td style="font-weight: bold;border: 1px solid black;padding:10px;">Total QTY</td>
        <td style="font-weight: bold;border: 1px solid black;padding:10px;">Total Amount</td>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($retval)) { ?>

        <tr>
            <td style="padding-right: 15px;border: 1px solid black;padding:10px;">
                <?php
                $get_food = select("food_demo", [
                    "conditions" => [
                        "id" => $row['item_id']
                    ]
                ]);
                echo $get_food[0]["title"];
                ?>
            </td>
            <td style="padding-right: 15px;border: 1px solid black;padding:10px;">
                <?php
                $item = $row['item_id'];
                $sql_iqty = "SELECT SUM(qnt) as iqty FROM food_order_item  WHERE item_id = '$item' AND date between '$sdate'
                    AND '$edate' GROUP BY item_id";
                $retvaliqty = mysqli_query($conn, $sql_iqty);
                $row_sumiqty = mysqli_fetch_assoc($retvaliqty);
                echo $row_sumiqty['iqty'];
                ?>

            </td>
            <td style="padding-right: 15px;border: 1px solid black;padding:10px;">
                <?php
                $item = $row['item_id'];
                $sql_iqtytotalItemPrice = "SELECT SUM(totalItemPrice*qnt) as totalItemPrice FROM food_order_item  WHERE item_id = '$item' AND date between '$sdate'
                    AND '$edate'";
                $retvaliqtytotalItemPrice = mysqli_query($conn, $sql_iqtytotalItemPrice);
                $row_sumiqtytotalItemPrice = mysqli_fetch_assoc($retvaliqtytotalItemPrice);
                echo "₹" . $row_sumiqtytotalItemPrice['totalItemPrice'];
                ?>

            </td>

        </tr>
    <?php } ?>
</table>

</center>





</div>
</div>