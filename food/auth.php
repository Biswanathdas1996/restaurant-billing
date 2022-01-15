<?php
    session_start();
    include('db/query.php');
    include('db/connection.php');
    include('config/index.php');

    date_default_timezone_set('Asia/Kolkata');
    function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    $table_no=base64_decode(base64_decode(base64_decode(base64_decode($_GET["data"]))));
   
    /* checking if the table is free or active order*/
      $check_table_data=select('food_scan_report',
                        array(
                            'conditions'=>array(
                                    "table_no"=>$table_no,
                                    "status"=>1
                                )
                        )
                    );
        // $check_table_data=select('food_order',
        //     array(
        //         'conditions'=>array(
        //                 "table_no"=>$table_no,
        //                 "done"=>1,
        //             )
        //     )
        // );
    if(count($check_table_data)>0){?>
         <!DOCTYPE html>
            <html lang="en">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <style>
            body {
              font-size: 25px;
              font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            }
            </style>
            <body>
            <center>
            <span style='font-size:100px;'>&#128533;</span>
            <h3>Table is Occupied/ QR already scanned  !!</h3>
            <h5 style="font-size:15px;margin-top:-30px">Please Scan the QR After Some Time...</h5>
            </center>
            </body>
            </html>
        <?php
        die();
    }else{
        $token=md5(time().get_client_ip());
        $data=array(
            "data"=>array(
                    "table_no"=>$table_no,
                    "ip"=>get_client_ip(),
                    "date"=>date("F j, Y, g:i a"),
                    "time"=>time(),
                    "token"=>$token,
                )
            );
        $insert_data = insert('food_scan_report',$data);
        $_SESSION["auth"] = $token;
        // header("Location: index.php?table_no=".$table_no);
        header("Location: ".$_online_digital_menu_path.$token);
        die();
    }
   
?>