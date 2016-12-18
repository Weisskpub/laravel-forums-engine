<div class="row" style="margin-bottom:20px;">
	<div class="col-xs-6 text-left">
		@include('LFE::top_menu_global')
	</div>
	<div class="col-xs-6 text-right">
		<a href="{{\Hzone\LFE\Satellite::makeNewTopicUrl($Forum->id)}}" class="btn btn-primary">{{trans('LFE::LFE.new-topic-title')}}</a>
	</div>
</div>
