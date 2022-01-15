<?php
if(!isset($_SERVER["PHP_AUTH_USER"])){
    header("www-Authenticate: Basic realm=\"Provet Area\"");
    header("HTTP/1.0 401 Unauthorized");
    print("Sorry, You need proper details");
    exit;
}else{      
        if(($_SERVER["PHP_AUTH_USER"]=='admin') && ($_SERVER["PHP_AUTH_PW"]== '111111')){
            unset($_SERVER["PHP_AUTH_USER"]);
            unset($_SERVER["PHP_AUTH_PW"]);
            
            
                if(isset($_POST["name"])){
                        $file = 'src/prototype/dami.php';
                        $newpage = $_POST["name"];
                        
                        if(mkdir("pages/".$newpage)){
                            
                            if (!copy($file, "pages/".$newpage."/index.php")) {
                                echo "failed to copy";
                            }
                        }
                        $r="table_name";
                        $s="$";
                        $tablen=$_POST["table"];
                        $data="<?php ".$s.$r."='".$tablen."';?>";
                        $actual_link_put="pages/".$newpage."/index.php";
                        $fp = fopen($actual_link_put, 'a+') or die("can't open file");
                            $theOldData = fread($fp, filesize($actual_link_put));
                            fclose($fp);
                            $fp = fopen($actual_link_put, 'w+') or die("can't open file");
                            $toBeWriteToFile = $data.$theOldData;
                            fwrite($fp, $toBeWriteToFile);
                            fclose($fp);
                        
                        $dirs = array_filter(glob('*'), 'is_dir');
                        
                        echo $actual_link_put;
                }else if(isset($_POST["blank_name"])){
                        $file = 'src/prototype/dami_default_layout.php';
                        $newpage = $_POST["blank_name"];
                        
                        if(mkdir("pages/".$newpage)){
                            
                            if (!copy($file, "pages/".$newpage."/index.php")) {
                                echo "failed to copy";
                            }
                        }
                        
                        $actual_link_put="pages/".$newpage."/index.php";
                            $dirs = array_filter(glob('*'), 'is_dir');
                        
                        echo $actual_link_put;
                    
                    
                    
                }
                

        }else{
            header("www-Authenticate: Basic realm=\"Provet Area\"");
            header("HTTP/1.0 401 Unauthorized");
            print("Sorry, You need proper details");
            exit;
        }        
}            

?>