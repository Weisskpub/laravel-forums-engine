@extends('layouts.app')

@section('content')
	@include('LFE::includes')
	<div class="container">
		@include('LFE::breadcrumbs', [ 'Target' => new $Target ] )
		<div class="row">
			<div class="col-xs-12">
				@if( !is_null( $Users ) )
					@include('LFE::user._users_block', [ 'UserS' => $Users ])
				@endif
			</div>
		</div>
	</div>
	@include('LFE::footer')
@endsection
