<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				{{ $Topic->title }}
			</div>
			<div class="panel-body">
				@if( count( $Posts ) )
					@foreach( $Posts as $Post )

						<div class="row">
							<div class="hidden-xs col-sm-3" style="border-right:1px solid #eee">
								<div class="title-md bold">
									<a href="{{\Hzone\LFE\Satellite::makeUserUrl($Post->user)}}">{{ $Post->user->{config( 'LFE.username_column' )} }}</a>
								</div>
							</div>
							<div class="col-xs-12 col-sm-9">
								{{ \Hzone\LFE\Satellite::intime( $Post->updated_at ) }}
							</div>
						</div>
						<div class="row">
							<div class="hidden-xs col-sm-3" style="border-right:1px solid #eee;padding-bottom:20px;">
								<div>
									<span class="nobr">{{ trans('LFE.registered_at') }}</span>
									<span class="nobr">{{ \Hzone\LFE\Satellite::intime($Post->user->created_at) }}</span>
								</div>
								<div>
									{{ trans('LFE.posts_count') }}: {{mt_rand(1,88888)}}
								</div>
								<div>
									@if ( mt_rand(0,1) == 1 ) {{-- затычка на проверку online/offline todo: заменить на проверку --}}
									<span class="badge badge-danger">ONLINE</span>
									@endif
								</div>
							</div>
							<div class="col-xs-12 col-sm-9">
								{{ $Post->body }}
							</div>
						</div>

						<div class="row-end"></div>
					@endforeach
				@endif
			</div>
		</div>
	</div>
</div>
