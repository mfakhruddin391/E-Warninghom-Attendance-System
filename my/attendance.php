<?php
   include('../include/connect.php');
   global $DBCONNECT;
   date_default_timezone_set("Asia/Kuala_Lumpur");
   if (isset($_SESSION['Kelas']))
   {
       $q = mysqli_query($_SESSION['Connect'],"SELECT * FROM maklumat_pelajar WHERE ID_Kelas='".$_SESSION['Kelas']."' AND Today_Attendence= 3 ORDER BY Nama_Pelajar ASC");
   }

   ?>
<html>
   <head>
      <title>Catat Kehadiran</title>
      <link rel="stylesheet" type="text/css" href="../css/Raleway.css"/>
      <link rel="stylesheet" type="text/css" href="../css/home.css"/>
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../css/style.css" rel="stylesheet">
   </head>
   <body>
      <?php
         date_default_timezone_set("Asia/Kuala_Lumpur");
         $take = mysqli_fetch_array($q);
         $_SESSION['Today_Attendence'] = $take['Today_Attendence'];
 
         if (isset($_POST['Attendance']))
         {
             $Attandence = $_POST['Attendance'];
             $No_KPz = $_POST['No_kp'];
             if ($Attandence == "Absent") {
                 $x1 = mysqli_query($_SESSION['Connect'],"INSERT INTO dateabsent (No_KP,DateAbsent) VALUES ('" . $No_KPz . "','" . date("d/m/Y") . "')");
                 if ($x1) {
                     $layer2 = mysqli_query($_SESSION['Connect'],"UPDATE maklumat_pelajar SET Today_Attendence= 1, This_Month = 1 + This_Month ,Untill_Now = 1 + Untill_Now,Total_Attend = Total_Attend - 1  WHERE No_KP = '" . $No_KPz . "'");
                     header("location: attendance");
                 }
             } elseif ($Attandence == "Late") {
				 $x2 = mysqli_query($_SESSION['Connect'],"INSERT INTO datelate (No_KP,DateLate) VALUES ('".$No_KPz."', '".date("d/m/Y")."')");
                 if($x2) {
                 $layere2 = mysqli_query($_SESSION['Connect'],"UPDATE maklumat_pelajar SET Today_Attendence = 2 ,Total_Attend = Total_Attend + 1,Total_Late = Total_Late + 1 WHERE No_KP = '".$No_KPz."'");
                     header("location: attendance");
                 }
             } elseif ($Attandence == "Attend") {
				 $x4 = mysqli_query($_SESSION['Connect'],"INSERT INTO dateattend (No_KP,DateAttend) VALUES ('".$No_KPz."','".date("d/m/Y")."')");
				 if($x4){
                 $attend2 = mysqli_query($_SESSION['Connect'],"UPDATE maklumat_pelajar SET Today_Attendence = 0, Total_Attend = Total_Attend + 1 Where No_KP = '" . $No_KPz . "'");
                 header("location: attendance");
				 }
             } else {
				 $notrecorded = mysqli_query($_SESSION['Connect'],"UPDATE maklumat_pelajar SET Today_Attendence = 3 WHERE No_KP = '".$No_KPz."'");
				 header("location : attendance");
			 }
         }
         ?>
      <center><img src="../images/logo2.png"></center>
      <center>
         <?php
            date_default_timezone_set("Asia/Kuala_Lumpur");
            echo "<h3 align=center>";
            if (date("l") == "Monday") {
                echo "Isnin";
            } elseif (date("l") == "Tuesday") {
                echo "Selasa";
            } elseif (date("l") == "Wednesday") {
                echo "Rabu";
            } elseif (date("l") == "Thursday") {
                echo "Khamis";
            } elseif (date("l") == "Friday") {
                echo "Jumaat";
            } elseif (date("l") == "Saturday") {
                echo "Sabtu";
            } else {
                echo "Ahad";
            }
            echo date(", j ");
            if (date("M") == "Jan") {
                echo "Januari";
            } elseif (date("M") == "Feb") {
                echo "Februari";
            } elseif (date("M") == "Mar") {
                echo "Mac";
            } elseif (date("M") == "Apr") {
                echo "April";
            } elseif (date("M") == "May") {
                echo "Mei";
            } elseif (date("M") == "Jun") {
                echo "Jun";
            } elseif (date("M") == "Jul") {
                echo "Julai";
            } elseif (date("M") == "Aug") {
                echo "Ogos";
            } elseif (date("M") == "Sep") {
                echo "September";
            } elseif (date("M") == "Oct") {
                echo "Oktober";
            } elseif (date("M") == "Nov") {
                echo "November";
            } else {
                echo "Disember";
            }
            echo date(" Y") . "</h3>";
            echo "<h3 align=center>" . date("h:i A") . "</h3>";
            ?>
         <a href="home"><button type="submit" name="home">&nbsp;Halaman Utama&nbsp;</button></a>
      </center>
      <br>
      <table border='1'  bgcolor="#D8D8D8">
         <tr align="center">
            <th rowspan="2">&nbsp;No. KP&nbsp;</th>
            <th rowspan="2">&nbsp;Nama&nbsp;</th>
            <th rowspan="2">&nbsp;Jantina&nbsp;</th>
            <th rowspan="2">&nbsp;Kehadiran Hari Ini&nbsp;</th>
            <th rowspan="2">&nbsp;Status Amaran&nbsp;</th>
            <th rowspan="2">&nbsp;Signal&nbsp;</th>
            <th rowspan="2">&nbsp;Pilih Kehadiran&nbsp;</th>
            <th rowspan="2">&nbsp;Catat Kehadiran&nbsp;</th>
         </tr>
         <tr>
         </tr>
         <?php
            if ($q) {
                while ($data = mysqli_fetch_array($q)) {
					if($data['Nama_Pelajar'] != 0)
					{
					echo"<p>tak di fetch</p>";
					}
						else{ 

                    $_SESSION['No_KP_Pelajar']    = $data['No_KP'];
                    $_SESSION['Nama_Pelajar']     = $data['Nama_Pelajar'];
                    $_SESSION['Jantina_Pelajar']  = $data['Jantina'];
                    $_SESSION['Kelass']           = $data['ID_Kelas'];
                    $_SESSION['Today_Attendence'] = $data['Today_Attendence'];
                    $_SESSION['Warning']          = $data['Warning'];
                    $_SESSION['Untilx']           = $data['Untill_Now'];
                    if ($_SESSION['Warning'] == "1") {
                        $divid = "<img src=../images/green.gif>";
                        echo "<tr align=center class=hijau>";
                    } elseif ($_SESSION['Warning'] == "2") {
                        $divid = "<img src=../images/orange.gif>";
                         echo "<tr align=center class='oren'>";
                    } elseif ($_SESSION['Warning'] == "3") {
                        $divid = "<img src=../images/red.gif>";
                        echo "<tr align=center class='merah'>";
                    } else {
                        $divid = "<img src=>";
                         echo "<tr align=center>";
                    }
                    $ic_noz     = $_SESSION['No_KP_Pelajar'];
                    $birthdatez = substr($ic_noz, 0, 6);
                    $areaz      = substr($ic_noz, 6, 2);
                    $ic_idz     = substr($ic_noz, 8, 4);
                    echo "<td><font face='courier'><b>&nbsp;$birthdatez-$areaz-$ic_idz&nbsp;</b></font></td>";
                    echo "<td>" . $_SESSION['Nama_Pelajar'] . "</td>";
                    if ($_SESSION['Jantina_Pelajar'] == "L") {
                        echo "<td>&nbsp;Lelaki&nbsp;</td>";
                    } else {
                        echo "<td>&nbsp;Perempuan&nbsp;</td>";
                    }
                    if ($_SESSION['Today_Attendence'] == "0") {
                        echo "<td>&nbsp;Hadir&nbsp;</td>";
                    } elseif ($_SESSION['Today_Attendence'] == "1") {
                        echo "<td>&nbsp;Tidak Hadir&nbsp;</td>";
                    } elseif  ($_SESSION['Today_Attendence'] == "2"){
                        echo "<td>&nbsp;Lewat&nbsp;</td>";
                    } else {
						echo "<td>&nbsp;Belum Direkod&nbsp;</td>";
					}
                    echo "<td>&nbsp;" . $_SESSION['Warning'] . "&nbsp;</td>";
                    echo "<td>" . $divid . "</td>";
                    if ($data['Untill_Now'] > 9 And $data['Untill_Now'] < 15) {
                        $un   = mysqli_query($_SESSION['Connect'],"UPDATE maklumat_pelajar Warning = 1 WHERE Nama_Pelajar ='" . $_SESSION['Nama_Pelajar'] . "' ");
                    } elseif ($data['Untill_Now'] > 14 And $data['Untill_Now'] < 20) {
                        $un2  = mysqli_query($_SESSION['Connect'],"UPDATE maklumat_pelajar SET Warning= 2 WHERE Nama_Pelajar = '" . $_SESSION['Nama_Pelajar'] . "' ");
                    } elseif ($data['Untill_Now'] > 19) {
                        $un3  = mysqli_query($_SESSION['Connect'],"UPDATE maklumat_pelajar SET Warning= 3 WHERE Nama_Pelajar = '" . $_SESSION['Nama_Pelajar'] . "' ");
                    } else {
                        $un4 = mysqli_query($_SESSION['Connect'],"UPDATE maklumat_pelajar SET Warning = 0 WHERE Nama_Pelajar = '" . $_SESSION['Nama_Pelajar'] . "' ");
                    }
                    if ($_SESSION['Today_Attendence'] == "3") {
                        echo "<form action='attendance' method='POST'>";
						echo "<td><select name=Attendance>";
						echo "<option value='Attend'>Hadir</option>";
						echo "<option value='Absent'>Tidak Hadir</option>";
                        echo "<option value='Late'>Lewat</option>";
						echo "</select></td>";
                        echo "<td><button name='No_kp' value='" . $_SESSION['No_KP_Pelajar'] . "' type='submit'>&nbsp;Catat&nbsp;</button></td>";
						
                        echo "</form>";
                    } else {
                        echo "<td>Telah dicatat</td>";
                        echo "<td>Telah dicatat</td>";
                    }
                }
			}
            } else {
                header("location : login");
            }
            ?>      
         <?php
            echo "</tr>";
            echo "<tr>";
            ?>
            
      </table>
      <br><br>
      <center>
   </body>
</html>
