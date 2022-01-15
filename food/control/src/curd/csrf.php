<?php 
   class Token{
    public static function generate(){
        return $_SESSION['token']=base64_encode(openssl_random_pseudo_bytes(32));
    }
    public static function check($token){
        if(isset($_SESSION['token']) && $token === $_SESSION['token']){
            unset($_SESSION['token']);
            return true;
        }
        else{
            return true;
        }
    }
    
    public static function generate_for_create(){
        return $_SESSION['token_create']=base64_encode(openssl_random_pseudo_bytes(32));
    }
    public static function check_create($token){
        if(isset($_SESSION['token_create']) && $token === $_SESSION['token_create']){
            unset($_SESSION['token_create']);
            return true;
        }
        else{
            return false;
        }
    }

}

?>