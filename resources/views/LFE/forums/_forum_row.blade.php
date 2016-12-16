<div class="row lfe-forum-row">
	<div class="hidden-xs col-sm-1 text-right" style="padding-top:3px;">
		<i class="fa fa-2x fa-file-o no-new-posts"></i>
	</div>
	<div class="col-xs-12 col-sm-6">
		<div>
			<a href="{{\Hzone\LFE\Satellite::makeForumUrl($Forum)}}">{{$Forum->title}}</a>
		</div>
		@if(!empty($Forum->description))
			<div class="text-muted small">{{$Forum->description}}</div>
		@endif
		@if(count($Forum->childs))
			<div class="subforums-block">
				@foreach($Forum->childs as $sx=>$Subforum)
					<nobr>
						<i class="fa fa-reply fa-rotate-180 no-new-posts"></i>
						<a href="{{\Hzone\LFE\Satellite::makeForumUrl($Subforum)}}">
							{{$Subforum->title}}@if($sx<count($Forum->childs)-1){{",&nbsp;"}}@endif
						</a>
					</nobr>
				@endforeach
			</div>
		@endif
	</div>
	<div class="hidden-xs col-sm-1 text-right">
		{{$Forum->countPosts}}
	</div>
	<div class="hidden-xs col-sm-2">
		@if(!is_null($Forum->lastPost))
			<nobr>
				<a href="{{\Hzone\LFE\Satellite::makePostUrl($Forum->lastPost, true)}}">
					{{\Hzone\LFE\Satellite::intime($Forum->lastPost->updated_at)}}
				</a>
			</nobr>
		@endif
	</div>
	<div class="hidden-xs hidden-sm col-md-2">
		@if(!is_null($Forum->lastPost))
			@if(!is_null($Forum->lastPost->user))
				&nbsp;<nobr><a href="{{\Hzone\LFE\Satellite::makeUserUrl($Forum->lastPost->user)}}">{{$Forum->lastPost->user->{config('LFE.username_column')} }}</a></nobr>
			@endif
		@endif
	</div>
</div>
