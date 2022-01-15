<?php $table_name = 'food_demo'; ?>
<?php include("../../src/config/includes.php");
echo Layout::DLayout($table_name);

$id=$_GET["id"];
$get_data=select("food_demo",[
    "conditions"=>[
        "id"=>$id,
    ]
]);
// pr($get_data);




if (isset($_POST["title"])) {

    $updata_data = array(
        "data" => array(
            "title" => $_POST['title'],
            "category" => $_POST['category'],
            "description" => $_POST['description'],
            "price" => $_POST['price'],
            "veg_or_nonveg" => $_POST['veg_or_nonveg'],
            "menu_type" => $_POST['menu_type'],
        )
    );
    
    $update_datas = update('food_demo', $updata_data, $id);

    if(isset($_FILES["image"]['name']) && $_FILES["image"]['name'] != ""){
        // pr($_FILES["image"]);

        $path="food_demo_img/".$get_data[0]["img"];
        $errors = array();
        $file_name = $id."_".time();
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
        $extensions = array("jpeg", "jpg", "png");
        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }
        if(file_exists($path)){
        //    unlink("$path");
        }
        move_uploaded_file($file_tmp, "food_demo_img/" . $file_name . "." . $file_ext);
            $updata = array(
                "data" => array(
                    "img" => $file_name . "." . $file_ext,
                )
            );
            $update_data = update('food_demo', $updata, $id);
    }
   



        ?>
        <script>
        window.location.replace("index.php")
        </script>

        <?php 

    
}





$get_category = select('food_category');
$get_food_menu_type = select('food_menu_type');
?>

<div class="container">
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">Add Food</div>
            <div class="panel-body">

                <form action="" method="post" enctype="multipart/form-data">


                    <div class="form-group">
                        <label for="sel1">Select Category</label>
                        <select class="form-control" id="sel1" name="category" required>
                            <option value="">---Select---</option>
                            <?php
                            foreach ($get_category as $cat) { ?>
                                <option value="<?php echo $cat["id"] ?>"  <?php  if($get_data[0]['category'] ==$cat["id"] ) {echo "selected";}?>><?php echo $cat["name"] ?></option>
                            <?php  } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email">Title</label>
                        <input value="<?php echo $get_data[0]['title']; ?>" type="text" class="form-control" name="title" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Description</label>
                        <input type="text" value="<?php echo $get_data[0]['description']; ?>" class="form-control" name="description">
                    </div>


                    <label >Price</label>
                    <div class="input-group">
                        <span class="input-group-addon">Rs.</span>
                        <input type="number" min="0" step=".01" value="<?php echo $get_data[0]['price']; ?>" class="form-control" name="price" >
                    </div>
                    <br>
                    <img src="./food_demo_img/<?php echo $get_data[0]['img'];?>" style="width: 100px;height: 100px;"/>
                    <div class="form-group">
                        <label for="email">Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>


                    <div class="form-group">
                        <label>Veg/Non-veg</label>
                        <select class="form-control" name="veg_or_nonveg">
                            <option value="0" <?php  if($get_data[0]['veg_or_nonveg'] ==0 ) {echo "selected";}?>>Veg</option>
                            <option value="1" <?php  if($get_data[0]['veg_or_nonveg'] ==1 ) {echo "selected";}?>>Non-Veg</option>

                        </select>
                    </div>



                    <div class="form-group">
                        <label>Menu Type</label>
                        <select class="form-control" name="menu_type" required>
                            <option value="">---Select---</option>
                            <?php
                            foreach ($get_food_menu_type as $food_menu_type) { ?>
                                <option  value="<?php echo $food_menu_type["id"] ?>" <?php  if($get_data[0]['menu_type'] ==$food_menu_type["id"] ) {echo "selected";}?>><?php echo $food_menu_type["name"] ?></option>
                            <?php  } ?>
                        </select>
                    </div>

                    <a href="index.php">
                    <button type="button" class="btn btn-primary btn-lg">Back</button>
                    </a>

                    <button type="submit" class="btn btn-success btn-lg">Submit</button>
                   
                </form>

            </div>
        </div>

    </div>
</div>




<script type="text/javascript">
    $("#sel1").chosen();
</script>
<?php



include('../../src/layout/foot.php');
?>