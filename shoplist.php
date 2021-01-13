<?php
	session_start();
	include ('functions.php');
	include('page.php');

	$nome = $_SESSION['nome'];
	$file = $_SESSION['file'];
	$idCliente = $_SESSION['id'];

	$_SESSION['totalitens'] = 0;
	if(isset($_SESSION['carrinho'][$idCliente])){
		foreach ($_SESSION['carrinho'][$idCliente] as $key => $value) {
			$_SESSION['totalitens']++;
		}
		if(isset($_POST['removerQtd'])){
			$prodQtdRemove = $_POST['removerQtd'];
			$qtd = $_SESSION['carrinho'][$idCliente][$prodQtdRemove]['Quantidade'] --;
		}

		if(isset($_POST['adicionarQtd'])){
			$prodQtdAdd = $_POST['adicionarQtd'];
			$qtd = $_SESSION['carrinho'][$idCliente][$prodQtdAdd]['Quantidade'] ++;
		}

		if(isset($_POST['removerProd'])){
			$prodIdRemove = $_POST['removerProd'];
			unset($_SESSION['carrinho'][$idCliente][$prodIdRemove]);
		}
	}else{
		$_SESSION['totalitens'] = 0;
	}
?>

<!DOCTYPE  html>
<html lang="pt-br">

	<head>
		<meta charset="utf-8" />
		<title>HOME</title>
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="css/style.css?version=12" />	
	</head>

	<body>

		<!--header-->
		<div class="linha wraphead">
			<?php
				head();
			?>
		</div>

		<!--nav-->
		<div class="wrapnav">
			
			<?php
				nav_1(); 
			?>

			<div class="linha">
				<?php 
					logo_1();

					pesquisa();

					if(isset($_SESSION['nome'])){
						cad_log($file);
						usuario($nome);
					}else{
						cad_log(1);
						usuario(1);
					}

					shop_car();
				?>
			</div>

			<div class="linha">
				<?php
					nav_bar();
				?>
			</div>
		</div>
		
		<!--conteudo-->
		<div class="wrapcontent">
			<div class="linha">

				<div class="col12">
					<h2>Carrinho de compra</h2>
				</div>

				<?php
					if(isset($_SESSION['totalitens'])){
						if($_SESSION['totalitens'] == 0){
							echo "<p>Você não possui itens no carrinho de compras!</p>
							";
						}else{
							if(isset($_SESSION['carrinho'][$idCliente])){
								$valorItens = 0;
								$qtdItens = 0;
								foreach ($_SESSION['carrinho'][$idCliente] as $key => $value) {
									$idProdCard = $_SESSION['carrinho'][$idCliente][$key];
									$qtd = $_SESSION['carrinho'][$idCliente][$key]['Quantidade'];
									$nome = $_SESSION['carrinho'][$idCliente][$key]['nome'];
									$preco = $_SESSION['carrinho'][$idCliente][$key]['preco'];
									$foto = $_SESSION['carrinho'][$idCliente][$key]['foto'];
									$marc = $_SESSION['carrinho'][$idCliente][$key]['marc'];

									cardShoplist((int)$idProdCard, $qtd,  $nome,  $preco, $marc, $foto);

									$valorItens += $preco*$qtd;
									$qtdItens += $qtd; 
								}

								totalItensShoCar($valorItens,$qtdItens);
							}
						}
					}

				?>

				</div>

				<div class="coluna col12">
					<div class="col10 left">


					</div>

				</div>
			</div>
		</div>

		<!--footer-->
		<div class="footer">
			<?php 
				footer();
			?>
		</div>

	</body>

</html>