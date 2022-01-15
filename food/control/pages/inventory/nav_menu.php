

<?php
$actual_links = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>


<div class="col-md-12" style="margin:0 0 30px 0px;">
    <a href="../inventory">
        <button type="button" class="btn <?php if(strpos($actual_links,'pages/inventory') === false){echo "btn-primary";}else{echo "btn-success";}?> btn-lg" style="margin-top: 10px;margin-right:10px;">
            <span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;
            Home</button>
    </a>
    <a href="../stocks">
        <button type="button" class="btn <?php if(strpos($actual_links,'stocks') === false){echo "btn-primary";}else{echo "btn-success";}?> btn-lg" style="margin-top: 10px;margin-right:10px;">
            <span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;
            Add Stock</button>
    </a>
    <a href="../issue">
        <button type="button" class="btn <?php if(strpos($actual_links,'issue') === false){echo "btn-primary";}else{echo "btn-success";}?> btn-lg" style="margin-top: 10px;margin-right:10px;">
            <span class="glyphicon glyphicon-share"></span>&nbsp;&nbsp;
            Issue Stock</button>
    </a>
    <a href="../add_inventory_items">
        <button type="button" class="btn <?php if(strpos($actual_links,'add_inventory_items') === false){echo "btn-primary";}else{echo "btn-success";}?> btn-lg" style="margin-top: 10px;margin-right:10px;">
            <span class="glyphicon glyphicon-indent-right"></span>&nbsp;&nbsp;
            Add Master Items</button>
    </a>
    <a href="../add_unites">
        <button type="button" class="btn <?php if(strpos($actual_links,'add_unites') === false){echo "btn-primary";}else{echo "btn-success";}?> btn-lg" style="margin-top: 10px;margin-right:10px;">
            <span class="glyphicon glyphicon-filter"></span>&nbsp;&nbsp;
            Add Unit Of Measure</button>
    </a>
    <a href="../add_ready_to_serve_items">
        <button type="button" class="btn <?php if(strpos($actual_links,'add_ready_to_serve_items') === false){echo "btn-primary";}else{echo "btn-success";}?> btn-lg" style="margin-top: 10px;margin-right:10px;">
            <span class="glyphicon glyphicon-filter"></span>&nbsp;&nbsp;
            Ready To serve Items</button>
    </a>
</div>