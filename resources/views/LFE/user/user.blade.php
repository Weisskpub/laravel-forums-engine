@extends('layouts.app')

@section('content')
	@include('LFE::includes')
	<div class="container">
		@include('LFE::breadcrumbs', [ 'Target' => $User ] )
		<div class="row">
			<div class="col-xs-12">
				@if(!is_null($User))
					@include('LFE::user._users_block', [ 'User' => $User ])
				@endif
			</div>
		</div>
	</div>
	@include('LFE::footer')
@endsection
