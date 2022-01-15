<?php
                   if(isset($_POST["submit_edit"])){
                        if(isset($_POST[md5('token_update_'.$table_name)])){
            if(isset($_SESSION['token_update_'.$table_name]) && $_POST[md5('token_update_'.$table_name)] === $_SESSION['token_update_'.$table_name]){
                unset($_SESSION['token_update_'.$table_name]);
                
                                if(mysqli_num_rows($result) > 0){
                                    $data=array();
                                    $field_data=array();
                                        while ($rowb = mysqli_fetch_assoc($result)) {
                                            
                                    if(strpos($rowb['Field'], 'img') !== false || strpos($rowb['Field'], 'image') !== false || strpos($rowb['Field'], 'images') !== false || strpos($rowb['Field'], 'logo') !== false){
                                            $data[]=$_POST['old_'.$rowb['Field']];
                                       }else{
                                            $rowa=mysqli_real_escape_string($conn, $_POST[$rowb['Field']]);
                                            $data[]=$rowa;
                                            }
                                            $field_data[]=$rowb['Field'];
                                        }
                                    $id=$_POST['id'];
                                    //   print_r($field_data);
                                        foreach($field_data as $key => $valll){
                                        if(strpos($valll, 'img') !== false || strpos($valll, 'image') !== false || strpos($valll, 'images') !== false || strpos($valll, 'logo') === false){
                                        $sql = "update `$table_name` set `$valll`='$data[$key]' where `id`='$id'";
                                        if(mysqli_query($conn, $sql)){}
                                        }
                                    }
                                    //  die();
                                    //unset($data[0]);
                                    //unset($field_data[0]);
                                            $current_time_stamp=time();
                                               $last_id = $id;
                                               $last_id=$last_id."_".$current_time_stamp;
                                               $i=1;       
                                            foreach($field_data as $valueimg){
                                                if($valueimg=="img" || $valueimg=="image" || $valueimg=="images" || $valueimg=="logo"){
                                                    
                                                    $img_field =$valueimg;
                                                    $path=$table_name."_".$valueimg;
                                                    
                                                    if ($_FILES[$img_field]['size']==0)
                                                    {
                                                       $img1=$_POST['old_'.$img_field];
                                                    }else{
                                                        $sql_get_past_img = "SELECT * FROM `$table_name` WHERE `id` = '$id'";  
                                                        $retvali=mysqli_query($conn, $sql_get_past_img);  
                                                        if(mysqli_num_rows($retvali) > 0){  
                                                         while($rowi = mysqli_fetch_assoc($retvali)){  
                                                            $lasi_img_del=$rowi[$valueimg];  
                                                         }  
                                                        }else{  
                                                        echo "0 results";  
                                                        } 
                                                        if(file_exists($path)){
                                                             if(file_exists("$path/$lasi_img_del")){
                                                            unlink("$path/$lasi_img_del");
                                                            }
                                                            move_uploaded_file($_FILES[$img_field]['tmp_name'],"$path/$last_id.jpg");
                                                        }
                                                        else
                                                        {
                                                            mkdir($path);
                                                            move_uploaded_file($_FILES[$img_field]['tmp_name'],"$path/$last_id.jpg");
                                                        }
                                                            $img1="$last_id.jpg";
                                                    }
                                                $sqlu = "UPDATE `$table_name` SET `$img_field`='$img1' WHERE `id`='$id'";  
                                                mysqli_query($conn, $sqlu);
                                                $i++;
                                                }
                                            }
                                        ?> 
                                            <script>
                                                $( document ).ready(function() {
                                                    $("#table_list").remove();
                                                });
                                                var link = "<?= $link;?>";
                                               swal("Updated!", "Record updated successfully.", "success")
                                                    .then((value) => {
                                                       window.location.replace(link);
                                                    });
                                            </script>
                                        <?php 
                                }
                                    }else{
                                        ?>
                                        <script>
                                        swal("Unauthorized submission !", "CSRF token missmatch.", "error");
                                        </script>
                                        <?php
                                    }
                    }else{?>
                                    <script>
                                        swal("Unauthorized submission !", "CSRF token required.", "error");
                                    </script>
                    <?php }
}?>