<div class="panel" ng-controller="CadastroColaboradorCtrl">
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a class="active" href="#first" aria-controls="first" role="tab" data-toggle="tab">
				<span class="badge">1</span>
				<span>First Step</span>
			</a>
		</li>

		<li role="presentation">
			<a href="#second" aria-controls="second" role="tab" data-toggle="tab">
				<span class="badge">1</span>
				<span>Second Step</span>
			</a>
		</li>		
	</ul>

	<div class="tab-content">
		<form class="form">
			<div role="tabpanel" class="tab-pane active" id="first">
				<h2>Enter first step data</h2>
			</div>

			<div role="tabpanel" class="tab-pane" id="second">
				<h2>Enter first step data</h2>
			</div>
		</form>
	</div>

	<div class="form-group">
		<div class="pull-right">
			<a class="btn btn-default">
				Back
			</a>
			<a class="btn btn-primary">
				Continue
			</a>
		</div>
	</div>
</div>