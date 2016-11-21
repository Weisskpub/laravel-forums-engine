@extends( 'layouts.app' )

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			@include( 'LFE.breadcrumbs' )
		</div>
	</div>
	@include( 'LFE.forums._forums_block' )
</div>
@endsection
