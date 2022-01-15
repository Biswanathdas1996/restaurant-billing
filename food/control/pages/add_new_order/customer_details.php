<div class="panel panel-default">
    <div class="panel-heading">Customer's Details
    </div>
    <div class="panel-body">
        <center>
            <form class="form" method="post" action="index.php?orderid=<?php echo $order_id; ?>">
                <div class="form-group" style="margin-bottom:5px;">
                  
                    <input type="text" class="form-control addCustomercontact" name="contact" placeholder="Contact Number" value="<?php echo $get_Customer[0]['contact']; ?>">
                </div>
                <div class="form-group" style="margin-bottom:5px;">
                    
                    <input type="text" class="form-control addCustomercontact" name="name" placeholder="Customer Name" value="<?php echo $get_Customer[0]['name']; ?>">
                </div>
                <div class="form-group" style="margin-bottom:5px;">
                    
                    <input type="email" class="form-control addCustomercontact" name="email" placeholder="Contact Email" value="<?php echo $get_Customer[0]['email']; ?>">
                    <!-- <input type="text" class="form-control addCustomercontact" name="remark" placeholder="Remark" value="<?php echo $get_Customer[0]['remark']; ?>"> -->
                </div>
            </form>
        </center>
    </div>
</div>