<?php
	if(!isset($_SESSION)){
		session_start();
	}

	function adm($email, $senha){
		$admEmail = "juliano@yahoo.com.br";
		$admSenha = 123;

		$_SESSION['adm'] = "Juliano";
		$_SESSION['admImg'] = "./admImg/adm.jfif";

		if($admEmail == $email && $admSenha == $senha){
			return 1;
		}else{
			return 0;
		}
	}

	function edit($string, $oper){
		switch($oper){
			case 0:
				editar($string, "nome");
				break;
			case 1:
				editar($string, "rua");
				break;
			case 2:
				editar($string, "numero");
				break;
			case 3:
				editar($string, "bairro");
				break;
			case 4:
				editar($string, "cidade");
				break;
			case 5:
				editar($string, "cep");
				break;
			case 6:
				editar($string, "estado");
				break;
		}
	}

	function editar($string, $dest){
		$ucfirst = ucfirst($dest);
		echo "
			<p>$ucfirst:</p>
			<p>$string</p>
		";
		$post = $dest."Edit";
		$salvar = $dest."Salvar";
		if(isset($_POST[$post])){
			echo "
				<form method='post' action='userEdit1.php'>
				<p>Digite outro {$dest}:</p>
				<input type='text' name='{$dest}'>
				<input class='user' type='submit' value='salvar' name='{$salvar}'>
				</form>
			";
		}else{
			echo "<form method='post' action='usuario.php'>";
			echo "<input class='user' type='submit' value='Editar' name='{$post}'>";
			echo "</form>";
		}
	}

	function editSenha(){
		echo "<p>Editar Senha:</p>";
		if(isset($_POST["editarSenha"])){
			echo "
				<form method='post' action='userEdit1.php'>
				<p>Digite uma senha:</p>
				<input type='password' name='senhaEdit1'>
				<input type='password' name='senhaEdit2'>
				<input class='user' type='submit' value='salvar' name='salvarSenha'>
				</form>
			";
		}else{
			echo "
				<form method='post' action='usuario.php'>
				<input class='user' type='submit' value='Editar' name='editarSenha'>
				</form>
			";
		}
	}

	function fotoEdit($foto){
		echo"
			<p><br><img clas='userImg' src='./uploads/cadastro/$foto'></p>
		";
		if(isset($_POST["editarFoto"])){
			echo"
				<form enctype='multipart/form-data' method='post' action='userEdit1.php'>
					<input type='file' name='arquivoNovo' id='arquivo'>
					<input class='user' type='submit' value='Salvar' name='salvarFoto'>
				</form>
			";
		}else{
			echo"
				<form method='post' action='usuario.php'>
					<input class='user' type='submit' value='Editar' name='editarFoto'>
				</form>
			";
		}
	}

	function destroy(){
		session_destroy();
	}

	function cat_cards($result, $result2){
		foreach ($result as $key => $value) {
			$cat = $value['Categoria'];
			echo" <div class='linha'>
					<div class='col12 $cat'>
						<h2>$cat</h2>
					</div>";
					categoriaProd($result2, $cat);
			echo "</div>";
		}
	}

	function categoriaProd($result, $cat){
		foreach ($result as $key => $value) {
			$id = $value['idProdutos'];
			$nome = $value['Nome'];
			$descricao = $value['Descricao'];
			$preco = $value['Preco'];
			$foto = $value['Foto'];
			$condicao = $value['Condicao'];
			$cat_id = $value['Categoria_idCategoria'];
			$mar_id = $value['Marca_idMarca'];
			$marca = $value['Marc'];
			$categoria = $value['Cat'];
			if($cat == $categoria){
				cards($nome, $descricao, $preco, $categoria, $marca, $foto, $id);
			}
		}
	}

	function cards($nome, $desc, $valor, $cat, $marc, $file, $id){
		$parcela = round($valor/12, 2);

		echo "<content class='coluna col3'>";
			echo "<div class='content jogo'>";
				echo "<div class='coluna col12'>";
					echo "<img class='home' src='./uploads/produtos/".$file."'>";
				echo "</div>";

				echo "<div class='coluna col12'>";
					echo "<h2><b class='title'>".$nome."</b></h2>";
					echo "<p><b>".$desc."</b></p>";
					echo "<p>R$ ".$valor."</p>";
					echo "<p>12x R$ $parcela";
				echo "</div>";

				echo "<div class='coluna col12 valuecard'>";
					echo "<form action='produto1.php' method='post'>";
						echo "<button type='submit' name='btnCompra' value='$id'>Comprar</button>";
					echo "</form>";
				echo "</div>";
			echo "</div>";
		echo "</content>";
	}

	function compra($nome, $desc, $preco, $cat, $foto, $cond, $marc){
		echo "<div class='content col5 jogo'>
				<div class='coluna col12'>
					<img class='home' src='./uploads/produtos/".$foto."'>
				</div>

				<div class='coluna col12'>
					<h2><b class='title'>Nome: $nome</b></h2>
				</div>

				<div class='coluna col12'>
					<h3><p class='title'>Marca: $marc</p></h3>
				</div>

				<div class='coluna col12'>
					<h3><p class='title'>Categoria: $cat</p></h3>
				</div>

				<div class='coluna col12'>
					<h3><p class='title'>Descricao:  $desc</p></h3>
				</div>

				<div class='coluna col12'>
					<h3><p class='title'>Condição: $cond</p></h3>
				</div>

				<div class='coluna col12'>
					<p><b>Valor</b> R$ $preco</p>
				</div>
			</div>
		";
	}

	function efetuarCompra($preco, $rua, $num, $bairro, $cidade, $estado, $cep){

		echo "
			<div class='content col4 jogo'>

				<div class='coluna col12'>
					<fieldset>
						<p><b>Preço</b></p>
						<p><b>Valor</b> R$ $preco</p>
					</fieldset>
				</div>";

			if(isset($_SESSION['nome'])){
				$location = "./produto.php";
				echo "<div class='coluna col12'>
						<fieldset>
							<p><b>Dados para entrega</p>
							<p>Rua:</b> $rua</p>
							<p>Numero:</b> $num</p>
							<p>Bairro:</b> $bairro</p>
							<p>Cidade:</b> $cidade</p>
							<p>Estado:</b> $estado</p>
							<p>Cep:</b> $cep</p>
						</fieldset>
					</div>";
			}else{
				$location = "./login.php";

				echo "<div class='coluna col12'>
					<filedset>
						<p>Faça login ou cadatre-se</p>
					</fieldset>
				</div>";
			}

			echo "<div class='coluna col12'>
				<form action='$location' method='post'>
					<fieldset>";
						echo "
							<p>PArcela:</p>
							<select name='parcela' required>
								<option value='1'>1x $preco</option>
						";
						for($i = 2; $i <= 12; $i++){
							$valor = round($preco/$i, 2);
							echo "<option value='$i'>{$i} x R$ $valor</option>";
						}
						echo "</select>
						<p><button class='user' type='submit' name='efetuarCompra'value=''>Comprar</button></p>
					</fieldset>
				</form>
			</div>
		";
	}

	function cardShoplist($id, $qtd, $nome,$preco, $marc, $foto){
		$valorTotal = $preco*$qtd;
		echo "<div class='content col12 jogo'>
				<div class='coluna col1'>
					<h2><b class='title'>Qtd</b></h2>
					<h2><b class='title'>$qtd</b></h2>";
					if($qtd > 1){
						echo "<form method='post' action='shoplist.php'>
							<p><button class='user' type='submit' name='removerQtd' value='$id'>Remover</button></p>
						</form>";
					}
					echo "<form method='post' action='shoplist.php'>
						<p><button class='user' type='submit' name='adicionarQtd' value='$id'>Adicionar</button></p>
					</form>";

				echo "</div>

				<div class='coluna col3'>
					<img class='home' src='./uploads/produtos/".$foto."'>
				</div>

				<div class='coluna col4'>
					<h2><b class='title'>Nome: $nome</b></h2>
					<h3><p class='title'>Marca: $marc</p></h3>
					<h3><p class='title'>Marca: $marc</p></h3>
					<p><b>Valor</b> R$ $preco</p>
				</div>

				<div class='coluna col4'>
					<p><b>Valor Total</b> R$ $valorTotal</p>
					<form method='post' action='shoplist.php'>
						<p><button class='user' type='submit' name='removerProd' value='$id'>Remover</button></p>
					</form>
				</div>
			</div>
		";
	}

	function totalItensShoCar($valorItens, $qtdItens){
		
		echo "<div class='content col12 jogo'>
				<div class='coluna col3'>
					<h2><b class='title'>Total de itens</b></h2>
					<p>$qtdItens</p>
				</div>
				<div class='coluna col3'>
					<h2><b class='title'>Valor Total</b></h2>
					<p>R$ $valorItens</p>
				</div>

				<div class='coluna col3'>
					<h2><b class='title'>Parcela</b></h2>
					<form method='post' action=''>
						<select>
							<option>1 x R$ $valorItens</option>";
							for ($i=0; $i <= 12; $i++) {
								$parcela = round($valorItens / $i, 3); 
								echo "<option>$i x R$ $parcela</option>";
							}
						echo "</select>
					</form>
				</div>
				<div class='coluna col3'>
					<h2><b class='title'>Finalizar Compra</b></h2>
					<form method='post' action='finalizarCompra.php'>
						<p><button class='user' type='submit' name='finalizarCompra' value=''>Comprar</button></p>
					</form>
				</div>
			</div>
		";
	}

	function finalizarCompra(){

		$dados = array();
		$valor = 0;
		$itens = -1;

		$nota = md5(rand(1, 999));

		$list = fopen('./docs/notafiscal/'.$nota.'.txt', 'a+');
		if ($list == false) die('ERRO 01.');

		$teste = fgets($list);
		$dados = explode(';', $teste);

		fwrite($list, "--------------------- ShopBuy --------------------\r\n\r\n");
		fwrite($list, "Nota Fiscal Nº $nota\r\n\r\n");
		fwrite($list, "--------------------------------------------------\r\n\r\n");

		$email = $_SESSION['email'];

		$list2 = fopen('./docs/shoplist/'.$email.'.txt', 'r');
		if ($list2 == false) die('ERRO 01.');

		while($list2 != null){
			$itens++;

			$linha = fgets($list2);
			if($linha == null) break;

			$dados = explode(';', $linha);

			//Tranformando valores em numericos
			$qtd = floatval ( $dados[1] );
			$x = floatval ( $dados[3] );
			$x = $x * $qtd;
			$valor += $x;
			$a = number_format($x, 2, ',', '');

			notaFiscal($dados[0], $dados[1], $dados[3], $dados[4], $itens, $a, $nota);
		}

		fclose($list2);
		fwrite($list, "--------------------------------------------------\r\n\r\n");

		fwrite($list, "--- Dados da compra ---\r\n\r\n");
		fwrite($list, "Total de Produtos: ".$_SESSION['totalitens']."\r\n");
		fwrite($list , "Valor total: R$ ".$_SESSION['valorfinal']."\r\n");
		fwrite($list, "Total de Parcelas: ".$_SESSION['nota1']."x de R$ ".$_SESSION['nota2']."\r\n\r\n");
		fwrite($list, "--------------------------------------------------\r\n\r\n");
		fwrite($list, "--- Dados do comprador ---\r\n\r\n");
		fwrite($list, "Nome: ".$_SESSION['nome']."\r\n");
		fwrite($list, "Email: ".$_SESSION['email']."\r\n");
		fwrite($list, "Endereço: ".$_SESSION['ender']."\r\n");
		fwrite($list, "Bairro: ".$_SESSION['bairro']."\r\n");
		fwrite($list, "Cidade: ".$_SESSION['city']."\r\n\r\n");
		date_default_timezone_set('America/Sao_Paulo');
		setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		fwrite($list, "Compra feita as ".date('H:i:s')."hrs, do dia ".date('d').", de ".date('F').", de ".date('Y')."\r\n\r\n");
		fwrite($list, "--------------------------------------------------");

		fclose($list);

		return 1;

	}


?>