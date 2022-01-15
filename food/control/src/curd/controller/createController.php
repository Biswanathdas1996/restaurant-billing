 <?php
   if(isset($_POST["submit"])){
        if(isset($_POST[md5('token_create_'.$table_name)])){
            if(isset($_SESSION['token_create_'.$table_name]) && $_POST[md5('token_create_'.$table_name)] === $_SESSION['token_create_'.$table_name]){
                unset($_SESSION['token_create_'.$table_name]);
                    if (mysqli_num_rows($result) > 0) {   
                        $data=array();
                            $field_data=array();
                                while ($rowb = mysqli_fetch_assoc($result)) {
                                    $rowa=mysqli_real_escape_string($conn, $_POST[$rowb['Field']]);
                                    $data[]=$rowa;
                                    $field_data[]=$rowb['Field'];
                                }
                                    unset($data[0]);
                                    unset($field_data[0]);
                                    $matstring=implode("','",$data);
                                    $matstring_field=implode("`,`",$field_data);
                                    $sql = "INSERT INTO `$table_name` (`$matstring_field`) VALUES('$matstring')"; 
                                        if(mysqli_query($conn, $sql)){
                                                $last_id = mysqli_insert_id($conn);
                                                $i=1;       
                                	        foreach($field_data as $valueimg){
                                	            if($valueimg=="img" || $valueimg=="image" || $valueimg=="images" || $valueimg=="logo"){
                                	                $img_field =$valueimg;
                                	                $path=$table_name."_".$valueimg;
                                	                    if(file_exists($path)){
                                        			        move_uploaded_file($_FILES[$img_field]['tmp_name'],"$path/$last_id.jpg");
                                        			    }
                                        			    else
                                        			    {
                                            			    mkdir($path);
                                            			    move_uploaded_file($_FILES[$img_field]['tmp_name'],"$path/$last_id.jpg");
                                        			    }
                                	            $img1="$last_id.jpg";
                                	            $sqlu = "UPDATE `$table_name` SET `$img_field`='$img1' WHERE `id`='$last_id'";  
                                                mysqli_query($conn, $sqlu);
                                                $i++;
                                	            }
                                	        }
                                            ?>
                                            
                                            <script>
                                            var link = "<?= $link;?>";
                                                 $( document ).ready(function() {
                                                    $("#table_list").remove();
                                                });
                                               swal("Added!", "Record added successfully.", "success")
                                                    .then((value) => {
                                                       window.location.replace(link);
                                                    });
                                                    
                                            </script>
                                            
                                            <?php
                                            }else{  
                                            }
                                    }
                                }else{?>
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