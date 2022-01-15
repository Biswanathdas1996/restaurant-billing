<?php
include("../../src/config/includes.php");
include("../../src/config/connection.php");
echo Layout::APILayout();

$sdate = $_GET["sdate"];
$edate = $_GET["enddate"];
$item_id = $_GET["item"];




$sql = "SELECT * FROM food_inventory_add  WHERE item ='$item_id' AND created between '$sdate'
  AND '$edate'";
$retval = mysqli_query($conn, $sql);
?>
<center>
    <h2>Item Purchased</h2>
    <table style="width:100%">
        <tr>
            <td style="font-weight: bold;border: 1px solid black;padding:10px;">Item Purchase QTY</td>
            <td style="font-weight: bold;border: 1px solid black;padding:10px;">Purchase Amount</td>
            <td style="font-weight: bold;border: 1px solid black;padding:10px;">Date</td>
        </tr>
        <?php
        if (mysqli_num_rows($retval) > 0) {
            while ($row = mysqli_fetch_assoc($retval)) { ?>
                <tr>
                    <td style="padding-right: 15px;border: 1px solid black;padding:10px;">
                        <?php
                        echo $row['qty'];
                        ?>
                    </td>
                    <td style="padding-right: 15px;border: 1px solid black;padding:10px;">
                        <?php
                        echo $row['amount'];
                        ?>
                    </td>
                    <td style="padding-right: 15px;border: 1px solid black;padding:10px;">
                        <?php
                        echo $row['created'];
                        ?>
                    </td>
                </tr>
            <?php }
        } else {

            ?>
            <tr>
                <td style="margin-top:10px;">No Data</td>
            </tr>

        <?php

        } ?>
    </table>


    <?php

    $sql_issuwe = "SELECT * FROM food_inventory_remove  WHERE item ='$item_id' AND created between '$sdate'
  AND '$edate'";
    $retval_issue = mysqli_query($conn, $sql_issuwe);
    ?>

    <h2>Item Issued</h2>
    <table style="width:100%">
        <tr>
            <td style="font-weight: bold;border: 1px solid black;padding:10px;">Item Issue QTY</td>

            <td style="font-weight: bold;border: 1px solid black;padding:10px;">Date</td>
        </tr>
        <?php
        if (mysqli_num_rows($retval_issue) > 0) {
            while ($row_issue = mysqli_fetch_assoc($retval_issue)) { ?>
                <tr>
                    <td style="padding-right: 15px;border: 1px solid black;padding:10px;">
                        <?php
                        echo $row_issue['qty'];
                        ?>
                    </td>

                    <td style="padding-right: 15px;border: 1px solid black;padding:10px;">
                        <?php
                        echo $row_issue['created'];
                        ?>
                    </td>
                </tr>
            <?php }
        } else { ?>

            <tr>
                <td style="margin-top:10px;">No Data</td>
            </tr>

        <?php  } ?>
    </table>

</center>





</div>
</div>