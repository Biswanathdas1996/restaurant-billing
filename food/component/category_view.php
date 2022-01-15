<style>
.fixed {
  /*position: sticky;*/
  top: 0;
  width: auto;
  background-color:white;
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-4">
               <h4 style="font-size: 20px;letter-spacing: 5px;font-weight: 500;margin-bottom: 20px;">Menu</h4>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-8">
                 <h3 style="font-size: 18px;padding: 5px 0px;"> 
                                    <a class="callHotel" href="tel:+918001691299" style="font-size: 15px;letter-spacing: 0px;font-weight: 500;text-decoration: none;float: right;margin-top: -10px;">
                                        <b style="font-size:12px; color:black;">Need Help? &nbsp;&nbsp;</b><span><span class="glyphicon glyphicon-earphone"></span> Call waiter</span>
                                    </a>
                </h3>
                
                
        </div>
    </div>
</div>
 
    
    
    
    
<div class="container-fluid d_view fixed"  style="overflow-x: auto;  scroll-behavior: smooth;padding-left: 0px;padding-right: 0px;">

<table class="mtop" id="cattable">
    <tr>
    <?php 
        $get_category=select("food_category",[
                "conditions"=>[
                    "status"=>1
                    ],
                        'order'=>array(
                                'id'=>'desc'
                            ),
            ]);
            foreach($get_category as $val){
                $get_img=select('food_demo' 
                        ,array(
                        'conditions'=>array(
                                "category"=>$val["id"],
                            ),
                        'order'=>array(
                                'id'=>'desc'
                            ),
                    )
                    );
                    if(count($get_img)>0){
                   
    ?>
    <td style="height: auto;width: auto;text-align: center;">
        <a href="#<?php echo $val["name"];?>" style="text-decoration:none;">
           
                <?php if(!isset($get_img[0]['img'])){?>
                
                        <img src="asact/dami.png"  class="img-rounded" alt="Cinque Terre" style="height: 60px;width: 60px;">
                <?php  }else{?>
                
                        <img src="control/pages/addNewFood/food_demo_img/<?php echo $get_img[0]['img'];?>"  class="img-rounded" alt="Cinque Terre" style="height: 60px;width: 60px;">
                <?php }?> 
                    
                    <h4 class="" style="font-size: 10px;letter-spacing: 1px;height: 10px;width: 100px;color: #C60;"><?php echo $val["name"];?></h4>
           
        </a>
    </td>
    <?php
                    }
    }?>
</tr>
</table>
<div class="waitaa" id="pwait">
<span class="fa fa-refresh fa-spin"  style="font-size:20px; display:none"></span>&nbsp;&nbsp;<b id="waiingspan"></b>
</div>
  </div>






















<script>
    $(document).ready(function(){
$('.cat').click(function(){
        $('#cattable').hide();
        $('#pwait').show();
        var table = $(this).attr('table');
        var cata = $(this).attr('cat_id');
        
        var links ="https://www.scanncatch.com/food/index.php?table_no="+table+"&category="+cata;
        
        // $('#waiingspan').html('Fetching offers of '+ cata +'...');
        $(location).attr('href',links);
    });

});
</script>

