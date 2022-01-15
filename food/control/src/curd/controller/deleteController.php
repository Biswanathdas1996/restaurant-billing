 <?php
  if(isset($_POST['delete_id'])){
        if (mysqli_num_rows($result) > 0) {
            $form_data=array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $form_data[]=$row['Field'];
                }
    }
        unset($form_data[0]);
        
       $id=$_POST["delete_id"]; 
        
        foreach($form_data as $value){  
                           if($value=="img" || $value=="image" || $value=="images" || $value=="logo"){
                           $sql_get_past_img = "SELECT * FROM `$table_name` WHERE `id` = '$id'";  
                                                        $retvali=mysqli_query($conn, $sql_get_past_img);  
                                                        if(mysqli_num_rows($retvali) > 0){  
                                                         while($rowi = mysqli_fetch_assoc($retvali)){  
                                                            $lasi_img_del=$rowi[$value];  
                                                         }  
                                                        }else{  
                                                        echo "0 results";  
                                                        } 
                            $path=$table_name."_".$value;   
                            unlink("$path/$lasi_img_del");
                            }
                        }
         
                            
                            
        
            $sql_del = "delete from `$table_name` where `id`='$id'";  
                if(mysqli_query($conn, $sql_del)){  
                
                        ?>
                  <script>                  $( document ).ready(function() {
                                                $("#table_list").remove();
                                            });
                                            var link = "<?= $link;?>";
                                               swal("Success!", "Record deleted successfully.", "success")
                                                    .then((value) => {
                                                       window.location.replace(link);
                                                    });
                                            </script>
              <?php  }else{  
                    echo "Could not deleted record: ". mysqli_error($conn);  
                }
    }?>