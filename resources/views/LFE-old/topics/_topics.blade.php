					<div class="row">
						<div class="col-xs-7 col-sm-5" style="font-weight:bold">Title</div>
						<div class="hidden-xs col-sm-3" style="font-weight:bold">Last Post</div>
						<div class="hidden-xs col-sm-1" style="font-weight:bold">Posts</div>
						<div class="hidden-xs col-sm-1" style="font-weight:bold">Views</div>
					</div>
					<div style="border-bottom:1px solid #eee"></div>
@foreach( $Topics AS $Topic )

					<div class="row">
						<div class="col-xs-7 col-sm-5">
							<div
{{-- new post/comment: bold, else normal  --}}
@if(true) style="font-weight:bold" @else{{""}}@endif
><a href="{{ Hzone\LFE\Satellite::makeTopicUrl($Topic) }}" class="lfe-topics-title">{{ $Topic->title }}</a></div>
							<div style="font-style:italic">Author: <a href="{{ Hzone\LFE\Satellite::makeUserUrl( $Topic->user ) }}">{{ $Topic->user->{config('LFE.username_column')} }}</a></div>
						</div>
						<div class="hidden-xs col-sm-3">
							<div><a href="{{ Hzone\LFE\Satellite::makeLastPostUrl( $Topic->forum ) }}">{{ Hzone\LFE\Satellite::intime($Topic->updated_at) }}</a></div>
							<div>
								<a href="{{ Hzone\LFE\Satellite::makeUserUrl( $Topic->user ) }}">
									{{ $Topic->user->{config('LFE.username_column')} }}
								</a>
							</div>
						</div>
						<div class="hidden-xs col-sm-1">{{ $Topic->posts->count() }}</div>
						<div class="hidden-xs col-sm-1">0</div>
					</div>
					<div style="border-bottom:1px solid #eee"></div>
@endforeach


