@extends('layouts.app')

@section('content')
	@include('LFE::includes')
	<div class="container">
		@include('LFE::breadcrumbs', [ 'Target' => $Forum ] )
		<div class="row">
			<div class="col-xs-12">
				@if(!is_null($Forum) && count($Forum->childs))
					@include('LFE::forums._category_block', [ 'Category' => $Forum ])
				@endif
				@if($Forum->is_category == false)
					@include('LFE::forum._topics_block', [ 'Forum' => $Forum, 'Topics' => $Topics ] )
				@endif
			</div>
		</div>
	</div>
	@include('LFE::footer')
@endsection
