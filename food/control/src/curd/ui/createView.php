<div class="container-fluid panel_design" style="display:none;" id="add_form">
    <div class="panel panel-default" style="border-radius:0px;">
      <div class="panel-heading"><b>Add Details</b></div>
      <div class="panel-body">
        <div class="row"> 
        <div class="col-md-1"></div>
        <div class="col-md-10">
        <form action="" method="post" enctype="multipart/form-data"> 
            <?php $csrf_token_name=md5("token_create_".$table_name);?>
            <input type="hidden" name="<?= $csrf_token_name?>" class="token_create" value="">
            <?php 
            foreach($form_data as $value){
                if(strpos($value, 'date') !== false){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "<input type='date' style='padding: 0px; border-radius:0px; ' class='form-control input_field' placeholder='Please enter ".str_replace("_"," ",$value)."' name='".$value."' />";
                    echo "</div>";  
                    
                }
////////////////////////////////////////////////////////////////////////////////                
                else if(strpos($value, 'number') !== false){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "<input type='number' style='border-radius:0px;padding: 10px;' class='form-control input_field' placeholder='Please enter ".str_replace("_"," ",$value)."' name='".$value."' />";
                    echo "</div>";
                    
                }
             
 ///////////////////////////////////////////////////////////////////////////////            
                else if(strpos($value, 'img') !== false || strpos($value, 'image') !== false || strpos($value, 'images') !== false || strpos($value, 'logo') !== false ){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "<input type='file' style='border-radius:0px;padding: 4px;' class='form-control input_field' placeholder='Please enter ".str_replace("_"," ",$value)."' name='".$value."' />";
                    echo "</div>";
                    
                }
  ///////////////////////////////////////////////////////////////////////////////            
                  else if(strpos($value, 'unit') !== false && $table_name!="units"){
                    $get_unites=select("units");
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "   <select class='form-control input_field '  name='".$value."' >";
                    foreach($get_unites as $unit){
                        echo "<option value='".$unit["id"]."' >".$unit["unit_name"]."</option>";
                    }
                    echo "   </select>";
                    echo "</div>";
                }
 ////////////////////////////////////////////////////////////////////////////////////
 else if(strpos($value, 'employee_id') !== false){
    $get_employee_data=select("employee_data");
    echo "<div class='form-group'>";
    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
    echo "   <select class='form-control input_field '  name='".$value."' >";
    foreach($get_employee_data as $emp){
        echo "<option value='".$emp["id"]."' >".$emp["name"]." (XXXX".$emp["id"].")"."</option>";
    }
    echo "   </select>";
    echo "</div>";
}               
///////////////////////////////////////////////////////////////////////////////            
 else if(strpos($value, 'time') !== false){
    echo "<div class='form-group'>";
    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
    echo "<input data-clocklet  style='border-radius:0px;padding:10px;' class='form-control input_field' placeholder='Please enter ".str_replace("_"," ",$value)."' name='".$value."' />";
    echo "</div>";
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
                    echo "   <select class='form-control input_field '  name='".$value."' >";
                    foreach($get_items as $items){
                        echo "<option value='".$items["id"]."' >".$items["name"]." - (UNIT: &nbsp;&nbsp;".$items['units']['unit_name']." )</option>";
                    }
                    echo "   </select>";
                    echo "</div>";
                }            
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
                    echo "   <select class='form-control input_field '  name='".$value."' >";
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
                    echo "   <select class='form-control input_field '  name='".$value."' >";
                    foreach($get_items as $items){
                        echo "<option value='".$items["id"]."' >".$items["title"]."</option>";
                    }
                    echo "   </select>";
                    echo "</div>";
                }            

///////////////////////////////////////////////////////////////////////////////            
                  else if(strpos($value, 'item') !== false && $table_name=="food_inventory_remove" ){
                      $get_stock_items=select("food_inventory_add");
                    //   pr($get_stock_items); 

                    $temp = array_unique(array_column($get_stock_items, 'item'));
                    $unique_arr = array_intersect_key($get_stock_items, $temp);
                    // pr($unique_arr);
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
                    
                    // pr($dropDownData);
                      
                      
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "   <select class='form-control input_field '  name='".$value."' >";
                    
                    foreach($dropDownData as $items){
                        echo "<option value='".$items["id"]."' >".$items["name"]." - (UNIT: &nbsp;&nbsp;".$items['units']['unit_name']." )</option>";
                    }
                    
                    echo "   </select>";
                    echo "</div>";
                }            

///////////////////////////////////////////////////////////////////////////////            
                  else if(strpos($value, 'qty') !== false && ($table_name=="food_inventory_add" || $table_name=="food_inventory_remove")){
            
                   
                      
                   echo "<div class='form-group'>";
                    echo "<label>Quantity</label>";
                    echo "<input type='number' style='border-radius:0px;padding:10px;' class='form-control input_field' placeholder='Please enter ".str_replace("_"," ",$value)."' name='".$value."' />";
                    echo "</div>";
                }            

///////////////////////////////////////////////////////////////////////////////            
                  else if(strpos($value, 'amount') !== false && $table_name=="food_inventory_add" ){
            
                   
                      
                   echo "<div class='form-group'>";
                    echo "<label>Amount (₹)</label>";
                    echo "<input type='number' style='border-radius:0px;padding:10px;' class='form-control input_field' placeholder='Please enter ".str_replace("_"," ",$value)."' name='".$value."' />";
                    echo "</div>";
                }            
///////////////////////////////////////////////////////////////////////////////            
                  else if(strpos($value, 'avarage_price') !== false && $table_name=="food_inventory_items" ){
            
                   
                      
                   echo "<div class='form-group'>";
                    echo "<label>Avarage price (₹)</label>";
                    echo "<input type='number' style='border-radius:0px;padding:10px;' class='form-control input_field' placeholder='Please enter ".str_replace("_"," ",$value)."' name='".$value."' disabled/>";
                    echo "</div>";
                }            


