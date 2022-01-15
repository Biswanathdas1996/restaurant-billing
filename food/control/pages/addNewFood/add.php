<?php $table_name = 'food_demo'; ?>
<?php include("../../src/config/includes.php");
echo Layout::DLayout($table_name);
if (isset($_POST["title"])) {

    $data = array(
        "data" => array(
            "title" => $_POST['title'],
            "category" => $_POST['category'],
            "description" => $_POST['description'],
            "price" => $_POST['price'],
            "veg_or_nonveg" => $_POST['veg_or_nonveg'],
            "menu_type" => $_POST['menu_type'],
        )
    );
    $insert_data = insert('food_demo', $data);
    $errors = array();
    // $file_name = $_FILES['image']['name'];
    if (isset($_FILES)) {
        $file_name = $insert_data;
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
        $extensions = array("jpeg", "jpg", "png");
        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }
        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "food_demo_img/" . $file_name . "." . $file_ext);
            $updata = array(
                "data" => array(
                    "img" => $file_name . "." . $file_ext,
                )
            );
            $update_data = update('food_demo', $updata, $insert_data);
            }
        }



?>
        <script>
            window.location.replace("index.php")
        </script>

<?php

    } else {
        print_r($errors);
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
                                <option value="<?php echo $cat["id"] ?>"><?php echo $cat["name"] ?></option>
                            <?php  } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Description</label>
                        <input type="text" class="form-control" name="description">
                    </div>


                    <label for="email">Price</label>
                    <div class="input-group">
                        <span class="input-group-addon">Rs.</span>
                        <input id="msg" type="number" class="form-control" name="price" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>


                    <div class="form-group">
                        <label>Veg/Non-veg</label>
                        <select class="form-control" name="veg_or_nonveg">
                            <option value="0">Veg</option>
                            <option value="1">Non-Veg</option>

                        </select>
                    </div>



                    <div class="form-group">
                        <label>Menu Type</label>
                        <select class="form-control" name="menu_type" required>
                            <option value="">---Select---</option>
                            <?php
                            foreach ($get_food_menu_type as $food_menu_type) { ?>
                                <option value="<?php echo $food_menu_type["id"] ?>"><?php echo $food_menu_type["name"] ?></option>
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