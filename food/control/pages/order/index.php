<?php include("../../src/config/includes.php"); echo Layout::bodyLayout();

    $order_id=$_GET["id"];
    
    $get_order_data=select('food_order',array(
                                'conditions'=>array(
                                        "id"=>$order_id,
                                    ),
                                'join_many' => array(
                                        'food_order_item'=>'order_id',
                                    ),
                            )
                        );
        $total_get_data=[];                
        $get_data=[];
        foreach($get_order_data[0]['food_order_item'] as $key =>$value){
            if($value>0){
                $temp_data=[];
                $temp_get_data=select('food_demo' 
                                ,array(
                                'conditions'=>array(
                                        "id"=>$value['item_id']
                                    )
                            )
                            );
                $temp_data["id"]= $temp_get_data[0]['id'];
                $temp_data["cookong_ins"]= $temp_get_data[0]['cooking_instruction'];  
                $temp_data["title"]= $temp_get_data[0]['title'];  
                $temp_data["type"]= $temp_get_data[0]['type'];  
                $temp_data["special"]= $temp_get_data[0]['special'];  
                $temp_data["category"]= $temp_get_data[0]['category'];  
                $temp_data["non_veg"]= $temp_get_data[0]['non_veg'];  
                $temp_data["price"]= $temp_get_data[0]['price'];  
                $temp_data["discounted_price"]= $temp_get_data[0]['discounted_price'];  
                $temp_data["status"]= $temp_get_data[0]['status'];  
                $temp_data["img"]= $temp_get_data[0]['img'];  
                $temp_data["description"]= $temp_get_data[0]['description'];
                $temp_data["order_qnt"]=$value['qnt'];
                $temp_data["order_item"]= $value;
                
                $find_add_ons=select("food_order_item_addones",[
                        "conditions"=>[
                                "order_item_id"=>$value["id"]
                            ],
                            'join' => array(
                                    'food_menu_item_addones'=>'add_ones_id',
                                ),
                    ]);
                    
                $temp_data["add_ons"]= $find_add_ons;
                
                
                $get_data[]=$temp_data; 
            }
           
        }
         $total_get_data=$get_data;
     
     
         
          //  pr($total_get_data);
?>
<!--Write your code here-->
        

          <div class="row">
            <div class="col-md-12">
              <div class="row">
                  
                <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-green"><span class="glyphicon glyphicon-th"></span></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Order ID#</span>
                          <span class="info-box-number" id="coreder"> <?php echo base64_encode($get_order_data[0][id]);?></span>
                          
                        </div><!-- /.info-box-content -->
                      </div><!-- /.info-box -->
                </div><!-- /.col --> 
                
                
                <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-aqua"><span class="glyphicon glyphicon-th"></span></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Order Date</span>
                          <span class="info-box-number" id="coreder"> <?php echo $get_order_data[0][date];?></span>
                          <small><?php echo $get_order_data[0][time];?></small>
                        </div><!-- /.info-box-content -->
                      </div><!-- /.info-box -->
                </div><!-- /.col -->
                
                
                <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-inr"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Order Amount</span>
                          <span class="info-box-number" id="total_stock"><?php echo $get_order_data[0][total];?></span>
                        </div><!-- /.info-box-content -->
                      </div><!-- /.info-box -->
                </div> 
                
                <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-inr"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Special Discouint</span>
                          <span class="info-box-number" id="total_stock"><?php echo $get_order_data[0][indivisual_discount];?></span>
                        </div><!-- /.info-box-content -->
                      </div><!-- /.info-box -->
                </div>
                
                
                <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-inr"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Table no </span>
                          <span class="info-box-number" id="total_stock"><?php echo $get_order_data[0][table_no];?></span>
                        </div><!-- /.info-box-content -->
                      </div><!-- /.info-box -->
                </div>
            
                <div class="clearfix visible-sm-block"></div>

              </div><!-- /.row -->  
          </div>    
      
                


<div class="col-md-12">
              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-info">
                <div class="box-header with-border">
                 <div class="row">
                        <div class="col-md-6"><h3 class="box-title">Order Items</h3></div>
                        
                        <div class="col-md-6">
                            <a href="../../../invoice/download.php?id=<?php echo $get_order_data[0][id];?>" target="_blank">
                                <button class="btn" style="float: right;background-color: #dd4b39;color: white;padding: 7px 20px;font-size: 15px;">
                                <i class='fa fa-file'></i>&nbsp;&nbsp;View Invoice</button>
                            </a>
                        </div>
                        
                    </div>
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                  
                    <?php foreach($total_get_data as $data){?>  
                  
                    <div class="panel panel-default">
                        <div class="panel-body">
                          <div class="row">
                              <div class="col-md-1">
                                <img src="../addNewFood/food_demo_img/<?= $data["img"]?>" class="img-rounded" style="height: 50px;width: 50px;"> 
                              </div>
                              <div class="col-md-2">
                                <?= $data["title"]?>  
                              </div>
                              <div class="col-md-2">
                                  <table>
                                      <tr>
                                          <td>QTY: <b><?= $data['order_item']["qnt"]?></b></td>
                                      </tr>
                                      
                                  </table>
                              </div>
                              <div class="col-md-3">
                                  <table>
                                      <?php 
                                      if(count($data['add_ons'])>0){
                                      foreach($data['add_ons'] as $addonesData){?>
                                      <tr>
                                          <td><?php echo $addonesData['food_menu_item_addones']['name'];?></td>
                                          <td>₹<?php echo $addonesData['food_menu_item_addones']['amount'] ." x ". $data['order_item']["qnt"]."= ₹".($addonesData['food_menu_item_addones']['amount'] * $data['order_item']["qnt"]);?></td>
                                      </tr>
                                      <?php }
                                      }else{
                                        echo "No Add-ones";
                                      }?>
                                  </table>
                                  
                              </div>
                              <div class="col-md-4">
                                  
                                  <table>
                                      <tr>
                                          <td>Price: <b>₹<?= $data['order_item']["totalItemPrice"]?></b></td>
                                      </tr>
                                  </table>
                              </div>
                          </div>
                        </div>
                    </div>
                  
                    <?php } ?>
                  
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                 
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            
   
   
  </div>
        



<?php include('../../src/layout/foot.php'); ?>