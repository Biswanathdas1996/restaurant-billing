<div class="panel panel-default">
    <div class="panel-heading">Order Details</div>
    <div class="panel-body">


        <div class="row">
            <div class="col-md-12" style="margin-bottom:10px">
                Bill No# <b class="text-info"><?php echo $get_order[0]['id']; ?></b>
            </div>
            <div class="col-md-12" style="margin-bottom:10px">
                <?php
                            if ($get_order[0]['order_type'] != 2) { ?>
                    <form class="form-inline" action="" method="post">
                    <label >Table No: </label>
                        <div class="form-group error_class <?php if ($get_order[0]['table_no'] == "") {
                                                                echo "has-error has-feedback";
                                                            } ?>">
                            <input class="form-control " style="width:200px;" type="text" placeholder="Enter Table No" onkeyup="table_shift(this.value);" value="<?php echo $get_order[0]['table_no']; ?>">
                            <?php if ($get_order[0]['table_no'] == "") { ?><span class="glyphicon glyphicon-remove form-control-feedback"></span><?php } ?>
                        </div>
                    </form>
                <?php } else {
                                echo "NA";
                            }
                ?>
            </div>
            <div class="col-md-12" style="margin-bottom:10px">
                Order Type: <b class="text-danger"><?php
                            if ($get_order[0]['order_type'] == 1) {
                                echo "OFFLINE";
                            } else {
                                echo "ONLINE";
                            }
                            ?></b>

            </div>
        </div>
    </div>
</div>


<script>
    function table_shift(new_table_no) {
        $.ajax({
            type: "POST",
            url: "shift_table.php?order_id=" + "<?php echo $order_id; ?>",
            data: {
                table_no: new_table_no
            },
            success: function(result) {
                $(".error_class").removeClass("has-error");
                $(".error_class").removeClass("has-feedback");
                $(".form-control-feedback").hide();
            }
        });
    };
</script>