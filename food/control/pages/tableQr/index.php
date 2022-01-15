<?php 
include("../../src/config/includes.php"); 
error_reporting(0);
$table_name='food_table';?>
<?php 

include("../../../config/index.php"); 
echo Body::bodyContain($table_name);  




?>


        <div class="panel panel-default">
            <div class="panel-heading">Generate QR Code</div>
            <div class="panel-body">
            <?php   
                $get_data=select("food_table");
                $no_of_table=$get_data[0]['total_working_no_of_table']; 
                
                
                $get_settings=select("food_settings");
                // pr($select);
                // if($select[0]['direct_menu']==1){
                //     $link=base64_encode($select[0]['menu_page_link']);
                // }else{
                //     $link=base64_encode($select[0]['home_page_link']);
                // }
                $link = base64_encode($_base_ip_path);
            ?>
               
                    <?php for($i=1; $i<=$no_of_table;$i++){?>
                    <div class="col-md-2">
                    <a href="qr.php?qr_id=<?= $i?>&link=<?= $link?>" target="_blank">
                        <button type="submit"  class="btn btn-primary" title="Generate QR code" style="padding: 8px 6px; width:90%; margin:2px;">
                            <i class="glyphicon glyphicon-qrcode"  ></i> 
                            Table no: <?= $i?>
                        </button>
                    </a>
                    </div>
                    <?php }?>
                </div>
        </div>     
    
    
    
    <?php include('../../src/layout/foot.php'); ?>