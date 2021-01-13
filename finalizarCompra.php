<?php 
	session_start();
	include('conexao.php');
	$idCliente = $_SESSION['id'];
	if(isset($_POST['finalizarCompra'])){
		echo "teste 1";
		foreach ($_SESSION['carrinho'][$idCliente] as $key => $value) {

			$idProdCard = $_SESSION['carrinho'][$idCliente][$key];
			$qtd = $_SESSION['carrinho'][$idCliente][$key]['Quantidade'];
			$nome = $_SESSION['carrinho'][$idCliente][$key]['nome'];
			$preco = $_SESSION['carrinho'][$idCliente][$key]['preco'];
			$foto = $_SESSION['carrinho'][$idCliente][$key]['foto'];
			$marc = $_SESSION['carrinho'][$idCliente][$key]['marc'];

			$idProdCard = (int)$idProdCard;
			$query = "insert into pedidos() values(null, current_date(), '{$qtd}', '{$idCliente}', '{$idProdCard}')";
			if(mysqli_query($conexao, $query)){
				unset($_SESSION['carrinho'][$idCliente][$key]);
			}else{
				echo "ERROOO!!!";
				exit();
			}
		}
	}

	unset($_SESSION['carrinho'][$idCliente]);
	$_SESSION['totalitens'] = 0;

	header('Location: finalizarCompra.php');
	header('Location: shopend.php');
	exit();

?>