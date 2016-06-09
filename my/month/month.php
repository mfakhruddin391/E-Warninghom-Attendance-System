<?php
require("../../include/connect.php");
   set_time_limit(0);
   ignore_user_abort(1);
   date_default_timezone_set("Asia/Kuala_Lumpur");
   $_SESSION['Lang'] = "my";
?>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<?php
		if(isset($_SESSION['Connect'])){
			$nama = mysqli_query($_SESSION['Connect'], "SELECT * FROM maklumat_pelajar WHERE nama");
		}
		?>
		<table border="2" align="center">
			<tr>
				<th colspan="7">
				<?php
				date_default_timezone_set("Asia/Kuala_Lumpur");
				echo '<h3 align="center">'.date("M j ,Y  h:i A ")."</h3>";

				?>

				</th>
			</tr>
			<tr>
				<?php

				$array = array("Ahad","Isnin","Selasa","Rabu","Khamis","Jumaat","Sabtu");
				foreach($array as $hari)
				{
					echo "<td>".$hari."</td>";
				}	
				?>
			</tr>
			<tr>
				<?php
				
				for($week1=1;$week1<=7;$week1++)
				{
					echo "<td>".$week1."</td>";
				}
				?>
			</tr>
			<tr>
				<?php

				for($week2=8;$week2<=14;$week2++)
				{
					echo "<td>".$week2."</td>";
				}

				?>
			</tr>
			<tr>
				<?php

				for($week3=15;$week3<=21;$week3++)
				{
					echo "<td>".$week3."</td>";
				}

				?>
			</tr>
			<?php 
			//$number = cal_days_in_month(calendar,month,year)
			$number = cal_days_in_month(CAL_GREGORIAN,2,"".date("Y").""); // 31
			if($number==31)
			{
				echo "<tr>";
				for($week4=22;$week4<=28;$week4++)
				{
					echo "<td>".$week4."</td>";
				}
				echo "</tr>";
				echo "<tr>";
				for($week5=29;$week5<=31;$week5++)
				{
					echo "<td>".$week5."</td>";
				}
				echo "</tr>";
			}
			elseif($number==30)
			{
			echo "<tr>";
				for($week4=22;$week4<=28;$week4++)
				{
					echo "<td>".$week4."</td>";
				}
				echo "</tr>";
				echo "<tr>";
				for($week5=29;$week5<=30;$week5++)
				{
					echo "<td>".$week5."</td>";
				}
				echo "</tr>";
			}
			elseif($number==29)
			{
				echo "<tr>";
				for($week4=22;$week4<=28;$week4++)
				{
					echo "<td>".$week4."</td>";
				}
				echo "</tr>";
				echo "<tr>";
				echo "<td>29</td>";
				echo "</tr>";
			}
			elseif($number==28)
			{
				echo "<tr>";
				for($week4=22;$week4<=28;$week4++)
				{
					echo "<td>".$week4."</td>";
				}
				echo "</tr>";
				echo "<tr>";
				echo "</tr>";
			}
				?>
			<table>
	</body>
</html>