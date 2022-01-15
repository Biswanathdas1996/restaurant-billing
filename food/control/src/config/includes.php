<?php 
  session_start();
  class Body{
        public static function bodyContain($table){
            $table_name=$table;
            include('connection.php');
            include('../../src/query/query.php');
            include("../../src/layout/head_site_content.php");
            
            
            include("../../src/layout/head.php");
            include("../../src/curd/controller/appController.php");
            include("../../src/curd/csrf.php");
            include("../../src/curd/controller/createController.php");
            include("../../src/curd/controller/deleteController.php");  
            include("../../src/curd/controller/updateController.php");  
            include("../../src/curd/controller/readController.php"); 
            include('../../src/layout/sidebar.php');
            
            include("../../src/curd/ui/readView.php");
            include("../../src/curd/ui/createView.php");
            include("../../src/curd/ui/createView.php");
            include("../../src/curd/ui/updateView.php");
            include('../../src/files/script.php');
            include('../../src/layout/foot_site_content.php');
        }
    }
// Lay out class    
 class Layout{
        public static function bodyLayout(){
            include('connection.php');
            include('../../src/query/query.php');
            include("../../src/layout/head_site_content.php");
            
            include("../../src/layout/head.php");
            include('../../src/layout/sidebar.php');
            include('../../src/files/script.php');
            include('../../src/layout/foot_site_content.php');
        }
        
         public static function DLayout(){
     
            include('connection.php');
            include('../../src/query/query.php');
            include("../../src/layout/head.php");
            include('../../src/layout/sidebar.php');
           
        }
        
        public static function APILayout(){
            include('connection.php');
            include('../../src/query/query.php');
        }


        public static function BaseLayout(){
            include('connection.php');
            include('../../src/query/query.php');
            include('../../src/files/cdn.php');
        }
    }   
    
    
    
    
    
?>