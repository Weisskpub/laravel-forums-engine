<div class="row lfe-topic-row">
	<div class="hidden-xs col-sm-1 text-right">
	</div>
	<div class="col-xs-12 col-sm-6">
		<div>
			<a href="{{\Hzone\LFE\Satellite::makeTopicUrl($Topic)}}">{{$Topic->title}}</a>
		</div>
	</div>
	<div class="hidden-xs col-sm-1 text-right">
		{{$Topic->countPosts}}
	</div>
	<div class="hidden-xs col-sm-2">
		@if(!is_null($Topic->lastPost))
			<nobr>
				<a href="{{\Hzone\LFE\Satellite::makePostUrl($Topic->lastPost, true)}}">
					{{\Hzone\LFE\Satellite::intime($Topic->lastPost->updated_at)}}
				</a>
			</nobr>
		@endif
	</div>
	<div class="hidden-xs hidden-sm col-md-2">
		@if(!is_null($Topic->lastPost))
			@if(!is_null($Topic->lastPost->user))
				&nbsp;
				<nobr>
					<a href="{{\Hzone\LFE\Satellite::makeUserUrl($Topic->lastPost->user)}}">
						{{$Topic->lastPost->user->{config('LFE.username_column')} }}</a>
				</nobr>
			@endif
		@endif
	</div>
</div>
