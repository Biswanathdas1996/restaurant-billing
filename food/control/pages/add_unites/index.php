<?php $table_name='units';?><?php include("../../src/config/includes.php"); echo Body::bodyContain($table_name);?>
<!--Write your code here-->

<style>
    #table_list {
        margin-top: 90px;
    }
    #add_form {
        margin-top: 90px;
    }
    #edit_panel {
        margin-top: 90px;
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



<div class="menu_class" style="">
<?php include("../inventory/nav_menu.php"); ?>
</div>

<?php include('../../src/layout/foot.php'); ?>