<?php
//Redirect the user to interface
session_start();
if ($_SESSION['Lang'] == "my") {
	header('Location: my/home');
} else if ($_SESSION['Lang'] == "en") {
	header('Location: en/home');
} else {
	header('Location: my/home');
}
?>
Sila akses sistem ini dalam beberapa minit.