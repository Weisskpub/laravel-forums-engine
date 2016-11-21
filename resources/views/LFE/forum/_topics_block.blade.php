	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
				{{ trans( 'LFE.topics' ) }}
				</div>
				<div class="panel-body">
@if( count( $Topics ) )
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 bold">
							{{ trans( 'LFE.title' ) }}
						</div>
						<div class="hidden-xs col-sm-2 col-md-2 col-lg-2 bold">
							{{ trans( 'LFE.author' ) }}
						</div>
						<div class="hidden-xs col-sm-1 col-md-1 col-lg-1 bold">
							{{ trans( 'LFE.views' ) }}
						</div>
						<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 bold">
							{{ trans( 'LFE.lastpost' ) }}
						</div>
					</div>
@foreach( $Topics as $Topic )

					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div>
								<a href="{{ \Hzone\LFE\Satellite::makeTopicUrl( $Topic ) }}">
									{{ $Topic->title }}
								</a>
							</div>
						</div>
						<div class="hidden-xs col-sm-2 col-md-2 col-lg-2">
@if( !is_null( $Topic->user ) )
							<a href="{{ \Hzone\LFE\Satellite::makeUserUrl( $Topic->user ) }}">
								{{ $Topic->user->{config( 'LFE.username_column' )} }}
							</a>
@endif
						</div>
						<div class="hidden-xs col-sm-1 col-md-1 col-lg-1">
@if ( empty( $Topic->views ) )
	&mdash;
@else
							{{ $Topic->views }}
@endif
						</div>
						<div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
@if( !is_null( $Topic->post ) )
							<span class="nobr"><a href="{{ \Hzone\LFE\Satellite::makeLastPostUrlT( $Topic ) }}">{{ \Hzone\LFE\Satellite::intime( $Topic->post->updated_at ) }}</a></span>,
							<span class="nobr">
								<a href="{{ \Hzone\LFE\Satellite::makeUserUrl( $Topic->post->user ) }}">
									{{ $Topic->post->user->{config( 'LFE.username_column' )} }}
								</a>
							</span>
@else
	&mdash;
@endif
						</div>
					</div>

					<div class="row-end"></div>
@endforeach
@else
					{{ trans( 'LFE.no-topics-yet' ) }}
@endif
				</div>
			</div>
		</div>
	</div>
