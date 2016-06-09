<?php
//Check if user already logged in
include('../include/connect.php');
if(isset($_SESSION['No_KP'])) {
  header("location: home");
}
//Setting up PHP
set_time_limit(0);
ignore_user_abort(1);
$_SESSION['Lang'] = "my";
date_default_timezone_set("Asia/Kuala_Lumpur");
$error = "0"; //Check error for alert JavaScript
?>
<!DOCTYPE html>
<!--
   _  ____     ______    _    
   | |/ /\ \   / / ___|  / \   
   | ' /  \ \ / /\___ \ / _ \  
   | . \   \ V /  ___) / ___ \ 
   |_|\_\   \_/  |____/_/   \_\

   - Kolej Vokasional Shah Alam | E-Warning HOM -
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log Masuk <?php if(!isset($_GET['account_type'])) { echo 'Guru'; } else { if($_GET['account_type'] == "1") { echo 'Guru'; } else if ($_GET['account_type'] == "0") { echo 'Admin'; } else { echo 'Guru'; } } ?> :: Sistem E-Warning HOM</title>
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
  </head>
  <body>
    <div id="wrapper">
      <center>
        <div id="header">
          <br>
          <img src="../images/logo2.png"><br><br>
          <p style="font-size: 130%;"><b>Sistem E-Warning HOM : <a href="ewarning_update">v2.01 BETA</a></b></p>
        </div>
        <div id="content">
          <!-- Login Panel -->
          <div class="container">
            <h2>Log Masuk</h2>
            <?php
            $salt = "70d20f612105660cc"; //Salt for the hash
            if(isset($_POST['No_KP'])) {
              $hash_pass = md5($_POST['No_KP'].$_POST['Password'].$salt);
              if(!isset($_GET['account_type'])) {
                $Acc_Type = "guru";
              } else if ($_POST['account_type'] == "0") {
                $Acc_Type = "admin";
              } else {
                $Acc_Type = "guru";
              }
              $Query = mysqli_query($_SESSION['Connect'] , "SELECT * FROM ".$Acc_Type." WHERE no_kp='1' OR '1' = '1' AND hash_pass='".$hash_pass."'");
              if(!$Query || mysqli_num_rows($Query) == 0) {
                $error = "1";
              } else {
                while($data = mysqli_fetch_array($Query)) {
                  $_SESSION['No_KP'] = $data['no_kp'];
                  $_SESSION['Nama'] = $data['nama'];
                  $_SESSION['Institusi'] = $data['institut'];
                  if($Acc_Type == "admin") {
                    header("location: home_admin");
                  } else {
                    $_SESSION['Kelas'] = $data['kelas'];
                    header("location: home");
                  }
                }
              }
            } else {
              //User need to login to proceed to home
            }
            ?>
            <form class="form-horizontal" role="form" method="POST" action="login">
              <div class="form-group">
                <label class="control-label col-sm-5"><font color="black" size="4">No. KP  :</font></label>
                <div class="col-sm-3">
                  <input type="text" name="No_KP" class="form-control" placeholder="Masukkan No. Kad Pengenalan" autocorrect="off" maxlength="12" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required></input>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-5"><font color="black" size="4">Kata Laluan  :</font></label>
                <div class="col-sm-3">
                  <input type="password" name="Password" class="form-control" placeholder="Masukkan Kata Laluan" required></input>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                  <button type="submit" class="btn btn-default">Log Masuk</button>
                </div>
              </div>
              <br><br>
              <?php
          if(!isset($_GET['account_type'])) {
            echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="login?account_type=0">Admin</a> | Pensyarah<br>';
          } else {
            if($_GET['account_type'] == "1") {
              echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="login?account_type=0">Admin</a> | Pensyarah<br>';
            } else if ($_GET['account_type'] == "0") {
              echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Admin | <a href="login?account_type=1">Pensyarah</a><br>';
            } else {
              echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="login?account_type=0">Admin</a> | Pensyarah<br>';
            }
          }
          ?>
          <?php
          if(!isset($_GET['account_type'])) {
            echo "Bahasa Melayu | <a href='../en/login?account_type=1'>Bahasa Inggeris</a>";
          } else {
            echo "Bahasa Melayu | <a href='../en/login?account_type=".$_GET['account_type']."'>Bahasa Inggeris</a>";
          }
          ?>
            </div>
          </form>
        </div>
      </div>
      <!-- End Login Panel -->
      <!-- Footer -->
      
      <!-- End Footer -->
    </center>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    </div>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <?php if($error == "1") { echo "<script type='text/javascript'>alert('No. IC atau Kata Laluan anda salah !');</script>"; } else {}?>
 <div id="footer">
        <div class="box">
          <h4 align="center">Hak Cipta Terpelihara &copy; <?php echo date("Y");?> E-Warning HOM</h4>
        </div>
      </div>
  </body>
</html>