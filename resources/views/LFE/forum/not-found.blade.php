@extends('layouts.app')

@section('content')
	@include('LFE::includes')
	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-md-offset-3">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h3 class="panel-title">{{trans('LFE::LFE.warning')}}</h3>
					</div>
					<div class="panel-body">
						{{trans('LFE::LFE.forum-not-found')}}
					</div>
						<a class="btn btn-danger btn-link" href="javascript:history.back()">
							<i class="fa fa-angle-double-left"></i>
							{{trans('LFE::LFE.return-back')}}
						</a>
				</div>
			</div>
		</div>
	</div>
@endsection


