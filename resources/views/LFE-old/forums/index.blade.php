@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			@include('LFE.breadcrumbs')
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Forums</div>
				<div class="panel-body">
@if(!empty($Forums))
					@include('LFE.forums._forums')
@else
					No forums yet
@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