//////////////////////////////////////////////////////////////////////////////
                else if(strpos($value, 'status') !== false ){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "   <select class='form-control input_field '  name='".$value."' >";
                    echo "      <option value='1' >Active</option>
                                <option value='0'   >Inactive</option>";
                    echo "   </select>";
                    echo "</div>";
                }
////////////////////////////////////////////////////////////////////////////////               
                else if(strpos($value, 'type') !== false && $table_name=='food_tax_charges'){
                   echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>"; 
                    echo "   <select class='form-control input_field '  name='".$value."' >";
                    echo "      <option value='0' >Percentage (%)</option>
                                <option value='1'   >Fixed</option>";
                    echo "   </select>";
                    echo "</div>";
                }
////////////////////////////////////////////////////////////////////////////////                
                else if(strpos($value, 'charge_or_discount') !== false ){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>"; 
                    echo "   <select class='form-control input_field '  name='".$value."' >";
                    echo "      <option value='0' >Add to Invoice</option>
                                <option value='1'   >Discount</option>";
                    echo "   </select>";
                    echo "</div>";
                }
////////////////////////////////////////////////////////////////////////////////                
                else if(strpos($value, 'category') !== false && $table_name=='food_demo'){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "<select class='form-control input_field chosen'  name='".$value."'>";
                             foreach($get_catagory as $vals){
                               echo "<option value='".$vals['id']."'>".$vals['name']."</option>";
                             } 
                    echo    " </select>
                            </div>";
                }
 //////////////////////////////////////////////////////////////////////////////// 
                 else if(strpos($value, 'special') !== false && $table_name=='food_demo'){
                    echo "<div class='form-group'>";
                    echo "<label>Resturent's Special </label>";
                    echo "  <select class='form-control input_field'  name='".$value."'>";
                    echo "      <option value='0'>No</option>
                                <option value='1'>Yes</option>";
                    echo "  </select>
                          </div>";
                }
 //////////////////////////////////////////////////////////////////////////////// 
                 else if(strpos($value, 'ready_to_serve') !== false && $table_name=='food_inventory_items'){
                    echo "<div class='form-group'>";
                    echo "<label>Ready to Serve </label>";
                    echo "  <select class='form-control input_field'  name='".$value."'>";
                    echo "      <option value='0'>No</option>
                                <option value='1'>Yes</option>";
                    echo "  </select>
                          </div>";
                }
//////////////////////////////////////////////////////////////////////////////// 
                 else if(strpos($value, 'veg_or_nonveg') !== false && $table_name=='food_demo'){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "  <select class='form-control input_field'  name='".$value."'>";
                    echo "      <option value='1'>Non-Veg</option>
                                <option value='0'>Veg</option>";
                    echo "  </select>
                          </div>";
                }
///////////////////////////////////////////////////////////////////////////////
                else if(strpos($value, 'price') !== false ){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "<input type='number' style='border-radius:0px;padding:10px;' class='form-control input_field' placeholder='Please enter ".str_replace("_"," ",$value)."' name='".$value."' />";
                    echo "</div>"; 
                }
////////////////////////////////////////////////////////////////////////////////
                else if(strpos($value, 'created') !== false ||  strpos($value, 'modified') !== false){
                    echo "<input type='hidden' value='".date("Y-m-d")."' name='".$value."' />";
                        
                }
////////////////////////////////////////////////////////////////////////////////
                else if(strpos($value, 'type') !== false && $table_name=='food_demo'){
                                    echo "<div class='form-group'>";
                                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                                    echo "<input type='text' style='border-radius:0px;padding:10px;' class='form-control input_field' placeholder='Example: Stater/ Main course etc.  name='".$value."' />";
                                    echo "</div>";
                }
                
///////////////////////////////////////////////////////////////////////////////
                
///////////////////////////////////////////////////////////////////////////////
                else if(strpos($value, 'description') !== false ){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "<textarea class='form-control input_field' rows='5' style='border-radius:0px;padding:10px;' placeholder='Please enter ".str_replace("_"," ",$value)."' name='".$value."'></textarea>";
                    echo "</div>"; 
                }
                
//////////////////////////////////////////////////////////////////////////////// 
                 else if(strpos($value, 'event') !== false && $table_name=='food_email_notification'){
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "  <select class='form-control input_field'  name='".$value."'>";
                    echo "      <option value='New Order'>New Order</option>
                                <option value='Order Modification'>Order Modification</option>
                                <option value='Ask for Cash Pay'>Ask for Cash Pay</option>
                                <option value='Online Paid'>Online Paid</option>
                                <option value='Table Clean Request'>Table Clean Request</option>";
                    echo "  </select>
                          </div>";
                }
///////////////////////////////////////////////////////////////////////////////
                else{
                    echo "<div class='form-group'>";
                    echo "<label>".ucfirst(str_replace("_"," ",$value))."</label>";
                    echo "<input type='text' style='border-radius:0px;padding:10px;' class='form-control input_field' placeholder='Please enter ".str_replace("_"," ",$value)."' name='".$value."' />";
                    echo "</div>";
                    
                }
              
            }
            ?>
            <button type="button" id="back_add_form" class="btn btn-primary btn-lg" style="border-radius: 0px;">Back</button>
            <button type="submit" name="submit" class="btn btn-success btn-lg" style="border-radius: 0px;">Submit</button>
        </form> 
        </div> 
     <div class="col-md-1"></div>   
    </div>    
      </div>
    </div>
</div>