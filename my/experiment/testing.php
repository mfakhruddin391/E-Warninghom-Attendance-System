<?php
include('../../include/connect.php');

?>
<html>
	<head>
		<script language="javascript" type="text/javascript">
		xmlhttp = new XMLhttpRequest();
		function loadDoc() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      document.getElementById("scores").innerHTML = xmlhttp.responseText;
    }
  };
  xmlhttp.open("GET", "test.txt", true);
  xmlhttp.send();
}
		</script>
	</head>
		<body>
		
				<div id="scores">
				</div>
				<button type="button" onclick="loadDoc()">Change Content</button>
		</body>
	</head>
</html>		