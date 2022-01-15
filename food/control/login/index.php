<?php 
    session_start();
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
        else {
           
                    $query = "SELECT * FROM `user` WHERE email = '".mysqli_real_escape_string($conn, $_POST['email'])."'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_array($result);
                    if (isset($row)) {
                        $hashedPassword = md5(md5($row['id']).$_POST['password']);
                        if ($hashedPassword == $row['password']) {
                            
                            $_SESSION['adminid'] = $row['id'];
                            $_SESSION['superaccess'] = $row['admin'];
                            
                            
                            
                               header("Location: ../pages/dashboard/");
                            
                        } else {
                            $error = "That email/password combination could not be found.";
                        }
                    } else {
                        $error = "That email/password combination could not be found.";
                    }
                
        }
    }
 include("header.php"); ?>
 
 <style>
     * {
  box-sizing: border-box;
}

body {
  margin: 0;
  font-family: Arial;
  font-size: 17px;
}

#myVideo {
  position: fixed;
  right: 0;
  bottom: 0;
  min-width: 100%; 
  min-height: 100%;
}

.content {
  position: fixed;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  color: #f1f1f1;
  width: 100%;
  padding: 20px;
}

#myBtn {
  width: 200px;
  font-size: 18px;
  padding: 10px;
  border: none;
  background: #000;
  color: #fff;
  cursor: pointer;
}

#myBtn:hover {
  background: #ddd;
  color: black;
}
 </style>
 
<!-- <video autoplay muted loop id="myVideo">-->
<!--  <source src="video.mp4" type="video/mp4">-->
<!--  Your browser does not support HTML5 video.-->
<!--</video>-->
 
<div class="container" id="homePageContainer" style="margin-top: 150px;width: auto;">
    <div id="error"><?php if ($error!="") {
    echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';} ?>
    </div>
    
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default" style="background-color: #fcfdfed9; padding: 10px; color:#424242;">
                <div class="panel-body" >
                    <form method="post" >
                        <section id="login" style="margin-bottom: 10px;">
                        <h3 style="margin-bottom: -5px;letter-spacing: 5px;">Signin</h3>
                        <small style="margin-bottom: 5px;">Login to access account</small>
                        <br>
                        </section>
                        <fieldset class="form-group">
                            <input class="form-control" type="text" name="email" placeholder="Your username">
                        </fieldset>
                        <fieldset class="form-group">
                            <input class="form-control"type="password" name="password" placeholder="Password">
                        </fieldset>
                        <fieldset class="form-group">
                            <input class="btn btn-success" type="submit" name="submit" value="Log In!" style="width: 150px;">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    
</div>
<script>
var video = document.getElementById("myVideo");
var btn = document.getElementById("myBtn");

function myFunction() {
  if (video.paused) {
    video.play();
    btn.innerHTML = "Pause";
  } else {
    video.pause();
    btn.innerHTML = "Play";
  }
}
</script>
<?php include("footer.php"); ?>