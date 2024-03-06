<?php
$cookie_name = "ftype";
$ftype = 'user';

$parts = explode('/', $_SERVER["PHP_SELF"]);
$file = $parts[count($parts) - 1];

if(!isset($_COOKIE[$cookie_name])) {
    $ftype = 'user';
  } else {
    $ftype = $_COOKIE[$cookie_name];
  }

require_once '../assets/php/user.php';
require_once '../assets/php/user_log.php';

$alert = false;

// section update user name
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "UNAME") {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $result = updateName($id, $name, null);
  if ($result) {
    addUserActivity($id, 'update profile');
    $msg = "Name updated successfully!";
    $alert = false;
  } else {
    $msg = "Name update failed!";
    $alert = true;
  }
}

// section change password
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "PWD") {
  $id = $_POST['id'];
  $oldpwd = $_POST['oldpwd'];
  $newpwd = $_POST['newpwd'];
  try {
    if(!isset($id) || !isset($oldpwd) || !isset($newpwd)) {
      throw new Exception("Invalid request!", 1);
    }
    if ($oldpwd == $newpwd) {
      throw new Exception("Old and new password should not be same!", 1);
    }
    if(!verifyPassword($id, $oldpwd)){
      throw new Exception("Old password is wrong!", 1);
    }
    $result = changePassword($id, password_hash($newpwd, PASSWORD_DEFAULT));
    if ($result) {
      addUserActivity($id, 'change password');
      $msg = "Password changed successfully!";
      $alert = false;
    } else {
      $msg = "Password change failed!";
    }
  } catch (\Throwable $th) {
    $msg = $th->getMessage();
    $alert = true;
  }
 
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/css/img/faiden-logo.png">
  <title>
    Faidentech FTSB
  </title>

   <!--<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />-->
   <link href="../assets/css/font-awsome.css"/>
  <script src="../assets/js/core/kit-fontawesome.js" crossorigin="anonymous"></script>

  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
  <link href="../assets/css/table.css" rel="stylesheet"/>

  <!--<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>-->
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />

  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.min.css?v=1.0.7" rel="stylesheet" />

  <script src="../assets/js/core/jquery-3.7.1.js"></script>
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>-->
  
</head>

<body class="g-sidenav-show  bg-gray-100">

<!-- NAV STARTS -->

<?php
include 'nav.php';
?>

<!-- NAV ENDS -->

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

<?php
include 'topnav.php';
?>

<div class="container-fluid py-4"> 

        <div class="login-box pb-3"><h2>USER PROFILE</h2>
          <div class="row">
            <div class="col p-1"><h5 class="text-white text-capitalize">Name: <?php echo $name; ?></h5></div>
            <div class="col p-1" style="text-align:right;">
                <a class="btn btn-dark m-0" role="button" title="Update Name" href="#" onclick="toggleObjectVisibility(`newForm`, true);toggleObjectVisibility(`newForm2`, false);"><i class="fa fa-edit"></i></a>
                <a class="btn btn-dark m-0" role="button" titel="Change Password" href="#" onclick="toggleObjectVisibility(`newForm2`, true);toggleObjectVisibility(`newForm`, false);"><i class="fa fa-key"></i></a>
            </div>
          </div>
        </div>

        <div class="row py-1">
          <div class="col">&nbsp;</div>
        </div>

        <div id="newForm" class="login-box pb-3 d-none">
            <h2>UPDATE PROFILES</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <input type="hidden" name="id" value="<?php echo $fid; ?>">
                <input type="hidden" name="action" value="UNAME">
                <div class="user-box">
                    <input type="text" name="name" required="" id="input-1">
                    <label>ENTER PERSON NAME</label>
                  </div>
                <!-- <div class="user-box">
                    <input type="text" name="license" required="" id="input-3">
                    <label>LICENSE PLATE</label>
                </div> -->
                   <div class="row">
                    <div class="col"></div>
                   <div class="col-2 p-0" style="text-align:right;">
                      <a href="#" class="m-0">
                        <input class="btn btn-light m-0" type="button" value="Cancel" onclick="toggleObjectVisibility(`newForm`, false);">
                      </a>
                    </div>
                    <div class="col-2 p-0">
                      <a href="#" class="m-0">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <button type="submit" class="btn btn-light px-5 m-0"><i class="icon-lock"></i> Update</button>
                      </a>
                    </div>
                   </div>
                
            </form>
                
        </div>

        <!-- <div class="row py-1">
          <div class="col">&nbsp;</div>
        </div> -->

        <div id="newForm2" class="login-box pb-3 d-none">
            <h2>CHANGE PASSWORD</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <input type="hidden" name="id" value="<?php echo $fid; ?>">
                <input type="hidden" name="action" value="PWD">
                <div class="user-box">
                    <input type="password" name="oldpwd" required="" id="input-1">
                    <label>OLD PASSWORD</label>
                </div>
                <div class="user-box">
                    <input type="password" name="newpwd" required="" id="input-3">
                    <label>NEW PASSWORD</label>
                </div>
                   <div class="row">
                    <div class="col"></div>
                   <div class="col-2 p-0" style="text-align:right;">
                      <a href="#" class="m-0">
                        <input class="btn btn-light m-0" type="button" value="Cancel" onclick="toggleObjectVisibility(`newForm2`, false);">
                      </a>
                    </div>
                    <div class="col-2 text-right p-0">
                      <a href="#" class="m-0">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <button type="submit" class="btn btn-light px-5 m-0"><i class="icon-lock"></i> Update</button>
                      </a>
                    </div>
                   </div>
            </form>
                
        </div>

        <div class="row <?php echo ($msg != null) ? '' : 'd-none'; ?>">
          <div class="col pt-3">
            <div class="alert alert-<?php echo ($alert)?'danger':'success'; ?> text-white" role="alert">
              <?php echo $msg; ?>
            </div>
          </div>
        </div>

        

</div>

<?php
    include 'footer.php';
?>

  </main>

   

  <!-- <script src="../assets/js/visitor_table.js"></script>
  <script src="../assets/js/image.js"></script>
  <script src="../assets/js/image_1.js"></script>
  <script src="../assets/js/image_2.js"></script>
  <script src="../assets/js/table.js"></script> -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
  <script src="../assets/js/common.js"></script>
</body>

</html>