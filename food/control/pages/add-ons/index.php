<?php include("../../src/config/includes.php"); echo Layout::bodyLayout();

$food_id=$_GET["food_id"];

$get_all_food=select("food_demo");



if(isset($_GET["delete"])){
     $delete_data=delete('food_menu_item_addones',array(
            "id"=>$_GET["delete"]
        ));
        ?>
    <script>
        swal("Success!", "Add-Ones removed successfully", "success")
        .then((value) => {
                  window.location.replace("../add-ons/?food_id=<?= $food_id ?>");
        });

    </script>
    
    <?php 
        
}



if(isset($_POST["name"])){
    
    $delete_data=delete('food_menu_item_addones',array(
            "food_item_id"=>$food_id
        ));
 
    
    for($i=0;$i<=count($_POST["name"]);$i++){
         $data=array(
        "data"=>array(
                "food_item_id"=>$food_id,
                "name"=>$_POST["name"][$i],
                "amount"=>$_POST['price'][$i],
            )
        );
        if($_POST["name"][$i] != ""){
          $insert_data = insert('food_menu_item_addones',$data);  
        }
    }
    ?>
    <script>
        swal("Success!", "Add-Ones added successfully", "success");
    </script>
    
    <?php 
}


$get_food_add_ons=select("food_menu_item_addones",[
    "conditions"=>[
        "food_item_id"=>$food_id
        ]
    ]);

?>

<form method="post" action="">
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="panel panel-default">
              <div class="panel-heading">Add Add-Ons</div>
                <div class="panel-body">
                  
                   <!--<div class="form-group">-->
                   <!--   <label for="sel1">Choose Food</label>-->
                   <!--   <select class="form-control" id="sel1" name="food">-->
                   <!--      <?php foreach($get_all_food as $data){?>-->
                         
                   <!--         <option value="<?php echo $data["id"];?>"><?php echo $data["title"];?></option>-->
                            
                   <!--     <?php }?>-->
                   <!--   </select>-->
                   <!-- </div> -->
                   
                <?php
                    if(count($get_food_add_ons)>0){
                        
                        foreach($get_food_add_ons as $data){?>
                            <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="name" name="name[]" value="<?php echo $data["name"];?>" class="form-control" >
                              </div>
                               </div>
                            <div class="col-md-5">
                              <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price[]" value="<?php echo $data["amount"];?>" class="form-control" >
                              </div>
                               </div>
                               <div class="col-md-1" >
                                   <div class="form-group" style="margin: 25px 0px;">
                             
                                    <a href="../add-ons/?food_id=<?php echo $food_id; ?>&delete=<?php echo $data["id"];?>">
                                       <button  type="button" class="btn btn-danger">Remove</button>  
                                    </a>
                                    
                                    
                                    
                                </div>
                               </div>
                        </div>
                            
                        <?php }
                        
                    }else{?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="name">Name</label>
                                <input type="name" name="name[]"  class="form-control" >
                              </div>
                            </div>
                            <div class="col-md-6">
                                 <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price[]"  class="form-control" >
                              </div>
                            </div>
                        </div>
                        
                         
                      
                   <?php  }
                ?>
                    
                  
                  
                  <div id="addons">
                      
                  </div>
                                  
                  
                  
                  
                  
                  
                </div>
                
                <div class="panel-footer">
                    
                    <button id="btn2" type="button" class="btn btn-primary">Add More Add-ons</button>
                  
                  <div style="float:right">
                      
                 <a href="../addNewFood">
                    <button  type="button" class="btn btn-danger">Back</button>  
                  </a>  
                  
                    <button  type="submit" class="btn btn-success">Submit</button>
                  
                 
                      
                  </div>
                    
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<!--Write your code here-->

<script>
    
    $( document ).ready(function() {
        //  addDiv();
     function addDiv(){
            let div = `<div class="row">
                            <div class="col-md-6">
            <div class="form-group">
                        <label for="name">Name</label>
                        <input type="name" name="name[]" class="form-control" >
                      </div>
                       </div>
                            <div class="col-md-6">
                      <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price[]" class="form-control" >
                      </div>
                       </div>
                        </div>
                      `;
                      
            $("#addons").append(div);
        }
        
        
        $("#btn2").click(function(){
            addDiv();
        });
        
        
        
        
    });

    
   
    
</script>




<?php include('../../src/layout/foot.php'); ?>