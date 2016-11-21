@extends( 'layouts.app' )

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			@include( 'LFE.breadcrumbs' )
		</div>
	</div>
@if( count( $Forum->childs ) )
	@include( 'LFE.forums._forums_block', [ 'Forums' => $Forum->childs ] )
@endif
@if ( $Forum->is_category !== true )
	@include( 'LFE.forum._topics_block', [ 'Topics' => $Topics ] )
@endif
</div>
@endsection
