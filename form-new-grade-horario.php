<div class="panel" ng-controller="CadastroGradeHorarioCtrl">
	<form class="form form-horizontal">
		<div class="panel-body">

			<div class="form-group">
				<label class="control-label col-lg-2">Nome</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" ng-model="gradeHorario.nme_grade_horario">
					</div>
				</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Ativo?</label>
					<div class="col-lg-1">
						<input type="checkbox" class="input-switch" ng-model="gradeHorario.flg_ativo">
					</div>
			</div>

		<div class="panel-footer clearfix">
			<div class="pull-right">
				<button type="submit" class="btn btn-primary btn-labeled fa fa-save" ng-click="saveRecords()">Salvar</button>
			</div>
		</div>
	</form>
</div>


