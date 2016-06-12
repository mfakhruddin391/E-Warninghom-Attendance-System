

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
      <script>
 //   function myFunction() {
   //     var x = document.getElementById("myselect").value;
   // document.getElementById("selected").innerHTML = "You selected: " + x;
   // }
  </script>
   </head>
   <body>
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
    </br>
        <button type ="submit" value="1" name="Attend" id="Attend">Semua Hadir</button>
      </br>
        <button type="submit" value="2" name="Except" id="Except">Semua hadir kecuali..</button> 
   </body>
</html>
