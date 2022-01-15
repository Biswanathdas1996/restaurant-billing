<?php include("../../src/config/includes.php"); 
include("../../src/config/connection.php");
  echo Layout::DLayout();
  
        $totalData=[];
  
        $sql = "SELECT * FROM food_order_item GROUP BY item_id "; 
        $retval=mysqli_query($conn, $sql);  
         while($row = mysqli_fetch_assoc($retval)){  
         
              $nestedData=[];
               
               $get_item=select("food_demo",[
                        "conditions"=>[
                            "id"=>$row['item_id']
                            ]
                    ]);
                $nestedData[]="<img class='img-responsive' src='../addNewFood/food_demo_img/".$get_item[0]["img"]."' style='width: 50px;height: 50px;'> ";
                
                
                $nestedData[]=$get_item[0]["title"];
                
                $get_all_ordered_item=select("food_order_item",[
                        "conditions"=>[
                            "item_id"=>$row['item_id']
                            ]
                    ]);
                $qnt=0;
                foreach($get_all_ordered_item as $data){
                    $qnt+=$data["qnt"];
                }
                          
                $nestedData[]=$qnt;         
                     
               
            $totalData[]=$nestedData;
         }  
         
        mysqli_close($conn);
 
  
  ?>
  
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
  
    <!-- Morris chart -->
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <!-- <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" /> -->
    <!-- Daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.css" rel="stylesheet" type="text/css" />
    
    


    
  </head>
 



          <div class="row">
         
           

           
           
            
             
            
            <div class="col-md-12">
              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-info">
                <div class="box-header with-border">
                 <div class="row">
                        <div class="col-md-6"><h3 class="box-title">Food Item Report</h3></div>
                        
                        <!--<div class="col-md-6">-->
                        <!--    <div class="input-group" style="width: 250px;float: right;">-->
                        <!--        <input type="text" name="daterange" value=""  class="form-control" placeholder="Search">-->
                        <!--        <div class="input-group-btn">-->
                        <!--          <button class="btn btn-default" type="submit">-->
                        <!--            <i class="glyphicon glyphicon-calendar"></i>-->
                        <!--          </button>-->
                        <!--        </div>-->
                        <!--      </div>-->
                        <!--</div>-->
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="stockIn" class="table table-hover dataTable no-footer dtr-inline" style="width: 98%; border: 1px solid rgb(232, 231, 231); margin-bottom: 5px;">
                    <thead>
                        <tr>
                            
                            <th>Item</th>
                            <th>Title</th>
                            <th>Total Order</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($totalData as $data){?>
                        <tr>
                            <td><?= $data[0]?></td>
                            <td><?= $data[1]?></td>
                            <td><?= $data[2]?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            
            
            
            
              
            
          </div><!-- /.row -->

     

  
</html>


<script>
$(document).ready(function() {
    $('#stockIn').DataTable( {
        "order": [[ 2, "desc" ]]
    } );
} );





</script>
<?php include('../../src/layout/foot.php'); ?>
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> -->