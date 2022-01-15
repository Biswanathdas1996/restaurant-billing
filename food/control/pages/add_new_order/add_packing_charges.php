<form class="form-inline" method="post" action="index.php?orderid=<?php echo $order_id; ?>">
    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
    <div class="form-group delete_on_bill_print">
        <input type="number" min="0" step=".001" name="packing_charges_amount" class="form-control packing_charges_amount" value="<?php echo $get_order[0]['packing_charges']; ?>" onkeyup="addPackingCharges(this.value);" onchange="addPackingCharges(this.value);" style="width: 191px;">
    </div>
    <button type="button" name="packing_charges" onclick="addDiscount($('.packing_charges_amount').val());" class="btn btn-success btn-lg delete_on_bill_print" style="width:240px">Apply Packing Charges</button>
</form>


<script>
 function addPackingCharges(packing_charges) {
        $.ajax({
            type: "POST",
            url: "add_packing_charges_api.php?order_id=" + "<?php echo $order_id; ?>",
            data: {
                packing_charges_amount: packing_charges
            },
            success: function(result) {
              
                render_amounts();
            }
        });
    };
</script>