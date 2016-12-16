@extends('layouts.app')

@section('content')
	@include('LFE::includes')
	<div class="container">
		@include('LFE::breadcrumbs', [ 'Target' => null ] )
		@if(count($Forums))
			@foreach( $Forums AS $Category )
				<div class="row">
					<div class="col-xs-12">
						@include('LFE::forums._category_block', [ 'Category' => $Category ] )
					</div>
				</div>
			@endforeach
		@endif
		@include('LFE::stats')
	</div>
	@include('LFE::footer')
@endsection


