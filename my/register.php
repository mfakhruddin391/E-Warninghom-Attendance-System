<?php
   //Setting up PHP
   include('../include/connect.php');
   set_time_limit(0);
   ignore_user_abort(1);
   $_SESSION['Lang'] = "my";
   
   //Check if session still active
   if(!isset($_SESSION['No_KP'])) {
       header("location: login?account_type=1");
   }
   
   //Response for the form
   if(isset($_POST['No_KP'])){
    $_SESSION['newstdnt'] = $_POST['Nama_Pelajar']; //Untuk apa session ni?
    $q = mysqli_query($_SESSION['Connect'], "INSERT INTO maklumat_pelajar(No_KP,ID_Kelas,Nama_Pelajar,Jantina,Alamat,Poskod,Negeri,Nama_Penjaga,NoTel_Penjaga) VALUES ('".$_POST['No_KP']."','".$_POST['ID_Kelas']."','".$_POST['Nama_Pelajar']."','".$_POST['Jantina']."','".$_POST['Alamat']."','".$_POST['Poskod']."','".$_POST['Negeri']."','".$_POST['Nama_Penjaga']."','".$_POST['NoTel_Penjaga']."')");
    mysqli_query($_SESSION['Connect'], "UPDATE maklumat_pelajar SET Today_Attendence='0',This_Month = 0,Past_Month = 0, Untill_Now = 0, Warning=0, Warna = 0 , Total_Attend = '1', Enabled_Letter='0' WHERE Nama_Pelajar ='".$_POST['Nama_Pelajar']."' ");
    $alert = "1";
   } else {
    $alert = "0";
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
      <title>Daftar Pelajar :: Sistem E-Warning HOM</title>
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
               <p><a href="home"><button type="submit" class="btn btn-default">Halaman Utama</button></a></p>
            </center>
         </div>
         <div id="content">
            <!-- Content -->
            <?php echo '<h4 align="center">Didaftarkan Oleh : '.$_SESSION['Nama'].'</h4>' ?>
            <form role="form" method="POST" action="register">
               <table align="center" border="0">
                  <tr>
                     <th colspan="2">
                        <h3 align="center">Pendaftaran Pelajar</h3>
                     </th>
                  </tr>
                  <tr>
                     <td>
                        <table>
                           <tr>
                              <th>No. IC</th>
                              <th>&nbsp;:&nbsp;</th>
                              <td><input type="text" name="No_KP" class="form-control" placeholder="No. Kad Pengenalan" autocorrect="off" maxlength="12" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required></input>
                           </tr>
                           <tr>
                              <th>Nama</th>
                              <th>&nbsp;:&nbsp;</th>
                              <td><input type="text" name="Nama_Pelajar" placeholder="Nama Pelajar" class="form-control" size="35" autocorrect="off" required></input>
                           </tr>
                        </table>
                     </td>
                     <td>
                        <table>
                           <tr>
                              <th>Kelas</th>
                              <th>&nbsp;:&nbsp;</th>
                              <td><input type="text" name="ID_Kelas" class="form-control" placeholder="Kelas" <?php echo 'value="'.$_SESSION['Kelas'].'"'?> readonly="readonly"></input>
                           </tr>
                           <tr>
                              <th>Jantina</th>
                              <th>&nbsp;:&nbsp;</th>
                              <td>
                                 <select name="Jantina" class="form-control">
                                    <option value="L">Lelaki</option>
                                    <option value="P">Perempuan</option>
                                 </select>
                              </td>
                           </tr>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td align="center" colspan="2"><br>
                        <label>Alamat</label><br>
                        <textarea cols="120%" rows="5" name="Alamat" class="form-control" style="resize: none;" placeholder="Tidak perlu letak Poskod dan Negeri" required></textarea>
                        <br>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <table>
                           <tr>
                              <th>Poskod</th>
                              <th>&nbsp;:&nbsp;</th>
                              <td><input type="text" name="Poskod" class="form-control" placeholder="Poskod" maxlength="5" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required></input>
                           </tr>
                           <tr>
                              <th>Nama<br>Penjaga</th>
                              <th>&nbsp;:&nbsp;</th>
                              <td><input type="text" name="Nama_Penjaga" placeholder="Nama Penjaga" class="form-control" size="35" autocorrect="off" required></input>
                           </tr>
                        </table>
                     </td>
                     <td>
                        <table>
                           <tr>
                              <th>Negeri</th>
                              <th>&nbsp;:&nbsp;</th>
                              <td>
                                 <select name="Negeri" class="form-control">
                                    <option value ="KUALA LUMPUR">Kuala Lumpur</option>
                                    <option value ="SELANGOR">Selangor</option>
                                    <option value ="MELAKA">Melaka</option>
                                    <option value ="JOHOR">Johor</option>
                                    <option value ="TERENGGANU">Terengganu</option>
                                    <option value ="KEDAH">Kedah</option>
                                    <option value ="PERLIS">Perlis</option>
                                    <option value ="PERAK">Perak</option>
                                    <option value ="PAHANG">Pahang</option>
                                    <option value ="NEGERI SEMBILAN">Negeri Sembilan</option>
                                    <option value ="PULAU PINANG">Pulau Pinang</option>
                                    <option value ="SABAH">Sabah</option>
                                    <option value ="SARAWAK">Sarawak</option>
                                 </select>
                              </td>
                           </tr>
                           <tr>
                              <th>No. Telefon<br>Penjaga</th>
                              <th>&nbsp;:&nbsp;</th>
                              <td><input type="text" name="NoTel_Penjaga" placeholder="No. Telefon Penjaga" class="form-control" size="35" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required></input>
                           </tr>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td align="center" colspan="2">
                        <br><button type="submit" class="btn btn-default">Daftar</button>
                     </td>
                  </tr>
               </table>
            </form>
            <!-- End Content -->
         </div>
      </div>
      <!-- Footer -->
      <div id="footer">
         <div class="box">
            <h4 align="center">Hak Cipta Terpelihara &copy; <?php echo date("Y");?> E-Warning HOM</h4>
         </div>
      </div>
      </div>
      <!-- End Footer -->
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="../js/jquery.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <?php if($alert == "1") { echo "<script type='text/javascript'>alert('Pelajar berjaya didaftarkan !');</script>"; $alert = "0"; } else {}?>
   </body>
</html>
