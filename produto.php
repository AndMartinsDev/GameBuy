<?php
	session_start();
	if(!isset($_COOKIE['produto'])){
		setcookie('produto', ' ', time()*60);
	}

	include("functions.php");
	include("page.php");

	if(isset($_SESSION['nome'])){
		$idCliente = $_SESSION['id'];
		$nome = $_SESSION['nome'];
		$file = $_SESSION['file'];
		$email = $_SESSION['email'];
		$rua = $_SESSION['rua'];
		$num = $_SESSION['num'];
		$bairro = $_SESSION['bairro'];
		$cidade = $_SESSION['cidade'];
		$estado = $_SESSION['estado'];
		$cep = $_SESSION['cep'];
	}else{
		$idCliente = 0;
		$nome = 0;
		$file = 0;
		$email = 0;
		$rua = 0;
		$num = 0;
		$bairro = 0;
		$cidade = 0;
		$estado = 0;
		$cep = 0;
	}

	$prodId = $_SESSION['prodCompId'];
	$prodNome = $_SESSION['prodCompNome'];
	$prodDesc = $_SESSION['prodCompDesc'];
	$prodPreco = $_SESSION['prodCompPreco'];
	$prodFoto = $_SESSION['prodCompFoto'];
	$prodCond = $_SESSION['prodCompCond'];
	$prodCat = $_SESSION['prodCompCat'];
	$prodMarc = $_SESSION['prodCompMarc'];
	$teste = (int)2;

	if(isset($_POST['efetuarCompra'])){
		if(isset($_SESSION['carrinho'][$idCliente][$prodId])){
			$_SESSION['carrinho'][$idCliente][$prodId]['Quantidade']++;
		}else{
			$_SESSION['carrinho'][$idCliente][$prodId] = array('Quantidade'=>1, 'nome'=>$prodNome, 'preco'=> $prodPreco, 'foto' => $prodFoto, 'marc' => $prodMarc);
		}

		header('LOCATION: shoplist.php');
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
		<link rel="stylesheet" type="text/css" href="./css/style.css?version=12"/>
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
			<div>
				<div class="linha">
					<content class="coluna col12">
						<?php
							compra($prodNome, $prodDesc, $prodPreco, $prodCat, $prodFoto, $prodCond, $prodMarc);
							efetuarCompra($prodPreco, $rua, $num, $bairro, $cidade, $estado, $cep);
						?>
					</content>
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