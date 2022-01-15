<div class="container-fluid panel_design" style="display:none;" id="edit_panel">
<div class="panel panel-default" style="border-radius:0px;width:auto;">
  <div class="panel-heading"><b>Update Details</b></div>
  <div class="panel-body">
      <div class="row"> 
        <div class="col-md-1"></div>
        <div class="col-md-10">
      <form action="" method="post" enctype="multipart/form-data"> 
            <?php $csrf_token_name=md5("token_update_".$table_name);?>
            <input type="hidden" name="<?= $csrf_token_name?>" class="token_update" value="">
            <input type="hidden" name="id" value="" id="f_id">
            <?php 
            foreach($form_data as $value){
           
            
                if(strpos($value, 'date') !== false){
                     echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "<input type='date' style='border-radius:0px; padding: 0px;' class='form-control input_field' placeholder='Please enter ".str_replace("_"," ",$value)."' name='".$value."' id='f_".$value."' />";
                    echo "</div>";
                    
                }
                
                else if(strpos($value, 'number') !== false){
                     echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "<input type='number' style='border-radius:0px;padding: 0px;' class='form-control input_field' placeholder='Please enter ".str_replace("_"," ",$value)."' name='".$value."' id='f_".$value."'/>";
                    echo "</div>";
                    
                }
               else if(strpos($value, 'img') !== false || strpos($value, 'image') !== false || strpos($value, 'images') !== false || strpos($value, 'logo') !== false ){
                    ?> 
                    <img id="src_<?php echo $value?>" src="" title="Path-><?php echo $table_name."_".$value."/".$row[$value];?>" class="img-thumbnail" style="height: 63px; width:auto;float: initial;padding: 3px 0px;">
                          <?php
                     echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";      
                    echo "<input type='file' style='border-radius:0px;padding: 4px;' class='form-control input_field' placeholder='Please enter ".str_replace("_"," ",$value)."' name='".$value."' id='f_".$value."' />";

                    echo "<input type='hidden'   style='border-radius:0px;padding: 4px;' class='form-control input_field' placeholder='Please enter ".str_replace("_"," ",$value)."' name='old_".$value."' id='f_old_".$value."' />";
                    echo "</div>";
                   
               }
                else if(strpos($value, 'status') !== false ){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "   <select class='form-control input_field '  name='".$value."' id='f_".$value."'>";
                    echo "      <option value='1' id='yes_active'>Active</option>
                                <option value='0'  id='no_active' >Inactive</option>";
                    echo "   </select>";
                    echo "</div>";
                }
                else if(strpos($value, 'type') !== false && $table_name=='food_tax_charges'){
                     echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "   <select class='form-control input_field ' class='select' name='".$value."' id='f_".$value."'>";
                    echo "      <option value='0' class='percentage_s'>Percentage(%)</option>
                                <option value='1'  class='fixed_s' >Fixed</option>";
                    echo "   </select>";
                    echo "</div>";
                }

                else if(strpos($value, 'employee_id') !== false){
                    $get_employee_data=select("employee_data");
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "   <select class='form-control input_field ' class='select' name='".$value."' id='f_".$value."'>";
                    foreach($get_employee_data as $emp){
                        echo "<option value='".$emp["id"]."' >".$emp["name"]." (XXXX".$emp["id"].")"."</option>";
                    }
                    echo "   </select>";
                    echo "</div>";
                } 



                 else if(strpos($value, 'direct_menu') !== false ){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "   <select class='form-control input_field '  name='".$value."' id='f_".$value."'>";
                    echo "      <option value='1' id='yes_active'>QR to Menu</option>
                                <option value='0'  id='no_active' >QR to Website</option>";
                    echo "   </select>";
                    echo "</div>";
                }
                else if(strpos($value, 'send_sms_notifications') !== false ){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "   <select class='form-control input_field '  name='".$value."' id='f_".$value."'>";
                    echo "      <option value='1' id='yes_active'>Active</option>
                                <option value='0'  id='no_active' >Inactive</option>";
                    echo "   </select>";
                    echo "</div>";
                } 
                else if(strpos($value, 'order_type') !== false ){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "   <select class='form-control input_field '  name='".$value."' id='f_".$value."'>";
                    echo "      <option value='Online' id='yes_active'>Accept Online Order</option>
                                <option value='Offline'  id='no_active' >View Menu Only</option>";
                    echo "   </select>";
                    echo "</div>";
                }
                else if(strpos($value, 'send_email_notifications') !== false ){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "   <select class='form-control input_field '  name='".$value."' id='f_".$value."'>";
                    echo "      <option value='1' id='yes_active'>Active</option>
                                <option value='0'  id='no_active' >Inactive</option>";
                    echo "   </select>";
                    echo "</div>";
                }
                else if(strpos($value, 'event') !== false && $table_name=='food_email_notification'){
                     echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "   <select class='form-control input_field ' class='select' name='".$value."' id='f_".$value."'>";
                    echo "      <option value='New Order'>New Order</option>
                                <option value='Order Modification'>Order Modification</option>
                                <option value='Ask for Cash Pay'>Ask for Cash Pay</option>
                                <option value='Online Paid'>Online Paid</option>
                                <option value='Table Clean Request'>Table Clean Request</option>";
                    echo "   </select>";
                    echo "</div>";
                }
                
                
                else if(strpos($value, 'charge_or_discount') !== false ){
                     echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>"; 
                    echo "   <select class='form-control input_field '  name='".$value."' id='f_".$value."'>";
                    echo "      <option value='0' class='add_inv'>Add to Invoice</option>
                                <option value='1'  class='discount' >Discount</option>";
                    echo "   </select>";
                    echo "</div>";
                }
//////////////////////////////////////////////////////////////////////////////
 else if(strpos($value, 'special') !== false && $table_name=='food_demo'){
                    echo "<div class='form-group'>";
                    echo "<label>Resturent's Special </label>";
                    echo "  <select class='form-control input_field'  name='".$value."' id='f_".$value."'>";
                    echo "      <option value='0'>No</option>
                                <option value='1'>Yes</option>";
                    echo "  </select>
                          </div>";
                }
////////////////////////////////////////////////////////////////////////////////  
                 else if(strpos($value, 'veg_or_nonveg') !== false && $table_name=='food_demo'){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "  <select class='form-control input_field'  name='".$value."' id='f_".$value."'>";
                    echo "      <option value='1'>Non-Veg</option>
                                <option value='0'>Veg</option>";
                    echo "  </select>
                          </div>";
                }
///////////////////////////////////////////////////////////////////////////////
                else if(strpos($value, 'price') !== false ){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "<input type='number' style='border-radius:0px;padding:10px;' class='form-control input_field' placeholder='Please enter ".str_replace("_"," ",$value)."' name='".$value."' id='f_".$value."'/>";
                    echo "</div>"; 
                }                
 ///////////////////////////////////////////////////////////////////////////////
                else if(strpos($value, 'description') !== false ){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "<textarea class='form-control input_field' rows='5' style='border-radius:0px;padding:10px;' placeholder='Please enter ".str_replace("_"," ",$value)."' name='".$value."' id='f_".$value."'></textarea>";
                    echo "</div>"; 
                }
 ///////////////////////////////////////////////////////////////////////////
 else if(strpos($value, 'ready_to_serve') !== false && $table_name=='food_inventory_items'){
    echo "<div class='form-group'>";
    echo "<label>Ready to Serve </label>";
    echo "  <select class='form-control input_field'  name='".$value."' id='f_".$value."'>";
    echo "      <option value='0'>No</option>
                <option value='1'>Yes</option>";
    echo "  </select>
          </div>";
}  
 ///////////////////////////////////////////////////////////////////////////
   

///////////////////////////////////////////////////////////////////////////////            
else if(strpos($value, 'food_inventory_item_id') !== false){
    $get_items=select("food_inventory_items",[
        'conditions'=>array(
              "status"=>1,
              "ready_to_serve"=>1
          ),
      'join' =>array(
              'units'=>'unit',
          )
        ]);
  echo "<div class='form-group'>";
  echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
  echo "   <select class='form-control input_field '  name='".$value."' id='f_".$value."'>";
  foreach($get_items as $items){
      echo "<option value='".$items["id"]."' >".$items["name"]." - (UNIT: &nbsp;&nbsp;".$items['units']['unit_name']." )</option>";
  }
  echo "   </select>";
  echo "</div>";
}            
///////////////////////////////////////////////////////////////////////////////            
else if(strpos($value, 'food_demo_id') !== false){
    $get_items=select("food_demo",[
        'conditions'=>array(
              "status"=>1
          )
        ]);
  echo "<div class='form-group'>";
  echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
  echo "   <select class='form-control input_field '  name='".$value."' id='f_".$value."'>";
  foreach($get_items as $items){
      echo "<option value='".$items["id"]."' >".$items["title"]."</option>";
  }
  echo "   </select>";
  echo "</div>";
} 
 ////////////////////////////////////////////////////////////////////////////////  
                 else if(strpos($value, 'created') !== false || strpos($value, 'modified') !== false){
                     
                      echo "<input type='hidden'  id='f_".$value."' name='".$value."' />";
                      
                }
//////////////////////////////////////////////////////////////////////////

else if(strpos($value, 'time') !== false){
    echo "<div class='form-group'>";
    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
    echo "<input data-clocklet  style='border-radius:0px;padding:10px;' class='form-control input_field' placeholder='Please enter ".str_replace("_"," ",$value)."' name='".$value."' id='f_".$value."'/>";
    echo "</div>";
} 

///////////////////////////////////////////////////////////////////////////////
                else if(strpos($value, 'category') !== false && $table_name=='food_demo'){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "<select class='form-control input_field'  name='".$value."' id='f_".$value."'>";
                             foreach($get_catagory as $vals){
                               echo "<option value='".$vals['id']."'>".$vals['name']."</option>";
                             } 
                    echo    " </select>
                            </div>";
                }
////////////////////////////////////////////////////////////////////
                else if(strpos($value, 'unit') !== false && $table_name=='food_inventory_items'){
                    $get_unites=select("units");
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "<select class='form-control input_field'  name='".$value."' id='f_".$value."'>";
                             foreach($get_unites as $vals){
                               echo "<option value='".$vals['id']."'>".$vals['unit_name']."</option>";
                             } 
                    echo    " </select>
                            </div>";
                }
         
  ///////////////////////////////////////////////////////////////////////////////            
                  else if(strpos($value, 'item') !== false && $table_name=="food_inventory_add" ){
                      $get_items=select("food_inventory_items",[
                          'conditions'=>array(
                                "status"=>1,
                            ),
                        'join' =>array(
                                'units'=>'unit',
                            )
                          ]);
                 
                      
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "   <select class='form-control input_field '  name='".$value."'  id='f_".$value."'>";
                    
                    foreach($get_items as $items){
                        echo "<option value='".$items["id"]."' >".$items["name"]." - (UNIT: &nbsp;&nbsp;".$items['units']['unit_name']." )</option>";
                    }
                    
                    echo "   </select>";
                    echo "</div>";
                }               
                
   ///////////////////////////////////////////////////////////////////////////////            
                  else if(strpos($value, 'item') !== false && $table_name=="food_inventory_remove" ){
                      $get_stock_items=select("food_inventory_add");
                    $temp = array_unique(array_column($get_stock_items, 'item'));
                    $unique_arr = array_intersect_key($get_stock_items, $temp);
                    $dropDownData=[];
                    foreach($unique_arr as $key=> $stockItem){
                        $get_items=select("food_inventory_items",[
                          'conditions'=>array(
                                "id"=>$stockItem["item"],
                            ),
                        'join' =>array(
                                'units'=>'unit',
                            )
                          ]);
                        $dropDownData[]=$get_items[0];
                    }
                      
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "   <select class='form-control input_field '  name='".$value."'  id='f_".$value."'>";
                    
                    foreach($dropDownData as $items){
                        echo "<option value='".$items["id"]."' >".$items["name"]." - (UNIT: &nbsp;&nbsp;".$items['units']['unit_name']." )</option>";
                    }
                    
                    echo "   </select>";
                    echo "</div>";
                }               
                
                
 //////////////////////////////////////////////////////////////////////////////// 
                else{
                     echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "<input type='text' style='border-radius:0px;padding: 0px;' class='form-control input_field' placeholder='Please enter ".str_replace("_"," ",$value)."' name='".$value."' id='f_".$value."'/>";
                    echo "</div>";
                }
            }
            ?>
            <button type="button" id="back_edit_form" class="btn btn-primary btn-lg" style="border-radius: 0px;">Back</button>
            <button type="submit" id="update_btn" name="submit_edit" class="btn btn-success btn-lg" style="border-radius: 0px;">Update</button>
        </form>
        </div> 
     <div class="col-md-1"></div>   
    </div>
        
  </div>
</div>
</div>