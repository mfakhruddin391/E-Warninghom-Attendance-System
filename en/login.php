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
          <p style="font-size: 130%;"><b>E-Warning HOM System : <a href="../my/ewarning_update">v2.01 BETA</a></b></p>
        </div>
    <h4 align="center">Page is under maintenance. Stay Tune!</h4>
    <br><br><br><br><br><br><br>
    <?php
          if(!isset($_GET['account_type'])) {
            echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="login?account_type=0"> Admin</a> | Pensyarah<br>';
          } else {
            if($_GET['account_type'] == "1") {
              echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="login?account_type=0"> Admin</a> | Pensyarah<br>';
            } else if ($_GET['account_type'] == "0") {
              echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Admin | <a href="login?account_type=1">Pensyarah</a><br>';
            } else {
              echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="login?account_type=0"> Admin</a> | Pensyarah<br>';
            }
          }
          if(!isset($_GET['account_type'])) {
            echo "Bahasa Melayu | <a href='../en/login?account_type=1'>Bahasa Inggeris</a>";
          } else {
            echo "<a href='../my/login?account_type=".$_GET['account_type']."'>Bahasa Melayu</a> | Bahasa Inggeris";
          }
          ?>
           <div id="footer">
        <div class="box">
          <h4 align="center">Hak Cipta Terpelihara &copy; <?php echo date("Y");?> E-Warning HOM</h4>
        </div>
      </div>
  </body>
</html>