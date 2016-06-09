<?php
require('../include/connect.php');
require('../fpdf/fpdf.php');
if (isset($_SESSION['var1'])) {
    
    //Bulan
    if (date("M") == "Jan") {
        $date = "Januari";
    } elseif (date("M") == "Feb") {
        $date = "Februari";
    } elseif (date("M") == "Mar") {
        $date = "Mac";
    } elseif (date("M") == "Apr") {
        $date = "April";
    } elseif (date("M") == "May") {
        $date = "Mei";
    } elseif (date("M") == "Jun") {
        $date = "Jun";
    } elseif (date("M") == "Jul") {
        $date = "Julai";
    } elseif (date("M") == "Aug") {
        $date = "Ogos";
    } elseif (date("M") == "Sep") {
        $date = "September";
    } elseif (date("M") == "Oct") {
        $date = "Oktober";
    } elseif (date("M") == "Nov") {
        $date = "November";
    } elseif (date("M") == "Dec") {
        $date = "Disember";
    } else {
    }
    
    //Start PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    //AMARAN 
	
	$pdf->Cell(60, 38, '', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 14);
	if($_SESSION['var16'] == 1){
    $pdf->Cell(60, 10, 'AMARAN PERTAMA', 1, 1, 'C');
	} elseif ($_SESSION['var16'] == 2){
		    $pdf->Cell(60, 10, 'AMARAN KEDUA', 1, 1, 'C');
	} elseif ($_SESSION['var16'] == 3) {
		    $pdf->Cell(60, 10, 'AMARAN KETIGA', 1, 1, 'C');
	} else {
		    $pdf->Cell(60, 10, '', 1, 1, 'C');
	}
    $pdf->SetFont('Arial', '', 10);
    
    $pdf->Cell(60, 13, 'Kepada,', 0, 1, 'L');
    //Parent Name
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(60, 2, $_SESSION['var8'], 0, 1, 'L');
    $pdf->Cell(60, 5, $_SESSION['var5'], 0, 1, 'L');
	$pdf->Cell(60,3,$_SESSION['var6'],0,1,'L');
	$pdf->Cell(60,4,$_SESSION['var7'],0,1,'L');
    
    //Format Surat
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(60, 10, 'Tuan,', 0, 1, 'L');
    
    //TAJUK SURAT
    $pdf->SetFont('Arial', 'B', 12);
	/////////////////////////////////
	if($_SESSION['var17'] == 1){
    $pdf->Cell(60, 10, 'PEMBERITAHUAN KETIDAKHADIRAN KE KOLEJ - AMARAN PERTAMA', 0, 1, 'L');
    } elseif ($_SESSION['var17'] == 2){
		$pdf->Cell(60, 10, 'PEMBERITAHUAN KETIDAKHADIRAN KE KOLEJ - AMARAN KEDUA', 0, 1, 'L');
	} elseif ($_SESSION['var17'] == 3){
		$pdf->Cell(60, 10, 'PEMBERITAHUAN KETIDAKHADIRAN KE KOLEJ - AMARAN KETIGA', 0, 1, 'L');
	} else {
		$pdf->Cell(60, 10, 'PEMBERITAHUAN KETIDAKHADIRAN KE KOLEJ - AMARAN N/A', 0, 1, 'L');
	}
	////////////////////////////////
    //Format Surat
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(60, 10, 'Saya dengan ini diarahkan untuk memaklumkan bahawa anak tuan/puan:', 0, 1, 'L');
    
    
    //MaklumatPelajar
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(60, 5, '        Nama  :    ' . '' . $_SESSION['var3'] . '', 0, 1, 'L');
    $pdf->Cell(60, 5, '        Kelas   :    ' . '' . $_SESSION['var2'] . '', 0, 1, 'L');
    $kursus = substr($_SESSION['var2'], 7, 3);
    if ($kursus == "IPD") {
        $pdf->Cell(60, 5, '        Kursus :   PANGKALAN DATA & APLIKASI WEB', 0, 1, 'L');
    } elseif ($kursus == "ISK") {
        $pdf->Cell(60, 5, '        Kursus :    SISTEM KOMPUTER DAN RANGKAIAN', 0, 1, 'L');
    } elseif ($kursus == "BPP") {
        $pdf->Cell(60, 5, '        Kursus :    PENGURUSAN PERNIAGAAN', 0, 1, 'L');
    } elseif ($kursus == "MTK") {
        $pdf->Cell(60, 5, '        Kursus :    TEKNOLOGI KIMPALAN', 0, 1, 'L');
    } elseif ($kursus == "MPI") {
        $pdf->Cell(60, 5, '        Kursus :    PEMESINAN INDUSTRI', 0, 1, 'L');
    } else {
        $pdf->Cell(60, 5, '        Kursus :', 0, 1, 'L');
    }
	$MySQL = mysqli_query($_SESSION['Connect'], "SELECT * FROM maklumat_pelajar WHERE No_KP='".$_SESSION['var1']."'");
    $pdf->Cell(60, 20, 'telah tidak hadir ke kolej selama '. mysqli_num_rows($MySQL) .' hari tanpa sebab', 0, 1, 'L');
    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, 'Tarikh Ketidakhadiran Ke Kolej : ', 0, 1, 'L');
    
    //Keluarkan tarikh tak hadir dari database
    $pdf->SetFont('Arial', '', 10);
    $SQL  = mysqli_query($_SESSION['Connect'], "SELECT * FROM dateabsent WHERE No_KP='" . $_SESSION['var1'] . "' LIMIT 17");
    $SQLx = mysqli_query($_SESSION['Connect'], "SELECT * FROM maklumat_pelajar WHERE No_KP='" . $_SESSION['var1'] . "' LIMIT 17 OFFSET 17");
	$SQLz = mysqli_query($_SESSION['Connect'], "SELECT * FROM maklumat_pelajar WHERE No_KP='" . $_SESSION['var1'] . "' LIMIT 17 OFFSET 34");
    if (mysqli_num_rows($SQL)) {
        while ($data = mysqli_fetch_array($SQL)) {
            $_SESSION['DateAbsent'] = $data['DateAbsent'];
            $i                      = $_SESSION['DateAbsent'];
            $Hari                   = substr($i, 0, 3);
            $Bulan                  = substr($i, 3, 2);
            $Tarikh                 = $Hari . $Bulan . ",";
            $Tarikh++;
            $pdf->Cell(11, 16, "".$Tarikh."", 0, 0, 'L');
        }
		if (mysqli_num_rows($SQL) >= 17)
		{
			$pdf->Cell(11, 8,"", 0,1,'L');
			while ($Datax = mysqli_fetch_array($SQLx))
			{
				$_SESSION['DateAbsentx'] = $Datax['DateAbsent'];
				$j = $_SESSION['DateAbsentx'];
				$Day = substr($j, 0, 3);
				$Month = substr($j, 3, 2);
				$Date = $Day.$Month.",";
				$Date++;
				$pdf->Cell(11, 16,"".$Date."", 0,0,'L');
			}
		}
		if (mysqli_num_rows($SQL) >= 34)
		{
			$pdf->Cell(11, 8,"", 0,1,'L');
			while ($Dataz = mysqli_fetch_array($SQLz))
			{
				$_SESSION['DateAbsentx'] = $Dataz['DateAbsent'];
				$v = $_SESSION['DateAbsentx'];
				$Dayz = substr($v, 0, 3);
				$Monthz = substr($v, 3, 2);
				$Datez = $Dayz.$Monthz.",";
				$Datez++;
				$pdf->Cell(11, 16,"".$Datez."", 0,0,'L');
			}
		}
    }
	
    
    $pdf->Cell(0, 16, "", 0, 1, 'L');
    $pdf->Cell(60, 10, '2. Sehubungan itu, tuan/puan dikehendaki hadir ke kolej untuk membincangkan masalah tersebut atau berhubung', 0, 1, 'L');
    $pdf->Cell(60, 1, 'terus dengan pengarah dengan seberapa segera', 0, 1, 'L');
	$pdf->Cell(60, 5, '', 0, 1, 'L');
    $pdf->Cell(60, 10, '3. Mengikut peraturan kolej, anak tuan/puan boleh dikenakan tindakan buang kolej jika tidak hadir ke kolej ', 0, 1, 'L');
    $pdf->Cell(60, 1, 'tanpa apa-apa kenyataan daripada ibu-bapa atau penjaga atas sebab-sebab yang munasabah kerjasama ', 0, 1, 'L');
    $pdf->Cell(60, 10, 'daripada pihak tuan/puan adalah sangat dihargai', 0, 1, 'L');
    $pdf->Cell(60, 10, ' Sekian, Terima Kasih.', 0, 1, 'L');
	
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(60, 15, '"BERKHIDMAT UNTUK NEGARA"', 0, 1, 'L');
	
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(60, 8, 'Saya yang menurut perintah,', 0, 1, 'L');
	$pdf->Cell(60, 10, '..............................................................................................', 0, 1, 'L');
	
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(60, 1, '(AHMAD JAMALULAIL BIN KAMARUZZAMAN)', 0, 1, 'L');
	
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(60, 8, 'Pengarah', 0, 1, 'L');
	$pdf->Cell(60, 2, 'Kolej Vokasional Shah Alam', 0, 1, 'L');
	
    $pdf->output();
}
?>