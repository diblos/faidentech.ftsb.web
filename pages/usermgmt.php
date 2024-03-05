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

require_once '../assets/php/categories.php';
require_once '../assets/php/user.php';
$alert = false;

// section add new user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "NEWUSER") {
  $name = $_POST['name'];
  $username = $_POST['username'];
  $type = $_POST['type'];
  $password = password_hash('12345678', PASSWORD_DEFAULT);
  try {
    createUser($username, $password, $type);
    $user_id = getUserId($username);
    if(!isset($user_id)) {
      throw new Exception("User creation failed!", 1);
    }
    createProfile($user_id, $first_name, null, null, null);
    $msg = 'New user added successfully!';
    $alert = false;
  } catch (\Throwable $th) {
    $msg = $th->getMessage();
    $alert = true;
  }
}

// section update user name & user type
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "UNAME") {

  if (isset($_POST['PROFILE'])) {
    $id = $_POST['uid'];
    $name = $_POST['first_name'];
    $type = $_POST['type'];
  
    try {
      updateName($id, $name, null);
      updateUserType($id, $type);
      $msg = 'User profile updated successfully!';
      $alert = false;
    } catch (\Throwable $th) {
      $msg = $th->getMessage();
      $alert = true;
    }
  } elseif (isset($_POST['RESET'])) {
    $id = $_POST['uid'];
    try {
      $defaultpwd = '12345678';
      changePassword($id, password_hash($defaultpwd, PASSWORD_DEFAULT));
      $msg = 'User password have been successfully reset to '.$defaultpwd.'!';
      $alert = false;
    } catch (\Throwable $th) {
      $msg = $th->getMessage();
      $alert = true;
    }
  }

 

}

