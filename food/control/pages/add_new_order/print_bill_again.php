<div id="print_bill_again_div">

    <button data-toggle="modal" data-target="#myModalPrintBillAgain" type="button" class="btn btn-warning btn-lg" style="margin-top:10px;">
        <span class='glyphicon glyphicon-file' style='color: white !important;'></span>&nbsp;&nbsp;Modify Order ?</button>

</div>




<!-- Modal -->
<div id="myModalPrintBillAgain" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Main Admin Access Code</h4>
            </div>
            <div class="modal-body">

                <form action="" id="adminPassword">

                    <div class="form-group">

                        <input type="password" class="form-control" id="access_code_data">
                        <span class="text-danger wrong_access_code"></span>
                    </div>

                    <button type="button" class="btn btn-success btn-lg submit_access_code">Submit</button>
                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>



<script>
    let is_bill_prinded = "<?php echo $get_order[0]["is_bill_printed"] ?>";
    if (is_bill_prinded == 1) {
       
        $("#print_bill_again_div").show();
    } else {
        $("#print_bill_again_div").hide();
    }


    $(document).on('click', '.submit_access_code', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "check_access_code.php?code=" + $("#access_code_data").val(),
            success: function(result) {
                if (result == 1) {
                    $(".delete_on_bill_print").show();
                    $("#print_bill_again_div").hide();
                    $("#myModalPrintBillAgain").click();
                    AccessProntBill(0);
                    $(".wrong_access_code").html("");
                    $("#access_code_data").val("")

                } else {
                    $(".wrong_access_code").html("Wrong Access Code");
                }


            }
        });
    });
    // $(document).on('click', '.print_the_bill', function(e) {
    //         // e.preventDefault();
    //         $.ajax({
    //             type: "POST",
    //             url: "restrict_next_bill_print.php?data=1&order_id=<?php echo $order_id; ?>",
    //             success: function(result) {
    //                 $("#invoice_div").hide();

    //             }
    //         });
    //     });
</script>