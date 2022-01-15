<?php 
    $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] 
                === 'on' ? "https" : "http") . "://" . 
          $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']; 
    $linkp=mysqli_connect($host, $user, $pass);
    $db_selectedp = mysqli_select_db( $linkp,$dbname);
    $result = mysqli_query($linkp,"SHOW COLUMNS FROM $table_name");
    $conn = mysqli_connect($host, $user, $pass,$dbname);  
    if(!$conn){  
      die('Could not connect: '.mysqli_connect_error());  
    }
    
    $get_catagory=select("food_category",[
            "conditions"=>[
                "status"=>1
                ],
                "order"=>[
                    "id"=>"DESC"
                    ]
        ]);
?>