$allprofiles = listAllProfiles();
$rowcount = $allprofiles->num_rows;

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

        <div id="newUserForm" class="login-box pb-3 mb-4 d-none">
            <h2>ADD NEW USER</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <input type="hidden" name="action" value="NEWUSER">
                <div class="row">
                    <div class="col">
                      <div class="user-box">
                        <input type="text" name="name" required="" id="input-1">
                        <label>FULL NAME</label>
                      </div>
                    </div>
                    <div class="col">
                      <div class="user-box">
                        <input type="text" name="username" required="" id="input-3">
                        <label>LOGIN USERNAME</label>
                      </div>
                    </div>
                </div>
                  <div class="form-group">
                    <label><h5 style="color:white">USER TYPE</h5></label>
                    <select name="type" id="input-4" class="form-control" style="background-color: rgba(0,0,0,.3);">
                      <?php
                      foreach($utypes as $utype) {
                        echo '<option value="'.$utype->value.'">'.$utype->label.'</option>';
                      }
                      ?>
                    </select>
                   </div>
                   <div class="row">
                    <div class="col"></div>
                    <div class="col-2 p-0" style="text-align:right;">
                      <a href="#" class="m-0">
                        <input class="btn btn-light m-0" type="button" value="Cancel" onclick="toggleObjectVisibility(`newUserForm`, false);">
                      </a>
                    </div>
                    <div class="col-2 text-right p-0">
                      <a href="#" class="m-0">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <button type="submit" class="btn btn-light px-5 m-0"><i class="icon-lock"></i> Register</button>
                      </a>
                    </div>
                   </div>
                
            </form>
                
        </div>

        <div class="login-box pb-3">
          <div class="row">
            <div class="col">
              <h2 style="text-align:left;">USER PROFILES - <?php echo $rowcount; ?> Record(s)</h2>
            </div>
            <div class="col-2 p-0" style="text-align:right;">
              <a href="#">
                <input class="btn btn-light ml-1" type="button" value="New Record" onclick="toggleObjectVisibility(`newUserForm`, true);" title="New Record">
              </a>
            </div>
          </div>

          <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
              <thead>
                <tr>
                  <th class="w5">#</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th class="w15 text-center">User Type</th>
                  <th class="w30 text-center">Action</th>
                </tr>
              </thead>
            </table>
          </div>

          <div class="tbl-content">
          <table cellpadding="0" cellspacing="0" border="0" class="table table-sm table-borderless">
            <tbody>
              <?php
              $rownum = 1;
              if ($allprofiles->num_rows > 0) {
                while ($row = $allprofiles->fetch_assoc()) {

                  $user_id = $row["user_id"];
                  $first_name = $row["first_name"];
                  $username = $row["username"];
                  $type = $row["type"];

                  $optionstr = '';
                  foreach($utypes as $utype) {
                    $selected = ($utype->value==$type)?' selected':'';
                    $optionstr = $optionstr.'<option value="'.$utype->value.'" '.$selected.'>'.$utype->label.'</option>';
                  }

                  // echo '<tr>';
                  // echo '<td class="w5">'.$user_id.'</td>';
                  // echo '<td>'.$first_name.'</td>';
                  // echo '<td>'.$username.'</td>';
                  // echo '<td class="w15 text-center">'.$type.'</td>';
                  // echo '<td class="w20">
                  //   <a class="btn btn-dark m-0" role="button" title="Update Name" href="#" onclick="toggleObjectVisibility(`newForm`, true);toggleObjectVisibility(`newForm2`, false);"><i class="fa fa-edit"></i></a>
                  //   <a class="btn btn-dark m-0" role="button" titel="Change Password" href="#" onclick="toggleObjectVisibility(`newForm2`, true);toggleObjectVisibility(`newForm`, false);"><i class="fa fa-key"></i></a>
                  //   <a class="btn btn-dark m-0" role="button" titel="Change Password" href="#"><i class="fa fa-trash"></i></a>
                  // </td>';
                  // echo '</tr>';

                  echo '
              <form name="sel'.$user_id.'-form" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">
              <input type="hidden" name="uid" value="'.$user_id.'">
              <input type="hidden" name="action" value="UNAME">
              <tr class="rownum">
                  <td class="w5 p-1" scope="row">
                  '.$rownum++.'
                  </td>
                  <td class="p-1" scope="row">
                    <span id="sel'.$user_id.'-first_nameV" class="d-block">'.$first_name.'</span>
                    <span id="sel'.$user_id.'-first_nameI" class="d-none">
                      <input type="text" name="first_name" value="'.$first_name.'" placeholder="Full Name">
                    </span>
                  </td> 
                  <td class="p-1">
                    <span id="sel'.$user_id.'-usernameV" class="d-block">'.$username.'</span>
                  </td> 
                  <td class="w15 p-1 text-center">
                    <span id="sel'.$user_id.'-typeV" class="d-block">'.$type.'</span>
                    <span id="sel'.$user_id.'-typeI" class="d-none">
                      <select name="type" id="input-4" class="form-control" style="background-color: rgba(0,0,0,.3);">
                        '.$optionstr.'
                      </select>
                    </span>
                  </td>
                  <td class="w23 p-1">

                      <a id="sel'.$user_id.'-edit" class="btn btn-dark" title="Edit User Profile" role="button" href="#" onclick="setRow(\'rownum\', true);editMode(\'sel'.$user_id.'\', true);return false;"><i class="fa fa-edit"></i></a>
                      <button id="sel'.$user_id.'-save" class="btn btn-dark disabled" title="Save User Profile" type="submit" name="PROFILE"><i class="fa fa-save"></i></button>
                      <button id="sel'.$user_id.'-save" class="btn btn-dark" title="Password Reset" type="submit" name="RESET"><i class="fa fa-key"></i></button>
                      <a id="sel'.$user_id.'-delete" class="btn btn-dark disabled" title="Delete User" role="button" href="delete_1.php?id='.$user_id.'"><i class="fa fa-trash"></i></a>
                    
                  </td>
              </tr>
              </form>
              ';

                }
              } else {
                echo '<tr>';
                echo '<td colspan="5">No records</td>';
                echo '</tr>';
              }
              ?>
            </tbody>
          </table>
          </div>

        </div>

        <div class="row py-1">
          <div class="col">&nbsp;</div>
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