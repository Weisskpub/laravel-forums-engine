<form name="newtopic" method="post" action="{{Satellite::makeNewTopicUrl($Forum->id, 'post')}}">
	{{csrf_field()}}
	<input type="hidden" name="forum_id" value="{{$Forum->id}}" />
	<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
		<label for="title" class="control-label">{{trans('LFE::LFE.new-topic-title-title')}}</label>
		<input id="title" type="text" name="title" class="form-control" value="{{old('title')}}"
			placeholder="{{trans('LFE::LFE.new-topic-title-placeholder')}}" required maxlength="160"/>
		@if ($errors->has('title'))
			<span class="lfe-help-block">
			<strong>{{ $errors->first('title') }}</strong>
		</span>
		@endif
	</div>
	@include('LFE::topic._editor', [ 'showLabel' => true ])
	<div class="form-group">
		<div class="text-right">
			<button type="button" class="btn btn-default" onclick="history.go(-1)">{{trans('LFE::LFE.cancel')}}</button>
			<button type="submit" class="btn btn-primary">{{trans('LFE::LFE.create-title')}}</button>
		</div>
	</div>
</form>

