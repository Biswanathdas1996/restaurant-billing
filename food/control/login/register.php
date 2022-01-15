
<?php
    session_start();
    error_reporting(0);
  
    $error = "";  

    

    if (array_key_exists("submit", $_POST)) {
        
        include("../../db/connection.php");
        
        if (!$_POST['email']) {
            
            $error .= "An email address is required<br>";
            
        } 
        
        if (!$_POST['password']) {
            
            $error .= "A password is required<br>";
            
        } 
        
        if ($error != "") {
            
            $error = "<p>There were error(s) in your form:</p>".$error;
            
        } 
        
        /*  If user use Sign up    */
        
        
        else {
            
            if ($_POST['signUp'] == '1') {
            
                $query = "SELECT id FROM `user` WHERE email = '".mysqli_real_escape_string($conn, $_POST['email'])."' LIMIT 1";

                $result = mysqli_query($conn, $query);

/*  Check email is unique or not  */

                if (mysqli_num_rows($result) > 0) {     

                    $error = "That email address is taken.";

                } 
                
                
                else {

                    $query = "INSERT INTO `user` (`email`, `password`,`number`,`name`) VALUES ('".mysqli_real_escape_string($conn, $_POST['email'])."', '".mysqli_real_escape_string($conn, $_POST['password'])."','".mysqli_real_escape_string($conn, $_POST['number'])."','".mysqli_real_escape_string($conn, $_POST['name'])."')";

                    if (!mysqli_query($conn, $query)) {

                        $error = "<p>Could not sign you up - please try again later.</p>";

                    } else {

                        $query = "UPDATE `user` SET password = '".md5(md5(mysqli_insert_id($conn)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($conn)." LIMIT 1";
                        
                        $id = mysqli_insert_id($conn);
                        
                        mysqli_query($conn, $query);

                        $_SESSION['id'] = $id;
                        $_SESSION["user"]= mysqli_insert_id($conn);

                        if ($_POST['stayLoggedIn'] == '1') {

                            setcookie("id", $id, time() + 60*60*24*365);
                          
                            header("Location: ../index.php"); 
                        /*  Page after sign up  */

                             } 
                          else{  
                              
                           $_SESSION["user"]= $id;   
                       header("Location: ../index.php");  
                        /*  Page after sign up  */
                        
                        
                        
                          }
                    }

                } 
                
            } 
            
            /*  User Log in Code Starts Here  */
            
            
            else {
                    
                    
                   
                    if(isset($_POST['token'])){
                            if(Token::check($_POST['token'])){
                            echo "ok";
                            }else{
                                 echo "CSRF token missmatch.";
                                die;
                                }
                    }else{
                        echo "CSRF token required.";
                        die;
                    }
                    
                    $query = "SELECT * FROM `user` WHERE email = '".mysqli_real_escape_string($conn, $_POST['email'])."'";
                
                    $result = mysqli_query($conn, $query);
                
                    $row = mysqli_fetch_array($result);
                
                    if (isset($row)) {
                        
                        $hashedPassword = md5(md5($row['id']).$_POST['password']);
                        
                        if ($hashedPassword == $row['password']) {
                            
                            $_SESSION['id'] = $row['id'];
                            
                            if (isset($_POST['stayLoggedIn']) AND $_POST['stayLoggedIn'] == '1') {

                                setcookie("id", $row['id'], time() + 60*60*24*365);
                                
                                     header("Location: ../index.php");
                                      /*  Page after sign up  */
                            } 
                            else{
                                
                               header("Location: ../index.php");
                                 /*  Page after sign up  */
                            }
                            
                                
                        } else {
                            
                            $error = "That email/password combination could not be found.";
                            
                        }
                        
                    } else {
                        
                        $error = "That email/password combination could not be found.";
                        
                    }
                    
                }
            
        }
        
        
    }


?>

<?php include("header.php"); ?>
      
      <div class="container" id="homePageContainer">
      
   
          
          
          
          <div id="error"><?php if ($error!="") {
    echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
    
} ?></div>

<form method="post" id = "signUpForm">
    
    <p>Interested? Sign up now.</p>
    
    <fieldset class="form-group">

        <input class="form-control" type="text" name="email" placeholder="Your Email">
        
    </fieldset>
    
    <fieldset class="form-group">
    
        <input class="form-control" type="password" name="password" placeholder="Password">
        
    </fieldset>
    <fieldset class="form-group">

        <input class="form-control" type="text" name="name" placeholder="Your Full Name">
        
    </fieldset>
    
     <fieldset class="form-group">

        <input class="form-control" type="text" name="number" placeholder="Your Ph. Number">
        
    </fieldset>
    
    <div class="checkbox">
    
        <label>
    
        <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in
            
        </label>
        
    </div>
    
    <fieldset class="form-group">
    
        <input type="hidden" name="signUp" value="1">
        
        <input class="btn btn-success" type="submit" name="submit" value="Sign Up!">
        
    </fieldset>
    
    <p><a class="toggleForms"><input class="btn btn-primary"  value="Click Here To Log In"></a></p>

</form>


<form method="post" id = "logInForm">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    
    <p>Log in using your username and password.</p>
    
    
    <fieldset class="form-group">

        <input class="form-control" type="email" name="email" placeholder="Your Email">
        
    </fieldset>
    
    
    <fieldset class="form-group">
    
        <input class="form-control"type="password" name="password" placeholder="Password">
        
    </fieldset>
    
    <div class="checkbox">
    
        <label>
    
            <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in
            
        </label>
        
    </div>
        
        <input type="hidden" name="signUp" value="0">
    
    <fieldset class="form-group">
        
        <input class="btn btn-success" type="submit" name="submit" value="Log In!">
        
    </fieldset>
    
    <p><a class="toggleForms"><input class="btn btn-primary"  value="Click Here To Sign Up"></a></p>



</form>
          
      </div>

<?php include("footer.php"); ?>


