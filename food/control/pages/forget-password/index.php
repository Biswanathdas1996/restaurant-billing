<?php include("../../src/config/includes.php");
echo Layout::bodyLayout();

if (isset($_POST["access_code"])) {
    $data = array(
        "data" => array(
            "access_code" => $_POST["access_code"],
        )
    );
    $update_data = update('user', $data, $_SESSION['adminid']);
    pr("Success !! Access Code Reset Successfully");
}

$get_admin = select("user", [
    "conditions" => [
        "id" => $_SESSION['adminid']
    ]
]);








if (isset($_POST["confirm"])) {
    $original_current_password = $get_admin[0]['password'];
    $current_password_given = md5(md5($_SESSION['adminid']) . $_POST["current"]);
    if ($current_password_given == $original_current_password) {
        if ($_POST["new"] == $_POST["confirm"]) {
            $data = array(
                "data" => array(
                    "password" => md5(md5($_SESSION['adminid']) . $_POST["confirm"]),
                )
            );
            $update_data = update('user', $data, $_SESSION['adminid']);
            pr("Success !! Password Reset Successfully");
        } else {
            pr("Sorry !! New & Confirm Password Miss-match");
        }
    } else {
        pr("Sorry !! Current Password Miss-match");
    }
}


?>
<!--Write your code here-->




<div class="panel panel-default">
    <div class="panel-heading">Reset Password</div>
    <div class="panel-body">

        <form action="" method="post">

            <div class="form-group">
                <label for="pwd">Current Password:</label>
                <input type="password" class="form-control" name="current">
            </div>
            <div class="form-group">
                <label for="pwd">New Password:</label>
                <input type="password" class="form-control" name="new">
            </div>
            <div class="form-group">
                <label for="pwd">Confirm Password:</label>
                <input type="password" class="form-control" name="confirm">
            </div>

            <button type="submit" class="btn btn-success btn-lg">Submit</button>
        </form>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">Access Code</div>
    <div class="panel-body">

        <form action="" method="post">

            <div class="form-group">
                <label for="pwd">Code:</label>
                <input type="text" class="form-control" name="access_code" value="<?php echo $get_admin[0]['access_code'] ?>">
            </div>
            

            <button type="submit" class="btn btn-success btn-lg">Update</button>
        </form>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">Backup Data</div>
    <div class="panel-body">

        <center>
            <a href="../../../backup/index.php" download>
                <button type="submit" class="btn btn-success btn-lg" style="float:right">Backup Data</button>
            </a>
        </center>


    </div>
</div>



<?php include('../../src/layout/foot.php'); ?>