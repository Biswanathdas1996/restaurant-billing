<?php 
        $get_all_user=select('notification_user');
        foreach($get_all_user as $user_token){
                    // echo $user_token['token'];
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,"https://exp.host/--/api/v2/push/send");
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS,
                                "to=".$user_token['token']."&title=".$title."&body=".$msg);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $server_output = curl_exec($ch);
                    curl_close ($ch);  
        }

         $data=array(
        "data"=>array(
                "title"=>$title,
                "notification"=>$msg,
                "created"=>date("Y-m-d"),
                "group_id"=>1
            )    
        );
        $insert_notification_data = insert('view_notification',$data);
?>