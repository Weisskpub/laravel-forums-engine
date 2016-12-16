<div class="row" style="margin-bottom:20px;">
	<div class="col-xs-6 text-left">
		{{$Posts->links()}}
	</div>
	<div class="col-xs-6 text-right">
		@if( Auth::check() && ( Auth::user()->isForumsAdmin() || Auth::user()->isForumsModerator($Topic->forum->id) ) )
			<div class="dropdown pull-right">
				<button class="btn btn-danger dropdown-toggle" type="button" id="topic-moderator" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					{{trans('LFE::LFE.stats-legend-moderator')}}
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="topic-moderator">
					<li>
						@if($Topic->is_active==true)
							<a
								href="{{\Hzone\LFE\Satellite::makeHideTopicUrl($Topic->id)}}"
								id="hide-topic"
								data-topic-id="{{$Topic->id}}"
								data-topic-title="{{$Topic->title}}"
							>
								<i class="fa fa-eye-slash"></i> {{trans('LFE::LFE.hide-topic-title')}}</a>
						@else
							<a
								href="{{\Hzone\LFE\Satellite::makeUnhideTopicUrl($Topic->id)}}"
								id="hide-topic"
								data-topic-id="{{$Topic->id}}"
								data-topic-title="{{$Topic->title}}"
							>
								<i class="fa fa-eye"></i> {{trans('LFE::LFE.unhide-topic-title')}}</a>
						@endif
					</li>
					<li class="divider"></li>
					<li>
						<a
							href="{{\Hzone\LFE\Satellite::makeDeleteTopicUrl($Topic->id)}}"
							class="delete-topic"
							data-topic-id="{{$Topic->id}}"
							data-topic-title="{{$Topic->title}}"
							data-forum-redirect="{{Satellite::makeForumUrl($Topic->forum)}}"
						>
							<i class="fa fa-trash-o"></i> {{trans('LFE::LFE.delete-topic-title')}}</a>
					</li>
				</ul>
			</div>
		@endif
		<span class="hide-xs pull-right">&nbsp;</span>
		@if(Auth::check() || config('LFE::allow_guests_reply'))
			<a href="{{\Hzone\LFE\Satellite::makeReplyUrl($Topic->id)}}" class="btn btn-primary pull-right">{{trans('LFE::LFE.reply-title')}}</a>
		@endif
	</div>
</div>
