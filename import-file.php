<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Fixed Footer | Nifty - Responsive admin template.</title>
	<!--Open Sans Font [ OPTIONAL ] -->
 	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">
	<!--Bootstrap Stylesheet [ REQUIRED ]-->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!--Nifty Stylesheet [ REQUIRED ]-->
	<link href="css/nifty.min.css" rel="stylesheet">
	<!--Font Awesome [ OPTIONAL ]-->
	<link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!--Switchery [ OPTIONAL ]-->
	<link href="plugins/switchery/switchery.min.css" rel="stylesheet">
	<!--Bootstrap Select [ OPTIONAL ]-->
	<link href="plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
	<table class="table table-striped table-condensed table-hover table-bordered">
		<tbody>
		<?php
			$file_handle = fopen("bd.csv", "r");

			$line_of_text = array();

			while(!feof($file_handle)){
				$line_of_text[] = fgetcsv($file_handle, 1024);
			}

			fclose($file_handle);

			for($i=0; $i < count($line_of_text); $i++) {
				if(count($line_of_text[$i]) > 1)
					$line_of_text[$i] = utf8_encode($line_of_text[$i][0] . "." . $line_of_text[$i][1]);
				else
					$line_of_text[$i] = utf8_encode($line_of_text[$i][0]);
			}

			for($i=0;$i<count($line_of_text);$i++) {
				$line = explode(";", $line_of_text[$i]);
		?>
			<tr>
				<?php
					for($x = 0; $x < count($line); $x++) {
				?>
					<td>
						<?=($line[$x])?>
					</td>
				<?php
					}
				?>
			</tr>
		<?php
			}
		?>
		</tbody>
	</table>

	<?php
		for($i=0;$i<count($line_of_text);$i++) {
			$line = explode(";", $line_of_text[$i]);
	?>
		INSERT INTO (
		  num_registro,nome_completo,flg_necessidades_especiais,dsc_funcao_medicao,contrato,contratante,regime,depto,flg_cm,dsc_situacao_18_05_2015,nme_centralizador,nme_localizacao,dsc_complemento_localizacao,codigo_cargo,funcao,admissao,rg,ctps,serie,uf_ctps,emissao_ctps,cpf,pis,titulo_eleitor,zona_eleitor,secao_eleitor,num_reservista,endereco,numero,bairro,complemento,cidade,uf,cep,telefone,nascimento,uf_natural,uf_nascimento,cnh,categoria_cnh,validade_cnh,sexo,banco,agencia,dv_agencia,conta_corrente,dv_conta,demissao,salario_abr_15,custo,sindicato,conta_google,celular_particular,celular_consorcio,email,entidade,numero_na_entidade
		)
		VALUES (
		<?php
			for($x = 0; $x < count($line); $x++) {
		?>
			'<?=($line[$x])?>',
		<?php
			}
		?>
		)<br/><br/>
	<?php
		}
	?>

	<!--jQuery [ REQUIRED ]-->
	<script src="js/jquery-2.1.1.min.js"></script>
	<!--BootstrapJS [ RECOMMENDED ]-->
	<script src="js/bootstrap.min.js"></script>
	<!--Fast Click [ OPTIONAL ]-->
	<script src="plugins/fast-click/fastclick.min.js"></script>
	<!--Nifty Admin [ RECOMMENDED ]-->
	<script src="js/nifty.min.js"></script>
	<!--Switchery [ OPTIONAL ]-->
	<script src="plugins/switchery/switchery.min.js"></script>
	<!--Bootstrap Select [ OPTIONAL ]-->
	<script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
</body>
</html>