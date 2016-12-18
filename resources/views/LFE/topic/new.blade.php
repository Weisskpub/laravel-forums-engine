@extends('layouts.app')

@section('content')
	@include('LFE::includes')
	<div class="container">
		@include('LFE::breadcrumbs', [ 'Target' => $Forum ] )
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">{{trans('LFE::LFE.new-topic-title')}}</h3>
					</div>
					<div class="panel-body">
						@include('LFE::topic._new_form', [ 'Forum' => $Forum ])
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('LFE::footer')
@endsection
