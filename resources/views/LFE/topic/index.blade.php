@extends('layouts.app')

@section('content')
	@include('LFE::includes')
	<div class="container">
		@include('LFE::breadcrumbs', [ 'Target' => $Topic ] )
		<div class="row">
			<div class="col-xs-12">
				@if(!is_null($Topic) && count($Posts))
					@include('LFE::topic._posts_block', [ 'Topic' => $Topic ])
				@endif
			</div>
		</div>
	</div>
	@include('LFE::footer')
@endsection
