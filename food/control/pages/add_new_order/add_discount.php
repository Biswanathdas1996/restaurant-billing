<form class="form-inline" method="post" action="index.php?orderid=<?php echo $order_id; ?>">
    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
    <input type="hidden" name="item_total" value="<?php echo $get_order[0]['sub_total']; ?>">
    <div class="input-group delete_on_bill_print">
        <input class="form-control apply_discount_class" type="number" min="0" max="100" step=".001" name="indivisual_discount_amount" onkeyup="addDiscount(this.value);" onchange="addDiscount(this.value);" value="<?php echo $get_order[0]['indivisual_discount_percent']; ?>" style="border-radius: 5px 0px 0px 5px !important;width: 154px;">
        <span class="input-group-addon">%</span>
    </div>
    <button type="button" name="indivisual_discount" onclick="addDiscount($('.apply_discount_class').val());" class="btn btn-warning btn-lg delete_on_bill_print" style="width:240px" >Apply Discount</button>
</form>


<script>
 function addDiscount(indivisual_discount_amount) {
        $.ajax({
            type: "POST",
            url: "add_discount_api.php?order_id=" + "<?php echo $order_id; ?>",
            data: {
                indivisual_discount_amount: indivisual_discount_amount
            },
            success: function(result) {
              
                render_amounts();
            }
        });
    };
</script>