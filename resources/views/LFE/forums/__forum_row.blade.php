					<div class="row">
						<div class="col-xs-12 col-sm-9">
							<div>
								<div class="title-lg"><a href="{{ \Hzone\LFE\Satellite::makeForumUrl($Forum) }}">{{ $Forum->title }}</a></div>
@if( !empty( $Forum->description ) )
								<div class="muted hidden-xs">{{ $Forum->description }}</div>
@endif
							</div>
@if(count($Forum->childs ) )
							@include( 'LFE.forums.___subforums' )
@endif
						</div>
						<div class="hidden-xs col-sm-3">
@if( !is_null( $Forum->post ) )
							<div class="nobr">
								<a href="{{ \Hzone\LFE\Satellite::makeLastPostUrlF( $Forum ) }}">
									{{ \Hzone\LFE\Satellite::intime( $Forum->post->updated_at ) }}
								</a>
							</div>
@if( !empty( $Forum->user_id ) )
							<div class="nobr">
								<a href="{{ \Hzone\LFE\Satellite::makeUserUrl( $Forum->user ) }}">
									{{ $Forum->user->{config('LFE.username_column')} }}
								</a>
							</div>
@endif
@endif
						</div>
					</div>
					<div style="border-bottom:1px solid #eee"></div>
