<?php
//Setting up PHP
include('../include/connect.php');
include('../include/immortal.php'); //Ngah dgr Nightcore - Immortal. LOL jangan kecam saya
set_time_limit(0);
ignore_user_abort(1);
$_SESSION['Lang'] = "my";

//Check if session still active
if(!isset($_SESSION['No_KP'])) {
  header("location: login?account_type=1");
}
//Check if GET is exist then proceed to fetching data from database
if(!isset($_GET['nokp'])) {
  header("location: home");
} else {
  $SQL = mysqli_query($_SESSION['Connect'], "SELECT * FROM maklumat_pelajar WHERE No_KP = '".$_GET['nokp']."'");
  if(mysqli_num_rows($SQL) == true) {
    $data = mysqli_fetch_array($SQL);
    if($data['ID_Kelas'] != $_SESSION['Kelas']) {
      echo "<script type='text/javascript'>alert('Salah Kelas !');</script>";
    } else {
      $exclude = array(0, 10, 11, 12);
      for ($i = 0; $i <= 16; $i++) {
        if (in_array($i, $exclude)) continue;
        $_SESSION["var".$i] = $data[$i];
      }
      if($_SESSION['var16'] == "1") {
        $divid = "<img src=../images/green.gif>";
      } else if($_SESSION['var16'] == "2") {
        $divid = "<img src=../images/orange.gif>";
      } else if($_SESSION['var16'] == "3") {
        $divid = "<img src=../images/red.gif>";
      } else {
        $divid = "<img src=../images/blank.gif>";
      }
    }
  } else {
    echo "<script type='text/javascript'>alert('No Kad Pengenalan tidak wujud dalam sistem !');</script>";
  }
}
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
    <title>Profile Pelajar :: Sistem E-Warning HOM</title>
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <!--Javascript-->
    <script language="javascript" type="text/javascript">
    xmlhttp = new XMLhttpRequest();
    function loadMonth() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      document.getElementById("month").innerHTML = xmlhttp.responseText;
    }
  };
  xmlhttp.open("GET", "month/month.php", true);
  xmlhttp.send();
}
    </script>
  </head>
  <body>
    <div id="wrapper">
        <div id="header">
            <br>
            <center>
                <img src="../images/logo2.png"></img>
                <p style="font-size: 130%;"><b>Sistem E-Warning HOM : <a href="ewarning_update">v2.01 BETA</a></b></p>
                <p><a href="home"><button type="submit" class="btn btn-default">Halaman Utama</button></a></p>
              </div>
              <div id="content">
                <!-- Content -->
                <h3 align="center">Maklumat Pelajar</h3>
                <table border="1" style="background-color: #D8D8D8;" align="center" cellpadding="7">
                  <tr>
                    <td colspan="4"><br>Nama Pelajar : <?php echo $_SESSION['var3']; ?><br></td>
                    <td colspan="4"><br>No. KP : <?php echo RenderIC($_SESSION['var1']); ?><br></td>
                  </tr>
                  <tr>
                    <td colspan="4"><br>Kelas : <?php echo $_SESSION['var2']; ?><br></td>
                    <td colspan="4"><br>Jantina : <?php if($_SESSION['var4'] == "L") { echo "Lelaki"; } else { echo "Perempuan"; }?><br></td>
                  </tr>
                  <tr>
                    <td colspan="4" rowspan="1"><br>Alamat : <?php echo $_SESSION['var5']; ?><br></td>
                    <td colspan="4" rowspan="2"><br>Nama Penjaga : <?php echo $_SESSION['var8']; ?><br></td>
                  </tr>
                  <tr>
                    <td>Poskod : <?php echo $_SESSION['var6']; ?></td>
                    <td colspan="3">Negeri : <?php echo $_SESSION['var7']; ?></td>
                  </tr>
                  <tr>
                    <td colspan="4"><br>No. Telefon Penjaga : <?php echo $_SESSION['var9']; ?></td>
                    <td colspan="4">Signal : <?php echo $divid; ?><br></td>
                  </tr>
                  <tr>
                    <td colspan="5" align="center">Status : <?php if($_SESSION['var16'] == "3") { echo "AMARAN KETIGA"; } else if($_SESSION['var16'] == "2") { echo "AMARAN KEDUA"; } else if($_SESSION['var16'] == "3") { echo "AMARAN KETIGA"; } else { echo "TIADA AMARAN"; }?></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center">Bulan Ini</td>
                    <td colspan="2" align="center">Bulan Lepas</td>
                    <td colspan="2" align="center ">Sehingga Kini</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><?php echo $_SESSION['var13']; ?></td>
                    <td colspan="2" align="center"><?php echo $_SESSION['var14']; ?></td>
                    <td colspan="2" align="center"><?php echo $_SESSION['var15']; ?></td>
                  </tr>
                </table>
                <br>
                <?php
                if($_SESSION['var16'] >= 1) {
                  echo '<center><a href="mailwarning" target="_blank"><button type="submit" class="btn btn-default" name="printpdf">Cetak Surat</button></a>
                    <button type="submit" class="btn btn-default" name="ShowMonth" onClick=loadMonth()>Lihat Kehadiran</button></a>
                    <div id=month></div>
                  </center>';
                } else {
                  //Leave empty
                }
                ?>
                <!-- End Content -->
              </div>
          </div>
        </center>
    <!-- Footer -->
    <div id="footer">
        <div class="box">
          <h4 align="center">Hak Cipta Terpelihara &copy; <?php echo date("Y");?> E-Warning HOM</h4>
        </div>
      </div>
      <!-- End Footer -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>