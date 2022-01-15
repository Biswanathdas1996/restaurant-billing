<?php
include("../../src/config/includes.php");
$table_name = 'food_inventory_items'; ?>

<style>
    #table_list {
        margin-top: 120px;
    }
    #add_form {
        margin-top: 120px;
    }
    #edit_panel {
        margin-top: 120px;
    }

    section.content {
        position: relative;
    }

    .menu_class>div {
        margin: 0 0 30px 0px;
        position: absolute;
        top: 15px;
        left: 0;
    }
</style>




<?php echo Body::bodyContain($table_name); ?>


<div class="menu_class" style="">
    <?php include("../inventory/nav_menu.php"); ?>
</div>



<!--Write your code here-->
<?php include('../../src/layout/foot.php'); ?>