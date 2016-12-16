<div class="row lfe-post-row">
	<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 lfe-post-user">
		<div class="hidden-xs">
			@if(!is_null($Post->user))
				<div class="row lfe-post-header">
					<div class="col-xs-12 text-center">
						<h4 class="lfe-post-username" data-toggle="tooltip" data-placement="top" title="{{trans('LFE::LFE.open-profile', ['username'=>$Post->user->{config('LFE.username_column')}] )}}">
							<a href="{{\Hzone\LFE\Satellite::makeUserUrl($Post->user)}}">{{$Post->user->{config('LFE.username_column')} }}</a>
						</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 text-center">
						<img class="lfe-post-avatar" align="top" src="{{asset('/vendor/LFE/img/default_avatar_250x250.png')}}" alt="" width="100" height="100"/>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 text-center">
						<div>{!!trans('LFE::LFE.user-joined-date', ['at'=>\Carbon\Carbon::parse($Post->user->created_at)->format(config('LFE.datetime.date.short_date'))])!!}</div>
						<div>{{trans('LFE::LFE.user-posts-count', ['count'=>'?'])}}</div>
					</div>
				</div>
			@else
				<h4 data-toggle="tooltip" data-placement="top" title="{{trans('LFE::LFE.deleted-username-title')}}">{{trans('LFE::LFE.deleted-username-title')}}</h4>
				<img src="{{asset('/vendor/LFE/img/default_avatar_250x250.png')}}" alt="" width="100" height="100"/>
			@endif
		</div>
		<div class="visible-xs">
			@if(!is_null($Post->user))
				<div style="display:inline-block;border:1px solid gray;">
					<h4 data-toggle="tooltip" data-placement="top" title="{{trans('LFE::LFE.open-profile', ['username'=>$Post->user->{config('LFE.username_column')}] )}}">
						<a href="">{{$Post->user->{config('LFE.username_column')} }}</a>
					</h4>
					<img align="top" class="lfe-post-avatar" src="{{asset('/vendor/LFE/img/default_avatar_250x250.png')}}" alt="" width="100" height="100"/>
				</div>
				<div style="display:inline-block;border:1px solid gray;">
					<div>{!!trans('LFE::LFE.user-joined-date', ['at'=>\Carbon\Carbon::parse($Post->user->created_at)->format(config('LFE.datetime.date.long_date'))])!!}</div>
					<div>{{trans('LFE::LFE.user-posts-count', ['count'=>'?'])}}</div>
				</div>
			@else
				<h4 data-toggle="tooltip" data-placement="top" title="{{trans('LFE::LFE.deleted-username-title')}}">{{trans('LFE::LFE.deleted-username-title')}}</h4>
				<img src="{{asset('/vendor/LFE/img/default_avatar_250x250.png')}}" alt="" width="100" height="100"/>
			@endif
		</div>
	</div>
	<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
		<div class="row lfe-post-header">
			<div class="col-xs-12">
				<span class="pull-left">{{trans('LFE::LFE.post-created-title', ['at'=>$Post->created_at])}}</span>
				<span class="pull-right">
					<a name="post-{{$Post->id}}">#{{$Post->id}}</a>
					@if($Topic->last_post == $Post->id)
						<a name="#lastpost"></a>
					@endif
				</span>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				{!!BBCode::parse(nl2br($Post->message))!!}
			</div>
		</div>
	</div>
</div>
