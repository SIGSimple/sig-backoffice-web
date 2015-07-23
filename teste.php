<?php

include_once 'php.util/HttpUtil.php';
$users = json_decode(HttpUtil::doGetRequest('http://'. $_SERVER['HTTP_HOST'] .'/sig-backoffice-api/usuarios?nolimit=1', null));

foreach ($users->rows as $key => $value) {
	if(isset($value->num_matricula)) {
		$pth_arquivo_cnh 					= "/home/consorciointermultip/public_html/files/docs/" . str_pad($value->num_matricula, 6, STR_PAD_LEFT,  "0") . "-CNH-01.png";
		$pth_arquivo_rg 					= "/home/consorciointermultip/public_html/files/docs/" . str_pad($value->num_matricula, 6, STR_PAD_LEFT,  "0") . "-RG-01.png";
		$pth_arquivo_foto 					= "/home/consorciointermultip/public_html/files/docs/" . str_pad($value->num_matricula, 6, STR_PAD_LEFT,  "0") . "-FOTO-01.png";
		$pth_arquivo_cpf 					= "/home/consorciointermultip/public_html/files/docs/" . str_pad($value->num_matricula, 6, STR_PAD_LEFT,  "0") . "-CPF-01.png";
		$pth_arquivo_entidade 				= "/home/consorciointermultip/public_html/files/docs/" . str_pad($value->num_matricula, 6, STR_PAD_LEFT,  "0") . "-ENTIDADE-01.png";
		$pth_arquivo_curriculo 				= "/home/consorciointermultip/public_html/files/docs/" . str_pad($value->num_matricula, 6, STR_PAD_LEFT,  "0") . "-CURRICULO-01.png";
		$pth_arquivo_reservista 			= "/home/consorciointermultip/public_html/files/docs/" . str_pad($value->num_matricula, 6, STR_PAD_LEFT,  "0") . "-RESERVISTA-01.png";
		$pth_arquivo_aso 					= "/home/consorciointermultip/public_html/files/docs/" . str_pad($value->num_matricula, 6, STR_PAD_LEFT,  "0") . "-ASO-01.png";
		$pth_arquivo_ensino_superior 		= "/home/consorciointermultip/public_html/files/docs/" . str_pad($value->num_matricula, 6, STR_PAD_LEFT,  "0") . "-ESCOLARIDADE-01.png";
		$pth_arquivo_titulo_eleitor 		= "/home/consorciointermultip/public_html/files/docs/" . str_pad($value->num_matricula, 6, STR_PAD_LEFT,  "0") . "-TITULOELEITORAL-01.png";
		$pth_arquivo_ctps 					= "/home/consorciointermultip/public_html/files/docs/" . str_pad($value->num_matricula, 6, STR_PAD_LEFT,  "0") . "-CTPS-01.png";
		$pth_arquivo_certidao 				= "/home/consorciointermultip/public_html/files/docs/" . str_pad($value->num_matricula, 6, STR_PAD_LEFT,  "0") . "-CERTIDAO-01.png";
		$pth_arquivo_comprovante_bancario 	= "/home/consorciointermultip/public_html/files/docs/" . str_pad($value->num_matricula, 6, STR_PAD_LEFT,  "0") . "-CONTABANCARIA-01.png";
		$pth_arquivo_comprovante_endereco 	= "/home/consorciointermultip/public_html/files/docs/" . str_pad($value->num_matricula, 6, STR_PAD_LEFT,  "0") . "-COMPENDERECO-01.png";
		$pth_arquivo_carta_referencia 		= "/home/consorciointermultip/public_html/files/docs/" . str_pad($value->num_matricula, 6, STR_PAD_LEFT,  "0") . "-CARTAREFERENCIA-01.png";
		$pth_arquivo_pis 					= "/home/consorciointermultip/public_html/files/docs/" . str_pad($value->num_matricula, 6, STR_PAD_LEFT,  "0") . "-PIS-01.png";
		$pth_arquivo_sus 					= "/home/consorciointermultip/public_html/files/docs/" . str_pad($value->num_matricula, 6, STR_PAD_LEFT,  "0") . "-SUS-01.png";
		
		echo "UPDATE tb_colaborador
				SET 
					pth_arquivo_cnh = '$pth_arquivo_cnh',
					pth_arquivo_rg = '$pth_arquivo_rg',
					pth_arquivo_foto = '$pth_arquivo_foto',
					pth_arquivo_cpf = '$pth_arquivo_cpf',
					pth_arquivo_entidade = '$pth_arquivo_entidade',
					pth_arquivo_curriculo = '$pth_arquivo_curriculo',
					pth_arquivo_reservista = '$pth_arquivo_reservista',
					pth_arquivo_aso = '$pth_arquivo_aso',
					pth_arquivo_ensino_superior = '$pth_arquivo_ensino_superior',
					pth_arquivo_titulo_eleitor = '$pth_arquivo_titulo_eleitor',
					pth_arquivo_ctps = '$pth_arquivo_ctps',
					pth_arquivo_certidao = '$pth_arquivo_certidao',
					pth_arquivo_comprovante_bancario = '$pth_arquivo_comprovante_bancario',
					pth_arquivo_comprovante_endereco = '$pth_arquivo_comprovante_endereco',
					pth_arquivo_carta_referencia = '$pth_arquivo_carta_referencia',
					pth_arquivo_pis = '$pth_arquivo_pis',
					pth_arquivo_sus = '$pth_arquivo_sus'
				WHERE cod_colaborador = ". $value->cod_colaborador .";<br>";
	}
}