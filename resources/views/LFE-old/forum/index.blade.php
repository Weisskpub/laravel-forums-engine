@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			@include('LFE.breadcrumbs')
		</div>
	</div>
@if ( count( $Forum->childs ) )
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Forums</div>
				<div class="panel-body">
					@include( 'LFE.forums._forums', [ 'Forums' => $Forum->childs ] )
				</div>
			</div>
		</div>
	</div>
@endif
@if( $Forum->is_category != true )
	@include('LFE.topics.index')
@endif
</div>
@endsection
