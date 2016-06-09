<?php
   //Setting up PHP
   include('../include/connect.php');
   set_time_limit(0);
   ignore_user_abort(1);
   date_default_timezone_set("Asia/Kuala_Lumpur");
   $_SESSION['Lang'] = "my";
   
   //Check if session still active
   if(!isset($_SESSION['No_KP'])) {
       header("location: login?account_type=1");
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
      <title>Utama :: Sistem E-Warning HOM</title>
      <!-- Bootstrap -->
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../css/style.css" rel="stylesheet">
   </head>
   <body>
      <div id="wrapper">
         <div id="header">
            <br>
            <center>
               <img src="../images/logo2.png"></img>
               <p style="font-size: 130%;"><b>Sistem E-Warning HOM : <a href="ewarning_update">v2.01 BETA</a></b></p>
            </center>
         </div>
         <div id="content">
            <!-- Lecturer Information -->
            <table class="col-sm-offset-1">
               <tr>
                  <th colspan="3" style="font-size: 140%;">Maklumat Pensyarah</th>
               </tr>
               <tr>
                  <th>
                     <p>Nama Pensyarah</p>
                  </th>
                  <th>
                     <p>:</p>
                  </th>
                  <th>
                     <p><?php echo $_SESSION['Nama']; ?></p>
                  </th>
               </tr>
               <tr>
                  <th>
                     <p>No. Kad Pengenalan</p>
                  </th>
                  <th>
                     <p>:</p>
                  </th>
                  <th>
                     <p><?php $birthdate = substr($_SESSION['No_KP'], 0, 6); $area = substr($_SESSION['No_KP'], 6, 2); $ic_id = substr($_SESSION['No_KP'], 8, 4); echo $birthdate."-".$area."-".$ic_id; ?></p>
                  </th>
               </tr>
               <tr>
                  <th>
                     <p>Institusi</p>
                  </th>
                  <th>
                     <p>:</p>
                  </th>
                  <th>
                     <p><?php echo $_SESSION['Institusi']; ?></p>
                  </th>
               </tr>
                     <tr>
                  <th>
                     <p>Kursus</p>
                  </th>
                  <th>
                     <p>:</p>
                  </th>
                  <th>
                     <p><?php echo $_SESSION['Kelas']; ?></p>
                  </th>
               </tr>
            </table>
            <!-- End Lecturer Information -->
            <!-- Time -->
            <?php
               echo '<h3 align="center">';
               if(date("l") == "Monday") {
                   echo "Isnin";
               } else if(date("l") == "Tuesday") {
                   echo "Selasa";
               } else if(date("l") == "Wednesday") {
                   echo "Rabu";
               } else if(date("l") == "Thursday") {
                   echo "Khamis";
               } else if(date("l") == "Friday") {
                   echo "Jumaat";
               } else if(date("l") == "Saturday") {
                   echo "Sabtu";
               } else {
                   echo "Ahad";
               }
               echo date(", j ");
               if(date("M") == "Jan") {
                   echo "Januari";
               } else if(date("M") == "Feb") {
                   echo "Februari";
               } else if(date("M") == "Mar") {
                   echo "Mac";
               } else if(date("M") == "Apr") {
                   echo "April";
               } else if(date("M") == "May") {
                   echo "Mei";
               } else if(date("M") == "Jun") {
                   echo "Jun";
               } else if(date("M") == "Jul") {
                   echo "Julai";
               } else if(date("M") == "Aug") {
                   echo "Ogos";
               } else if(date("M") == "Sep") {
                   echo "September";
               } else if(date("M") == "Oct") {
                   echo "Oktober";
               } else if(date("M") == "Nov") {
                   echo "November";
               } else {
                   echo "Disember";
               }
               echo date(" Y")."</h3>";
               echo '<h3 align="center">'.date("h:i A")."</h3>";
               ?>
            <!-- End Time -->
            <center>
               <a href="register"><button type="submit" class="btn btn-default" name="daftar">&nbsp;Daftar Pelajar&nbsp;</button></a>
               <a href="attendance"><button type="submit" class="btn btn-default" name="catat kehadiran">&nbsp;Catat Kehadiran&nbsp;</button></a>
               <a href="flogout"><button type="submit" class="btn btn-default" name="Log Keluar">&nbsp;Log Keluar&nbsp;</button></a>
            </center>
            <br>
            <!-- Buttons Selection -->
            <!-- Table -->
            <table border='1' align="center" style="background-color: #D8D8D8;" class="decor">
               <tr>
                  <th rowspan="2">
                     <center>&nbsp;No. KP&nbsp;</center>
                  </th>
                  <th rowspan="2">
                     <center>&nbsp;Nama&nbsp;</center>
                  </th>
                  <th rowspan="2">
                     <center>&nbsp;Jantina&nbsp;</center>
                  </th>
                  <th rowspan="2">&nbsp;&nbsp;Kehadiran Hari Ini&nbsp;&nbsp;</th>
                  <th colspan="3">
                     <center>&nbsp;Jumlah Tidak Hadir&nbsp;</center>
                  </th>
                  <th rowspan="2">&nbsp;Status Amaran&nbsp;</th>
                  <th rowspan="2">&nbsp;Signal&nbsp;</th>
               </tr>
               <tr>
                  <th>&nbsp;Bulan Ini&nbsp;</th>
                  <th>&nbsp;Jumlah Dari Bulan Lepas&nbsp;</th>
                  <th>&nbsp;Sehingga Kini&nbsp;</th>
               </tr>
               <?php
                  $Query = mysqli_query($_SESSION['Connect'], "SELECT * FROM maklumat_pelajar WHERE ID_Kelas='".$_SESSION['Kelas']."' ORDER BY Nama_Pelajar ASC");
                  while($data = mysqli_fetch_array($Query)) {
                      $_SESSION['No_KP_Pelajar'] = $data['No_KP'];
                      $_SESSION['Nama_Pelajar'] = $data['Nama_Pelajar'];
                      $_SESSION['Jantina'] = $data['Jantina'];
                      $_SESSION['Today_Attendence'] = $data['Today_Attendence'];
                      $_SESSION['This_Month'] = $data['This_Month'];
                      $_SESSION['Past_Month'] = $data['Past_Month'];
                      $_SESSION['Untill_Now'] = $data['Untill_Now'];
                      $_SESSION['Warning'] = $data['Warning'];
                      if($_SESSION['Nama_Pelajar'] == "0") {
                          //Ignore this section. ** BUG FIXING **
                        
                      } else {
                          if($_SESSION['Warning'] == "1") {
                              $divid = '<img src="../images/green.gif">';
                          } else if($_SESSION['Warning'] == "2") {
                              $divid = '<img src="../images/orange.gif">';
                          } else if($_SESSION['Warning'] == "3") {
                              $divid = '<img src="../images/red.gif">';
                          } else {
                             $divid = '<img src="">';
                          }
                          echo '<tr align="center">';
                          $birthdatez = substr($_SESSION['No_KP_Pelajar'], 0, 6);
                          $areaz = substr($_SESSION['No_KP_Pelajar'], 6, 2);
                          $ic_idz = substr($_SESSION['No_KP_Pelajar'], 8, 4);
                          echo "<td>&nbsp;&nbsp;<font face='courier'><b>&nbsp;$birthdatez-$areaz-$ic_idz&nbsp;</b></font>&nbsp;&nbsp;</td>";
                          echo '<td>&nbsp;&nbsp;<a href="showprofile?nokp='.$_SESSION['No_KP_Pelajar'].'">'.$_SESSION['Nama_Pelajar'].'</a>&nbsp;&nbsp;</td>';
                          if($_SESSION['Jantina'] == "L") {
                              echo "<td>&nbsp;&nbsp;Lelaki&nbsp;&nbsp;</td>";
                          } else {
                              echo "<td>&nbsp;&nbsp;Perempuan&nbsp;&nbsp;</td>";
                          }
                          if($_SESSION['Today_Attendence'] == "0") {
                              echo "<td>&nbsp;Hadir&nbsp;</td>";
                          } else if($_SESSION['Today_Attendence'] == "1") {
                              echo "<td>&nbsp;Tidak Hadir&nbsp;</td>";
                          } else if($_SESSION['Today_Attendence'] == "2") {
                              echo "<td>&nbsp;Lewat&nbsp;</td>";
                          } else {
                              echo "<td>&nbsp;Belum Direkod&nbsp;</td>";
                          }
                          echo "<td>".$_SESSION['This_Month']."</td>";
                          echo "<td>".$_SESSION['Past_Month']."</td>";
                          echo "<td>".$_SESSION['Untill_Now']."</td>";
                          if ($_SESSION['Warning'] == "3") {
                              echo "<td class='merah'>&nbsp;KETIGA&nbsp;</td>";
                          } else if($_SESSION['Warning'] == "2") {
                              echo "<td class='oren'>&nbsp;KEDUA&nbsp;</td>";
                          } else if ($_SESSION['Warning'] == "1") {
                              echo "<td class='hijau'>&nbsp;PERTAMA&nbsp;</td>";
                          } else {
                              echo "<td>&nbsp;N/A&nbsp;</td>";
                          }
                          echo "<td>".$divid."</td>";
                      }
                  }
                  ?>

            </table>

            <!-- End Content -->
         </div>
         <!-- Footer -->
         <div id="footer">
            <div class="box">
               <h4 align="center">Hak Cipta Terpelihara &copy; <?php echo date("Y");?> E-Warning HOM</h4>
            </div>
         </div>
         <!-- End Footer -->
      </div>

      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="../js/jquery.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>

   </body>
</html>