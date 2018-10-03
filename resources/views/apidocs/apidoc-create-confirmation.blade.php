@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-10">
		<div class="col-sm-10">
			<div class="panel panel-success">
				<div class="panel-heading">Ajout de la requête
					<div class="panel-body"> 
						Merci votre requête à bien été ajouté
						<div>
							<a href="{{ url('apidocs') }}" button class="btn btn-primary btn-small pull-right">Retour</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection