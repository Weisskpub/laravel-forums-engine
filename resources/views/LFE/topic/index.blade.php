@extends( 'layouts.app' )

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				@include( 'LFE.breadcrumbs' )
			</div>
		</div>
		@include( 'LFE.topic._posts_block', [ 'Posts' => $Topic->posts ] )
	</div>
@endsection
