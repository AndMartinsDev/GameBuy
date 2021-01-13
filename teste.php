<?php
	session_start();
	//unset($_SESSION['carrinho']);
	echo $_SESSION['carrinho']['1']['1']['Quantidade'];
	foreach ($_SESSION['carrinho'] as $key => $value) {
		echo "<br>Key1 = ".$key;
		foreach ($value as $key2 => $value2) {
			echo "<br>Key2 = ".$key2;
			print_r($value2);
			echo "<br>teste<br>";
			echo $value2['nome'];
		}
	}
?>