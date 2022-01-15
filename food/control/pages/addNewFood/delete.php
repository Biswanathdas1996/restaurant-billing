<?php $table_name = 'food_demo'; ?>
<?php include("../../src/config/includes.php");
echo Layout::DLayout($table_name);



$delete_data = delete('food_demo', array(
    "id" => $_GET["id"]
));


?>
<script>
    window.location.replace("index.php")
</script>