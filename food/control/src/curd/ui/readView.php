<div  id="table_list">
    <div class="panel panel-default" style="border-radius:0px;width:auto;">
    <div class="panel-heading" style="padding: 20px 15px;">
        <b ><?php echo ucfirst(str_replace("_"," ",$table_name)); ?> data</b>
        <?php if($table_name=="food_settings" || $table_name== "food_invoice_info" || $table_name== "food_table"){}
        else if($table_name=="food_inventory_add" ){?>
        
            <a href="../add_stock">
             <button type="button" class="btn btn-primary btn-lg"  style="float: right;margin: -12px -8px;border-radius: 0px;"><span class="glyphicon glyphicon-plus"></span> Add New</button>
            </a>
        
        <?php }
        else{?>
        <button type="button" class="btn btn-primary btn-lg" id="add_new" style="float: right;margin: -12px -8px;border-radius: 0px;"><span class="glyphicon glyphicon-plus"></span> Add New</button>
        <?php }?>
    </div>
    <div class="panel-body scr_mob">
        <div class="">
       <table class="table table-hover" id="mytable" style="width:100%;border: 1px solid #e8e7e7;margin-bottom: 5px;">
          <thead style="background: #f7f4f46e;width:auto;">
            <tr>
                <th>Serial</th>
            <?php  foreach($form_data as $value){ ?>
            <th><?php echo ucfirst(str_replace("_"," ",$value)); ?></th>
            <?php } ?>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php 
          $sql = "SELECT * FROM `$table_name` ORDER BY `id` DESC";  
            $retval=mysqli_query($conn, $sql);  
                if(mysqli_num_rows($retval) > 0){ 
                    $serial=1;
                    while($row = mysqli_fetch_assoc($retval)){?> 
                <tr>
                     <td style="text-align:center;"><?php echo $serial;?></td>
                       <?php  
                            foreach($form_data as $value){ ?> 
                        <td>
                       
                           <?php if(($value=="img" || $value=="image" || $value=="images" || $value=="logo") && $row[$value]){?>
                           <img src="<?php echo $table_name."_".$value."/".$row[$value];?>" title="Path -> <?php echo $table_name."_".$value."/".$row[$value];?>" class="img-thumbnail" style="height: 50px; width:auto;">
                           <?php }
///////////////////////////////////////////////////////////////////////////////                          
                           else if(($value=="type" && $table_name=="food_tax_charges")){
                                   if($row[$value]==0){echo "Percentage (%)";}else if($row[$value]==1){ echo "Fixed";}
                           }
////////////////////////////////////////////////////////////////////////////////                          
                           else if(($value=="charge_or_discount" && $table_name=="food_tax_charges")){
                                   if($row[$value]==0){echo "Add to Invoice";}else if($row[$value]==1){ echo "Discount";}
                           }
///////////////////////////////////////////////////////////////////////////////
                           else if(($value=="direct_menu" && $table_name=="food_settings")){
                                   if($row[$value]==0){echo "QR to Website";}else if($row[$value]==1){ echo "QR to Menu";}
                           }
                           else if(($value=="send_sms_notifications" && $table_name=="food_settings")){
                                   if($row[$value]==0){echo "Inactive";}else if($row[$value]==1){ echo "Active";}
                           }
                           else if(($value=="send_email_notifications" && $table_name=="food_settings")){
                                   if($row[$value]==0){echo "Inactive";}else if($row[$value]==1){ echo "Active";}
                           }
///////////////////////////////////////////////////////////////////////////////
                            else if($value=="status"){
                                if($row[$value]==1){
                                    echo "<span class='green_dot'> </span>&nbsp;Active";
                                }else{
                                 echo "<span class='red_dot'></span>&nbsp;Inactive";  
                                }
                            }
///////////////////////////////////////////////////////////////////////////////
                            else if($value=="special" && $table_name=="food_demo"){
                               if($row[$value]==1){
                                   echo "Yes";
                               }else{
                                   echo "No";
                               }
                           }
                           
///////////////////////////////////////////////////////////////////////////////
                            else if($value=="item" && ($table_name=="food_inventory_add" || $table_name=="food_inventory_remove")){
                                $get_item=select("food_inventory_items",[
                                          'conditions'=>array(
                                                "id"=>$row[$value],
                                            ),
                                        'join' =>array(
                                                'units'=>'unit',
                                            )
                                          ]);
                                      
                                echo $get_item[0]["name"]." (".$get_item[0]['units']['unit_name'].")";
                           }
 ///////////////////////////////////////////////////////////////
 else if($value=="employee_id"){
    $get_item=select("employee_data",[
              'conditions'=>array(
                    "id"=>$row[$value],
                )
              ]);
          
    echo $get_item[0]["name"]." (XXXX".$get_item[0]['id'].")";
}                          
///////////////////////////////////////////////////////////////////////////////
                            else if($value=="veg_or_nonveg" && $table_name=="food_demo"){
                               if($row[$value]==1){
                                   echo "Non-veg";
                               }else{
                                   echo "Veg";
                               }
                           }
///////////////////////////////////////////////////////////////////////////////
                            else if($value=="ready_to_serve" && $table_name=="food_inventory_items"){
                               if($row[$value]==1){
                                   echo "Yes";
                               }else{
                                   echo "No";
                               }
                           }
///////////////////////////////////////////////////////////////////////////////
                            else if($value=="category" && $table_name=="food_demo"){
                                $get_single_category=select('food_category',array(
                                        'conditions'=>array(
                                                "id"=>$row[$value],
                                            )
                                    ));
                                echo $get_single_category[0]["name"];
                            }
///////////////////////////////////////////////////////////////////////////////
                            else if($value=="food_demo_id"){
                                $get_single_category=select('food_demo',array(
                                        'conditions'=>array(
                                                "id"=>$row[$value],
                                            )
                                    ));
                                echo $get_single_category[0]["title"];
                            }
///////////////////////////////////////////////////////////////////////////////
                            else if($value=="food_inventory_item_id"){
                                $get_single_category=select('food_inventory_items',array(
                                        'conditions'=>array(
                                                "id"=>$row[$value],
                                            )
                                    ));
                                echo $get_single_category[0]["name"];
                            }
///////////////////////////////////////////////////////////////////////////////
                            else if($value=="unit"){
                                $get_unit=select('units',array(
                                        'conditions'=>array(
                                                "id"=>$row[$value],
                                            )
                                    ));
                                echo $get_unit[0]["unit_name"];
                            }

///////////////////////////////////////////////////////////////////////////////
                           else{
                           echo $row[$value];
                           }
                           ?>
                        </td> 
                        <?php  }?>
                        <td>
                            <table>
                                <tr>
                                     <td>
                                    <?php 
                                     if($table_name=="food_demo"){?>
                                        
                                        <a href="../add-ons/?food_id=<?php echo $row['id'];?>">
                                            <button type="button" class="btn " title="Add Add-ons to this food" style="border-radius: 0px; background-color: #d9534f00; border-color:#d43f3a00; ">
                                                <span type="button" title="Add Add-ons to this food" style="color:#e60000;font-size: 20px;cursor: pointer;" class="glyphicon glyphicon-plus"></span> 
                                            </button>
                                        </a>
                                        
                                    <?php }
                                    ?>
                                   
                                        
                                    </td>
                                    
                                    
                                    <td>
                                        <form id="edit_form_data" onsubmit=" return false;" enctype="multipart/form-data">
                                            <input type="hidden" name="id"  id="id" value="<?php echo $row['id'];?>">
                                            <?php foreach($form_data as $value){
                                            echo "<input type='hidden' id='".$value."' value='".$row[$value]."' name='".$value."' />";
                                            }?>
                                            <button type="submit" class="btn " style="border-radius: 0px; background-color: #d9534f00; border-color:#d43f3a00; ">
                                            <span type="submit"  title="Edit data" style="color:#0046b3eb;font-size: 20px;cursor: pointer;" class="glyphicon glyphicon-edit f_edit"></span></button>
                                        </form>
                                    </td>
                                    
                                    <td>
                                        <?php if($table_name=="food_settings" || $table_name== "food_invoice_info" || $table_name== "food_table"){}else{?>
                                        <form action="" method="post" class="del_form" id="del_form_<?php echo $row['id'];?>">
                                            <input type="hidden" name="delete_id" value="<?php echo $row['id'];?>">
                                            <button type="submit" class="btn " id="del_btn" style="border-radius: 0px; background-color: #d9534f00; border-color:#d43f3a00; ">
                                            <span type="submit" title="Delete data" style="color:#e60000;font-size: 20px;cursor: pointer;" class="glyphicon glyphicon-trash"></span></button>
                                        </form>
                                        <?php }?>
                                    </td>
                               </tr>
                            </table>    
                        </td>
                </tr> 
                <?php  
                   $serial++;     
                    } 
                }else{  
                    echo "No data found";  
                }  
            ?>
        </tbody>
       </table>
    </div>   
  </div>
</div>
</div>