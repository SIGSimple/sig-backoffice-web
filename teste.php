<!DOCTYPE html>
<html>
	<head>
		<title>:: Solicitação de alteração de dados cadastrais ::</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<style type="text/css">
			.table,
			.table th,
			.table td {
				border: 1px solid #ccc;
			}
			.form-control[disabled=disabled] {
				background-color: #eee;
				border: 1px solid #ccc;
				width: 50%;
			}
		</style>
	</head>
	<body>
		<?php
			$strJson = '{"user":{"cod_usuario":2,"nme_usuario":"Rinaldo Gualdani Neto","nme_login":"rinaldo.neto","flg_senha_bloqueada":0,"cod_perfil":5,"nme_perfil":"COORDENAÇÃO GERAL","cod_colaborador":166,"cod_empreendimento":2,"nme_empreendimento":"CONSÓRCIO INTERMÚLTIPLAS","flg_sexo":"M"},"cooperator":{"cod_colaborador":"166","num_matricula":"000092","nme_colaborador":"RINALDO GUALDANI NETO","flg_portador_necessidades_especiais":"0","cod_empresa_contratante":"7","cod_contrato":"2","nme_fantasia":"INTERMULTIPLAS","dsc_origem":"INTERMULTIPLAS","cod_regime_contratacao":"1","dsc_regime_contratacao":"CLT","cod_departamento":"1","nme_departamento":"AL","flg_cm":"C","cod_local_trabalho":"31","nme_local_trabalho":"ÁGUA LIMPA","cod_grade_horario":"1","nme_grade_horario":"PADRÃO 1 (08:00 - 17:00)","flg_ativo":"1","flg_trabalho_fim_semana":"0","flg_trabalho_feriado":"0","flg_ajusta_folha_ponto":"0","dta_admissao":"2014-08-13","dta_demissao":null,"num_ctps":"22558","num_serie_ctps":"631","cod_estado_ctps":"26","sgl_estado_ctps":"SP","nme_estado_ctps":"São Paulo","dta_emissao_ctps":null,"num_rg":"82781485","num_cpf":"014.593.078-52","num_pis":"12275046714","num_titulo_eleitor":"139124390108","num_zona_eleitoral":"004","num_secao_eleitoral":"141","num_reservista":"487812","dsc_endereco":"RUA DO ORFANATO","num_endereco":"00529","nme_bairro":"VILA PRUDENTE","dsc_complemento":"APTO 501","nme_cidade_moradia":"SAO PAULO","cod_cidade_moradia":"3829","cod_estado_moradia":"26","sgl_estado_moradia":"SP","nme_estado_moradia":"São Paulo","cod_cidade_naturalidade":"3829","cod_estado_naturalidade":"26","num_cep":"03131-010","dta_nascimento":"1960-02-16","nme_cidade_naturalidade":"SAO PAULO","sgl_estado_naturalidade":"SP","nme_estado_naturalidade":"São Paulo","num_cnh":"01145036969","nme_categoria_cnh":"B","dta_validade_cnh":"2020-02-25","flg_sexo":"M","cod_banco":"5","nme_banco":"Itaú Unibanco S.A.","num_agencia":"3768","num_digito_agencia":"","num_conta_corrente":"00305","num_digito_conta_corrente":"9","cod_sindicato":"1","nme_sindicato":"SEESP Engenheiros SP","pth_arquivo_cnh":null,"pth_arquivo_rg":null,"pth_arquivo_foto":null,"pth_arquivo_cpf":null,"pth_arquivo_entidade":null,"pth_arquivo_curriculo":null,"pth_arquivo_reservista":null,"cod_entidade":"1","nme_entidade":"CREA","num_entidade":"060.132.213-1","qtd_horas_contratadas":"220","flg_hora_extra":"0","flg_ensino_superior":null,"funcao":{"nme_funcao":"ENGENHEIRO COORDENADOR","vlr_salario":17000,"dta_alteracao":"2015-06-27 17:44:38"},"telefones":[{"cod_telefone":"2","cod_colaborador":"166","num_ddd":"11","num_telefone":"26047540","cod_tipo_telefone":"2","nme_tipo_telefone":"RESIDENCIAL","flg_removido":false,"$$hashKey":"object:6"}],"emails":[{"cod_email":"1","cod_colaborador":"166","end_email":"rgualdanineto@gmail.com","flg_removido":false,"$$hashKey":"object:8"}],"dependentes":[{"cod_tipo_dependencia":"3","nme_tipo_dependencia":"FILHA ","nme_dependente":"LAURA MARANGONI GUALDANI","pth_documento":null,"dta_nascimento":"1999-08-27","cod_plano_saude":null,"nme_plano_saude":null,"flg_plano_saude":"0","flg_deduz_irrf":"1","flg_curso_superior":null,"flg_removido":false,"$$hashKey":"object:10"},{"cod_tipo_dependencia":"4","nme_tipo_dependencia":"FILHO","nme_dependente":"LUCAS MARANGONI GUALDANI","pth_documento":null,"dta_nascimento":"1998-01-29","cod_plano_saude":null,"nme_plano_saude":null,"flg_plano_saude":"0","flg_deduz_irrf":"1","flg_curso_superior":null,"flg_removido":false,"$$hashKey":"object:11"}]},"novosDados":{}}';
			$jsonData = json_decode($strJson);
			foreach($jsonData as $key => $value):
				${"$key"} = get_object_vars($value);
		    endforeach;
		?>
		<div class="container">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Solicitação de alteração de dados cadastrais</h3>
				</div>

				<div class="panel-body">
					<form class="form form-horizontal" role="form">
						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Matricula</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['num_matricula']) ? $cooperator['num_matricula'] : ''))?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['num_matricula'])): echo $novosDados['num_matricula']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Nome</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['nme_colaborador']) ? $cooperator['nme_colaborador'] : ''))?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['nme_colaborador'])): echo $novosDados['nme_colaborador']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Função</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset(get_object_vars($cooperator['funcao'])['nme_funcao']) ? get_object_vars($cooperator['funcao'])['nme_funcao'] : ''))?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['nme_funcao'])): echo $novosDados['nme_funcao']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Departamento</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['nme_departamento']) ? $cooperator['nme_departamento'] : ''))?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['nme_departamento'])): echo $novosDados['nme_departamento']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Local de Trabalho</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['nme_local_trabalho']) ? $cooperator['nme_local_trabalho'] : ''))?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['nme_local_trabalho'])): echo $novosDados['nme_local_trabalho']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Horário</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['nme_grade_horario']) ? $cooperator['nme_grade_horario'] : ''))?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['nme_grade_horario'])): echo $novosDados['nme_grade_horario']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Data de Admissão</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['dta_admissao']) ? $cooperator['dta_admissao'] : ''))?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['dta_admissao'])): echo $novosDados['dta_admissao']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">CTPS</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['num_ctps']) ? $cooperator['num_ctps'] : ''))?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['num_ctps'])): echo $novosDados['num_ctps']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Serie CTPS</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['num_serie_ctps']) ? $cooperator['num_serie_ctps'] : ''))?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['num_serie_ctps'])): echo $novosDados['num_serie_ctps']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Estado Emissão CTPS</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['nme_estado_ctps']) ? $cooperator['nme_estado_ctps'] : ''))?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['nme_estado_ctps'])): echo $novosDados['nme_estado_ctps']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Data de Emissão CTPS</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['dta_emissao_ctps']) ? $cooperator['dta_emissao_ctps'] : ''))?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['dta_emissao_ctps'])): echo $novosDados['dta_emissao_ctps']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">RG</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['num_rg'])) ? $cooperator['num_rg'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['num_rg'])): echo $novosDados['num_rg']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">CPF</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['num_cpf'])) ? $cooperator['num_cpf'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['num_cpf'])): echo $novosDados['num_cpf']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">PIS</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['num_pis'])) ? $cooperator['num_pis'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['num_pis'])): echo $novosDados['num_pis']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Título de eleitor</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['num_titulo_eleitor'])) ? $cooperator['num_titulo_eleitor'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['num_titulo_eleitor'])): echo $novosDados['num_titulo_eleitor']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Zona eleitoral</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['num_zona_eleitoral'])) ? $cooperator['num_zona_eleitoral'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['num_zona_eleitoral'])): echo $novosDados['num_zona_eleitoral']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Seção eleitoral</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['num_secao_eleitoral'])) ? $cooperator['num_secao_eleitoral'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['num_secao_eleitoral'])): echo $novosDados['num_secao_eleitoral']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Reservista</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['num_reservista'])) ? $cooperator['num_reservista'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['num_reservista'])): echo $novosDados['num_reservista']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Endereço</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['dsc_endereco'])) ? $cooperator['dsc_endereco'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['dsc_endereco'])): echo $novosDados['dsc_endereco']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Número</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['num_endereco'])) ? $cooperator['num_endereco'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['num_endereco'])): echo $novosDados['num_endereco']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Bairro</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['nme_bairro'])) ? $cooperator['nme_bairro'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['nme_bairro'])): echo $novosDados['nme_bairro']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Complemento</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['dsc_complemento'])) ? $cooperator['dsc_complemento'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['dsc_complemento'])): echo $novosDados['dsc_complemento']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Cidade</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['nme_cidade_moradia'])) ? $cooperator['nme_cidade_moradia'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['nme_cidade_moradia'])): echo $novosDados['nme_cidade_moradia']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">CEP</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['num_cep'])) ? $cooperator['num_cep'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['num_cep'])): echo $novosDados['num_cep']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Nascimento</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['dta_nascimento'])) ? $cooperator['dta_nascimento'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['dta_nascimento'])): echo $novosDados['dta_nascimento']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Cidade Naturalidade</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['nme_cidade_naturalidade'])) ? $cooperator['nme_cidade_naturalidade'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['nme_cidade_naturalidade'])): echo $novosDados['nme_cidade_naturalidade']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Estado Naturalidade</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['nme_estado_naturalidade'])) ? $cooperator['nme_estado_naturalidade'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['nme_estado_naturalidade'])): echo $novosDados['nme_estado_naturalidade']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">CNH</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['num_cnh'])) ? $cooperator['num_cnh'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['num_cnh'])): echo $novosDados['num_cnh']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Categoria</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['nme_categoria_cnh'])) ? $cooperator['nme_categoria_cnh'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['nme_categoria_cnh'])): echo $novosDados['nme_categoria_cnh']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Validade</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['dta_validade_cnh'])) ? $cooperator['dta_validade_cnh'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['dta_validade_cnh'])): echo $novosDados['dta_validade_cnh']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Sexo</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['flg_sexo'])) ? $cooperator['flg_sexo'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['flg_sexo'])): echo $novosDados['flg_sexo']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Banco</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=((isset($cooperator['nme_banco'])) ? $cooperator['nme_banco'] : '')?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['nme_banco'])): echo $novosDados['nme_banco']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Agência</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=($cooperator['num_agencia'].'-'.$cooperator['num_digito_agencia'])?>">
							</div>

							<div class="col-sm-4 col-md-4 col-lg-4">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['num_agencia'])): echo $novosDados['num_agencia']; endif ?>">
							</div>

							<div class="col-sm-1 col-md-1 col-lg-1">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['num_digito_agencia'])): echo $novosDados['num_digito_agencia']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Conta corrente</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=($cooperator['num_conta_corrente'].'-'.$cooperator['num_digito_conta_corrente'])?>">
							</div>

							<div class="col-sm-4 col-md-4 col-lg-4">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['num_conta_corrente'])): echo $novosDados['num_conta_corrente']; endif ?>">
							</div>

							<div class="col-sm-1 col-md-1 col-lg-1">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['num_digito_conta_corrente'])): echo $novosDados['num_digito_conta_corrente']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Sindicato</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=($cooperator['nme_sindicato'])?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['nme_sindicato'])): echo $novosDados['nme_sindicato']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Entidade</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=($cooperator['nme_entidade'])?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['nme_entidade'])): echo $novosDados['nme_entidade']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Número</label>
							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?=($cooperator['num_entidade'])?>">
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5">
								<input class="form-control" disabled="disabled" value="<?php if(isset($novosDados['num_entidade'])): echo $novosDados['num_entidade']; endif ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Telefones</label>
							<div class="col-lg-5">
								<table class="table table-bordered table-condensed table-hover table-striped">
									<thead>
										<th class="text-center text-middle">DDD</th>
										<th class="text-center text-middle">Número</th>
										<th class="text-center text-middle">Tipo</th>
									</thead>
									<tbody>
										<?php
											foreach ($cooperator['telefones'] as $key => $value) {
												$value = get_object_vars($value);
										?>
										<tr>
											<td class="text-center text-middle"><?=($value['num_ddd'])?></td>
											<td class="text-center text-middle"><?=($value['num_telefone'])?></td>
											<td class="text-center text-middle"><?=(isset($value['tipoTelefone']) ? $value['tipoTelefone']['nme_tipo_telefone'] : $value['nme_tipo_telefone'])?></td>
										</tr>
										<?php
											}
										?>
									</tbody>
								</table>
							</div>

							<label class="col-lg-1 control-label">E-mails</label>
							<div class="col-lg-4">
								<table class="table table-bordered table-condensed table-hover table-striped">
									<thead>
										<th>Endereço de E-mail</th>
									</thead>
									<tbody>
										<?php
											foreach ($cooperator['emails'] as $key => $value) {
												$value = get_object_vars($value);
										?>
										<tr>
											<td><?=($value['end_email'])?></td>
										</tr>
										<?php
											}
										?>
									</tbody>
								</table>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-md-2 col-lg-2 control-label">Dependentes</label>
							<div class="col-lg-10">
								<table class="table table-bordered table-condensed table-hover table-striped">
									<thead>
										<th class="text-middle" width="265">Nome</th>
										<th class="text-center text-middle" width="127">Parentesco</th>
										<th class="text-center text-middle" width="85">Dt. Nasc.</th>
										<th class="text-center text-middle" width="160">Plano de Saúde</th>
										<th class="text-center text-middle" width="160">Cursa Faculdade?</th>
									</thead>
									<tbody>
										<?php
											foreach ($cooperator['dependentes'] as $key => $value) {
												$value = get_object_vars($value);
										?>
										<tr>
											<td class="text-middle"><?=($value['nme_dependente'])?></td>
											<td class="text-center text-middle"><?=($value['nme_tipo_dependencia'])?></td>
											<td class="text-center text-middle"><?=($value['dta_nascimento'])?></td>
											<td class="text-center text-middle"><?=((isset($value['flg_plano_saude']) && $value['flg_plano_saude'] == 1) ? 'Sim' : 'Não')?></td>
											<td class="text-center text-middle"><?=((isset($value['flg_curso_superior']) && $value['flg_curso_superior'] == 1) ? 'Sim' : 'Não')?></td>
										</tr>
										<?php
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>