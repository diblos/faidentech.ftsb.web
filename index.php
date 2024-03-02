<?php
ob_start(); 
$logins = array(
  (object) [
    'usr' => 'Faiden',
    'pwd' => 'faiden1011',
    'type' => 'admin'
  ],
  (object) [
    'usr' => 'Operator1',
    'pwd' => '12345678',
    'type' => 'user'
   ]
);
function findObjectById($usr, $array){
foreach ( $array as $element ) {
    if ( $usr == $element->usr ) {
        return $element;
    }
}
return false;
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIDENTECH FTSB: Sign in</title>
    <link rel="icon" type="image/png" href="assets/css/img/faiden-logo.png">
  <link rel="stylesheet" type="text/css" href="style2.css">
  <!-- loader-->
  <link href="assets2/css/pace.min.css" rel="stylesheet"/>
    <script src="assets2/js/pace.min.js"></script>
    <!--favicon-->
    <link rel="icon" href="assets2/images/favicon.ico" type="image/x-icon">
    <!-- simplebar CSS-->
    <link href="assets2/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
    <!-- Bootstrap core CSS-->
    <link href="assets2/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- animate CSS-->
    <link href="assets2/css/animate.css" rel="stylesheet" type="text/css"/>
    <!-- Icons CSS-->
    <link href="assets2/css/icons.css" rel="stylesheet" type="text/css"/>
    <!-- Sidebar CSS-->
    <link href="assets2/css/sidebar-menu.css" rel="stylesheet"/>
    <!-- Custom Style-->
    <link href="assets2/css/app-style.css" rel="stylesheet"/>
</head>
<body>
    <div class="login-box">
        <div class="row">
          <div class="col px-5 py-3 text-center">
          <img src="assets/css/img/Kolej_logo.png" style="width:60%" class="img-fluid avatar">
          <h4 class="mt-3">Faiden Smart Barrier</h4>
          </div>
        </div>
        <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
          
          <div class="row"><div class="col p-0">
          <h5>LOGIN</h5>
            <div class="user-box">
              <input type="text" name="username" required="">
              <label>Username</label>
            </div>
          </div></div>
          <div class="row"><div class="col p-0">
            <div class="user-box">
              <input type="password" name="password" required="">
              <label>Password</label>
            </div>  
          </div></div>
          <div class="row">
            <div class="col text-center p-0">
            <a>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <button type = "submit" name = "login" class="btn btn-light px-5"><i class="icon-lock"></i> Login</button>
          </a>
            </div>
          </div>
          <div>
         
          <div class="row">
            <div class="col text-center py-2">
            <?php
            $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {

                $result = findObjectById($_POST['username'], $logins);

                try {
                  if(!$result){
                    throw new Exception("User not exists!", 1);
                  }

                  if($result->pwd != $_POST['password']){
                    throw new Exception("Wrong password!", 1);
                  }

                  session_start();
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = $_POST['username'];
                  setcookie('ftype', $result->type, time() + (86400 * 30), "/");

                  header("Location: pages/index.php");
                  exit();
                  
                } catch (\Throwable $th) {
                  echo $th->getMessage();
                }
				
            }else{
                echo "Please enter username and password";
            }
         ?>
            </div>
          </div>

         
      </div> <!-- /container -->
        </form>
      </div>
      <div class="row fixed-bottom py-2">
        <div class="col text-center text-secondary">
          <span><a class="text-secondary" href="#">© Faidentech</a></span>
          &middot;
          <span><a class="text-secondary" href="#">© Reiftech</a></span>
          &middot;
          <span><a class="text-secondary" href="https://faiden.com.my/">Contact</a></span>
          <!-- <span><a class="text-secondary" href="#">Privacy & terms</a></span> -->
        </div>
      </div>
</body>
</html>