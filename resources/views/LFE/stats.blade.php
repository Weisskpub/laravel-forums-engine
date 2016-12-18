<div class="row">
	<div class="col-xs-12">
		<ol class="lfe-breadcrumb-stats">
			<li>{{trans('LFE::LFE.stats-title')}}</li>
			<li>Users: {{config('LFE.UserClass')::count()}}</li>
			<li>Topics: {{Topic::count()}}</li>
			<li>Posts: {{Post::count()}}</li>
		</ol>
	</div>
</div>
<div class="panel-group" id="accordion-stats" role="tablist" aria-multiselectable="true">
	<div class="panel panel-primary">
		<div class="panel-heading" role="tab" id="heading-stats">
			<h4 class="panel-title">
				<strong>{{trans('LFE::LFE.who-online-title')}}</strong>
				<a role="button" data-toggle="collapse" data-parent="#accordion-stats" href="#collapse-stats" aria-expanded="true" aria-controls="collapse-{{$Category->id}}" style="text-decoration: none" class="pull-right">
					<i id="faggr-icon-stats" class="fa fa-minus-square-o" onclick="if($(this).hasClass('fa-minus-square-o')){$(this).removeClass('fa-minus-square-o').addClass('fa-plus-square-o')}else{$(this).removeClass('fa-plus-square-o').addClass('fa-minus-square-o')}"></i>
				</a>
			</h4>
		</div>
		<div id="collapse-stats" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-stats">
			<div class="panel-body" style="padding-top:0">
				<div class="row" style="margin-top:25px">
					<div class="col-xs-12">
						<?php $guests = 0;?>
						@foreach(WhoOnline::getOnlineUsers() as $ou)
							@if(!is_null($ou->user))
								<a href="{{\Hzone\LFE\Satellite::makeUserUrl($ou->user)}}">
									<span class="@if($ou->user->isForumsAdmin()){{"lfe-badge-admin"}}@elseif($ou->user->isForumsModerator()){{"lfe-badge-moderator"}}@else{{"lfe-badge-user"}}@endif
										" title="{{\Carbon\Carbon::createFromTimestamp($ou->last_activity)->format(config('LFE.datetime.date.middle_datetime'))}}
										">
										{{$ou->user->{config('LFE.username_column')} }}
									</span>
								</a>
							@else
								<?php $guests++;?>
							@endif
						@endforeach
						@if(!empty($guests))
							{{trans('LFE::LFE.stats-guests', [ 'count' => $guests ])}}
						@endif
					</div>
				</div>
				<div class="row" style="margin-top:25px">
					<div class="col-xs-12">
						<div>{{trans('LFE::LFE.stats-legend-title')}}</div>
						<span class="lfe-badge-admin">
							{{trans('LFE::LFE.stats-legend-admin')}}
						</span>
						<span class="lfe-badge-moderator">
							{{trans('LFE::LFE.stats-legend-moderator')}}
						</span>
						<span class="lfe-badge-user">
							{{trans('LFE::LFE.stats-legend-user')}}
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
